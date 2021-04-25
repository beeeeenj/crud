<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Career;
use App\Models\Applicant;

use Illuminate\Support\Facades\DB;
Use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('hr.applicants.index', ['page_title' => 'Applicants']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=>'required|min:5|max:20',
            'last_name'=>'required|min:5',
            'gender'=>'required',
            'file'=>'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:5048',
            'contact'=>'required|min:11|',
            'email'=>'required|email',
            'job'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = Applicant::all()->count() + 1;
        $count = str_pad($count,'6','0',STR_PAD_LEFT);

        $data = new Applicant();
        $data->first_name = $request->get('first_name');
        $data->middle_name = $request->get('middle_name');
        $data->last_name = $request->get('last_name');
        $data->gender = $request->get('gender');
        $data->contact = $request->get('contact');
        $data->referred_by = $request->get('referred_by');
        $data->ref_no = 'APT-'.$count;
        $data->career_id =  $request->get('job');
        $data->email = $request->get('email');

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files/applicants','s3');
            Storage::disk('s3')->setVisibility($path,'public');
            $data->file = Storage::disk('s3')->url($path);
        }

        $data->save();
        return response()->json(['success' => $data]);

    }

    

    public function create(Request $request)
    {

        $data['title'] = 'Add Applicant';
        $data['careers'] = Career::pluck('title','id');
        $html = view('hr.applicants.create', $data)->render();
        return response()->json($html);
    }

    public function list(Request $request) {

        $length =  $request->length;
        $search = $request->search['value'];
        $page = $request->start;
        $status = $request->status;

        $data = array();

        if($search)  {
            $recordsTotal = Applicant::all()->count();
            $results = Applicant::query()
            ->whereLike(['first_name', 'middle_name', 'last_name', 'status','career.title','career.department.name'], $search)
            ->orderBy('id', 'desc')
            ->paginate($length, ['*'], 'page', $page );
            $recordsFiltered = count($results);
        }else{
            $recordsTotal = Applicant::where('status', $status)->count();
            $results = Applicant::where('status', $status)->orderBy('id', 'desc')->paginate($length, ['*'], 'page', $page);
        }

        $recordsFiltered = $recordsTotal;

        foreach ($results as $result) {
            $actions = "<a type='button' class='btn btn-primary btn-sm btn-view' data-id='{$result->id}'>   <i class='far fa-eye'></i> </a>";
            $status = '<span class="badge badge-success">Open</span>';

            if($result->status == false) {
                $status = '<span class="badge badge-danger">Closed</span>';
            }


            $data[] = array(
               $result->full_name,
               $result->email,
               $result->contact,
               $result->referred_by,
               $result->career->department->name,
               $result->career->title,
               $result->career->location,
               $actions,
            );
           
        }
        //$results = [1];
        $dt['data'] = $data;
        $dt['recordsTotal'] = $recordsTotal;
        $dt['recordsFiltered'] = $recordsFiltered;
        $dt['draw'] = $request->draw;
        return $dt;
    }

    public function show($id)
    {
        $data = Applicant::findOrFail($id);
        $html = view('hr.applicants.view', 
            [
            'data' => $data, 
            'title' => $data->full_name, 
            ])->render();
        return response()->json($html);
    }

    public function edit($id)
    {
        $data = Applicant::findOrFail($id);
   
        $html = view('hr.applicants.edit', 
            [
            'data' => $data, 
            'title' => "Update Applicant",
            'careers' => Career::pluck('title','id') 
            ])->render();
        return response()->json($html);
    }

    public function update(Request $request, $id)
    {
        $data = Applicant::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name'=>'required|min:5|max:20',
            'last_name'=>'required|min:5',
            'gender'=>'required',
            'file'=>'mimes:jpeg,png,jpg,pdf,doc,docx|max:5048',
            'contact'=>'required|min:11|',
            'email'=>'required|email',
            'job'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $data->first_name = $request->get('first_name');
        $data->middle_name = $request->get('middle_name');
        $data->last_name = $request->get('last_name');
        $data->gender = $request->get('gender');
        $data->contact = $request->get('contact');
        $data->referred_by = $request->get('referred_by');
        $data->career_id =  $request->get('job');
        $data->email = $request->get('email');
        
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files/applicants','s3');
            Storage::disk('s3')->setVisibility($path,'public');
            $data->file = Storage::disk('s3')->url($path);
        }

        $data->save();
        return response()->json(['success' => $data]);


    }

    public function view_update(Request $request, $id) {
        $data = Applicant::findOrFail($id);

        $data->note = $request->get('note');
        $data->status = $request->get('status');
        $data->save();
        
        return response()->json(['success' => $data]);

    }

    public function count_status() {
        $pending = Applicant::where('status','Pending')->count();
        $fi = Applicant::where('status','For Interview')->count();
        $q = Applicant::where('status','Qualified')->count();
        $nq = Applicant::where('status','Not Qualified')->count();
        return response()->json(['pending' => $pending, 'fi' => $fi,'q'=> $q, 'nq' => $nq ]);
    }

    public function get_info($id) {
        $data = Applicant::findOrFail($id);
        return response()->json([$data]);
    }
}
