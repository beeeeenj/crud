@extends('layouts.app_job')

@section('page_title')
{{ $data->title }}
@endsection

@section('content')

    <!-- Header Section End -->

    <!-- Page Header Start -->
    <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">{{ $data->title }}</h2>
                        <ol class="breadcrumb">
                            <li class="current">{{ $data->department->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9 col-md-offset-2">
                    <div class="page-ads box">

                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                Thank you for filling our form. Now we are gathering your data and will contact you soon.
                            </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        {{ Form::open(array('url' => route('careers.apply.store',$data->slug), 'class'  => 'form-ad','files'=>true )) }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        {{ Form::label('first_name', 'First Name', ['class' => 'control-label']) }}
                                        {{ Form::text('first_name', null, ['class' => 'form-control']) }}
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        {{ Form::label('middle_name', 'Middle Name', ['class' => 'control-label']) }}
                                        {{ Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => 'Optional']) }}
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        {{ Form::label('last_name', 'Last Name', ['class' => 'control-label']) }}
                                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => '']) }}
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        {{ Form::label('gender', 'Gender', ['class' => 'control-label']) }}
                                        {{ Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), null, ['class' => 'form-control']) }}
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '']) }}
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        {{ Form::label('contact', 'Phone No.', ['class' => 'control-label']) }}
                                        {{ Form::text('contact', null, ['class' => 'form-control']) }}
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        {{ Form::label('referred_by', 'Referred by', ['class' => 'control-label']) }}
                                        {{ Form::text('referred_by', null, ['class' => 'form-control', 'placeholder' => '(Optional)']) }}
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::label('file', 'Upload File (CV)', ['class' => 'control-label']) }}
                                    {{ Form::file('file', null, ['class' => 'form-control', 'placeholder' => '']) }}
                                   
                                </div>
                            </div>

                            <div style="margin-top: 20px;" class="row">
                                <div class="col-md-12">
                                    By submitting, I declare that I am applying for a job at COMPANY NAME and that all information and representations I have made in this on-line application form and during the application and evaluation process are true and correct.
                                    <br/> <br/>
                                    I hereby allow and give my full consent to COMPANY NAME to share my personal information to its affiliates and subsidiaries and to verify and provide such information with other companies, entities, persons and government agencies, solely for the purpose of job applications.
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        {{ Form::label('agreement', 'Do you agree?', ['class' => 'control-label']) }}
                                    {{ Form::checkbox('agreement', null) }}
                                 
                                   </div>
                                </div>
                            </div>

                            {!! Form::submit('Submit your job', ['class' => 'btn btn-common btn-block ','id'=> 'btnSubmit','style'=>'margin-top: 20px;']) !!}
                       
                            {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    
@endsection
