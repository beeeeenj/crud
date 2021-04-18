@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $page_title }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">{{ $page_title }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
   <!-- Default box -->
 <div class="card">
    <div class="card-header">
      <h3 class="card-title">List</h3>

      <div class="card-tools">
        <button type="button"  href="/employees/create" class="btn btn-outline-primary btn-xs"  title="Collapse">
          Add Employee
        </button>
      
      </div>
    </div>

    <div class="card-body">
       
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
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection


@section('script')
    <script>
        axios.get('https://jsonplaceholder.typicode.com/users').then((res) => {
            
        })
    </script>
@endsection