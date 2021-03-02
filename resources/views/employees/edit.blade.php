@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2 mb-5">
        <a class="btn btn-outline-primary" href="/">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-8 offset-sm-2 mb-5">
        <h1 class="display-5">Update Employee</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

      
        {{ Form::model($employee, array('route' => array('employees.update', $employee->id), 'method' => 'PUT')) }}
            <div class="form-group">   
                {{ Form::label('name', 'Name', ['class' => '']) }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">   
                {{ Form::label('address', 'Address', ['class' => '']) }}
                {{ Form::textarea('address', null, ['class' => 'form-control', 'rows'=> '2']) }}
            </div>
            <div class="form-group">   
                {{ Form::label('salary', 'Salary', ['class' => '']) }}
                {{ Form::number('salary', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">   
                {{ Form::label('contact', 'Contact', ['class' => '']) }}
                {{ Form::number('contact', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">   
                {{ Form::label('email', 'Email', ['class' => '']) }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}
            </div>
            
            <div class="form-group">   
                {{ Form::label('gender', 'Gender', ['class' => '']) }}
                {{ Form::select('gender', array('' => '', 'Male' => 'Male', 'Female' => 'Female'), null, array('class' => 'form-control')) }}
            </div>

            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

        {{ Form::close() }}
      
    </div>
</div>  
@endsection