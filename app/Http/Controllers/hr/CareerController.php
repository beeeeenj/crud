<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Career;

use Illuminate\Support\Facades\DB;
Use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Validator;


class CareerController extends Controller
{
    public function index()
    {
        return view('hr.careers.index', ['page_title' => 'Careers']);
    }

    public function create(Request $request)
    {

        $data['title'] = 'Add Career';
        $data['departments'] = Department::pluck('name','id');
        $html = view('hr.careers.create', $data)->render();
        return response()->json($html);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:careers|min:5',
            'department' => 'required',
            'description' => 'required|min:20',
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
            'description' => $request->get('description'),
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
            'description' => 'required|min:20',
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
        $data->description = $request->get('description');
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
            ->whereLike(['title', 'description','department.name'], $search)
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
               $result->slug,
               $status,
               Carbon::parse($result->created_at)->format("Y-m-d, h:mm a"),
               Carbon::parse($result->updataed_at)->format("Y-m-d, h:mm a"),
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
}
