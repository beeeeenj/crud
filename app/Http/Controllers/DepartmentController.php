<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
Use Carbon\Carbon;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('department.index', ['page_title' => 'Departments']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

  
        $data['title'] = 'Add Department';
        $html = view('department.create', $data)->render();
        return response()->json($html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments|min:5',
            'code' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $data = new Department([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'description' => $request->get('description'),
        ]);

        if ($request->hasFile('image')) {
                $filenameWithExt = $request->file('image')->getClientOriginalName ();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $data->image = $fileNameToStore;
                $request->file('image')->storeAs('public/image/department', $fileNameToStore);
        }
        $data->save();
        return response()->json(['success' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list(Request $request) {

        $length =  $request->length;
        $search = $request->search['value'];
        $page = $request->start;
        $data = array();
        $recordsTotal = DB::table('departments')->where('deleted_at',NULL)->count();
        $recordsFiltered = $recordsTotal;

        if($search)  {
            $results = Department::orderBy('id', 'desc')->search($search)->paginate($length, ['*'], 'page', $page );
            $recordsFiltered = count($results);
        }else{
            $results = Department::orderBy('id', 'desc')->paginate($length, ['*'], 'page', $page);
        }

        foreach ($results as $result) {
            $data[] = array(
               $result->name,
               $result->code,
               Carbon::parse($result->created_at)->format("Y-m-d, h:mm a"),
               Carbon::parse($result->updataed_at)->format("Y-m-d, h:mm a"),
               '',
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
