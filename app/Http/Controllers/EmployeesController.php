<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|min:5|max:20',
            'address'=>'required|min:5',
            'salary'=>'required',
            'gender'=>'required',
            'contact'=>'required|min:11|',
            'email'=>'required|email|unique:employees',
        ]);

        $contact = new Employees([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'salary' => $request->get('salary'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email'),
            'gender' => $request->get('gender'),
        ]);
        $contact->save();
        return redirect()->back()->with('success', 'Thank you');   

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $get_employee = Employees::findOrFail($id);
        return view('employees.view', ['employee' => $get_employee]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($employee)
    {
        //
        $get_employee = Employees::findOrFail($employee);
        return view('employees.edit', ['employee' => $get_employee]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|min:5|max:20',
            'address'=>'required|min:5',
            'salary'=>'required',
            'gender'=>'required',
            'contact'=>'required|min:11|',
            'email'=>'required|email|unique:employees,email,'. $id
        ]);


        $employee = Employees::findOrFail($id);
        $employee->name = $request->get('name');
        $employee->address = $request->get('address');
        $employee->salary = $request->get('salary');
        $employee->contact = $request->get('contact');
        $employee->email = $request->get('email');
        $employee->gender = $request->get('gender');
        $employee->name = $request->get('name');
        $employee->save();
        return redirect('/')->with('success', 'Record updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $employee = Employees::findOrFail($id);
        $employee->delete();

        return redirect('/')->with('success', 'Successfully deleted the employee!');
    }
}
