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

class CareerController extends Controller
{
    protected $employment_status = array('Full Time' => 'Full Time', 'Part Time' => 'Part Time', 'Remote' => 'Remote','Project Based' => 'Project Based');
    public function index()
    {
        return view('hr.careers.index', ['page_title' => 'Careers']);
    }

    public function create(Request $request)
    {

        $data['title'] = 'Add Career';
        $data['departments'] = Department::pluck('name','id');
        $data['employment_status'] = $this->employment_status;
        $html = view('hr.careers.create', $data)->render();
        return response()->json($html);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:careers|min:5',
            'department' => 'required',
            'employment_status' => 'required',
            'location' => 'required',
            'job_responsibility' => 'required|min:20',
            'educational_requirements' => 'required|min:20',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if($request->get('status')) {
           $status = true;
        }else{
            $status = false;
        }

        $data = new Career([
            'title' => $request->get('title'),
            'department_id' => $request->get('department'),
            'description' => $request->get('job_responsibility'),
            'educational_requirements' => $request->get('educational_requirements'),
            'no_of_vacancy' => $request->get('no_of_vacancy'),
            'employment_status' => $request->get('employment_status'),
            'location' => $request->get('location'),
            'salary' => $request->get('salary'),
            'status' => $status,
        ]);

        $data->save();
        return response()->json(['success' => $data]);
    }

    public function show($id)
    {
        $data = Career::findOrFail($id);
        $html = view('hr.careers.view', 
            [
            'data' => $data, 
            'title' => $data->title, 
            ])->render();

        return response()->json($html);
    }

    public function edit($id)
    {
        $data = Career::findOrFail($id);
   
        $html = view('hr.careers.edit', 
            [
            'data' => $data, 
            'title' => $data->title,
            'employment_status' => $this->employment_status,
            'departments' => Department::pluck('name','id') 
            ])->render();
        return response()->json($html);
    }

    public function update(Request $request, $id)
    {
        $data = Career::findOrFail($id);

 

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:careers,title,'.$id,
            'department' => 'required',
            'employment_status' => 'required',
            'location' => 'required',
            'job_responsibility' => 'required|min:20',
            'educational_requirements' => 'required|min:20',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if($request->get('status')) {
            $status = true;
        }else{
            $status = false;
        }


        $data->title = $request->get('title');
        $data->department_id = $request->get('department');
        $data->description = $request->get('job_responsibility');
        $data->educational_requirements = $request->get('educational_requirements');
        $data->no_of_vacancy = $request->get('no_of_vacancy');
        $data->employment_status = $request->get('employment_status');
        $data->location = $request->get('location');
        $data->salary = $request->get('salary');
        $data->status = $status;
        $data->save();
        
        return response()->json(['success' => $data]);

    }

    public function list(Request $request) {

        $length =  $request->length;
        $search = $request->search['value'];
        $page = $request->start;
        $data = array();
        $recordsTotal = DB::table('careers')->count();
        $recordsFiltered = $recordsTotal;

        if($search)  {
            $results = Career::query()
            ->whereLike(['title','department.name','location','employment_status'], $search)
            ->orderBy('id', 'desc')
            ->paginate($length, ['*'], 'page', $page );
            $recordsFiltered = count($results);
        }else{
            $results = Career::orderBy('id', 'desc')->paginate($length, ['*'], 'page', $page);
        }

        foreach ($results as $result) {
            $actions = "<a type='button' class='btn btn-primary btn-sm btn-view' data-id='{$result->id}'>   <i class='far fa-eye'></i> </a>";
            $status = '<span class="badge badge-success">Open</span>';

            if($result->status == false) {
                $status = '<span class="badge badge-danger">Closed</span>';
            }

            $data[] = array(
               $result->title,
               $result->department->name,
               $result->employment_status,
               $result->location,
               $result->no_of_vacancy,
               $status,
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

    public function preview($slug)
    {
        $data = Career::where('slug',$slug)->first();
        
        $data['data'] = $data;
        return view('hr.careers.preview', $data);
    }

    public function apply($slug)
    {
        $data = Career::where('slug',$slug)->first();
        $data['data'] = $data;
        return view('hr.careers.apply', $data);
    }

    public function prev_index(){
        return view('hr.careers.prev_index');
    }

    public function apply_store(Request $request,$slug)
    {
        $career = Career::where('slug',$slug)->first();

        $request->validate([
            'first_name'=>'required|min:5|max:20',
            'last_name'=>'required|min:5',
            'gender'=>'required',
            'file'=>'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:5048',
            'contact'=>'required|min:11|',
            'email'=>'required|email',
            'agreement'=>'required',
        ]);

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
        $data->career_id = $career->id;
        $data->email = $request->get('email');

        if ($request->hasFile('file')) {

            // $filenameWithExt = $request->file('file')->getClientOriginalName ();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('file')->getClientOriginalExtension();
            // $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // $data->file = $fileNameToStore;
            // $request->file('file')->storeAs('public/files/applicant', $fileNameToStore);

            $path = $request->file('file')->store('files/applicants','s3');
            Storage::disk('s3')->setVisibility($path,'public');
            $data->file = Storage::disk('s3')->url($path);

        }

        $data->save();
    
        return $count;
        // return redirect('/')->with('success', 'Record saved!');
    }
}
