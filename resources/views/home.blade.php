@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 col-md">
        <a class="btn btn-outline-primary" href="/employees/create">Add Employee</a>
        @if(session()->get('success'))
            <div class="alert alert-success mt-3">
            {{ session()->get('success') }}  
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th style="width: 1%"></th>
                        <th style="width: 1%"></th>
                        <th style="width: 1%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                       <tr>
                           <td>{{ $employee->name }}</td>
                           <td>{{ $employee->address }}</td>
                           <td>{{ $employee->salary }}</td>
                           <td>{{ $employee->contact }}</td>
                           <td>{{ $employee->gender }}</td>
                           <td>{{ $employee->email }}</td>
                           <td><a class="btn btn-primary"  href="/employees/{{ $employee->id }}">View</a></td>
                           <td><a class="btn btn-info" href="/employees/{{ $employee->id }}/edit">Edit</a></td>
                           <td>
                            {{ Form::open(array('url' => 'employees/' . $employee->id, 'class' => '')) }}
                             {{ Form::hidden('_method', 'DELETE') }}
                             {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                           </td>
                       </tr>
                    @endforeach
                 
                    @if (count($employees) === 0)
                       <tr>
                           <td colspan="4">No record found.</td>
                       </tr>
                    @endif
    
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection