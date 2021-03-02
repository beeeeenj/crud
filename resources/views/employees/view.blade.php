@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2 mb-5">
        <a class="btn btn-outline-primary" href="/">Back</a>
        <a class="btn btn-outline-primary" href="/employees/{{ $employee->id }}/edit">Edit</a>
        
    </div>
</div>
<div class="row">
    <div class="col-sm-8 offset-sm-2 mb-5">
        <h1 class="display-5">{{ $employee->name }}</h1>
        <table class="table table-bordered">
            <tr>
                <td>Address</td>
                <td>{{ $employee->address }}</td>
            </tr>
            <tr>
                <td>Salary</td>
                <td>{{ $employee->salary }}</td>
            </tr>
            <tr>
                <td>Contact</td>
                <td>{{ $employee->contact }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $employee->gender }}</td>
            </tr>
        </table>
        {{ Form::open(array('url' => 'employees/' . $employee->id, 'class' => '')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
       {{ Form::close() }}
    </div>
</div>  
@endsection