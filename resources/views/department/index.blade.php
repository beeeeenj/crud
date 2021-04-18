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
        <button type="button"  data-url="/departments/create/" class="btn btn-outline-primary btn-xs btn-modal"  title="Add Department">
          Add Department
        </button>
      </div>
    </div>

        <div class="card-body">
        
            
        </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection


@section('script')
<script>
   

   $(document).on("submit", ".formSubmit", function(e) {
       e.preventDefault()
       var errors = $("#errors")

       var dt = $(this)
       var action = dt.attr("action")
       var data = new FormData(this)
       $.LoadingOverlay('show')
       axios.post(action, data).then((res) => {
        errors.empty()
        $.LoadingOverlay('hide')
        if(res.data.errors) {
          
           res.data.errors.map((err) => {
            errors.append(` <div id="errors" class="alert alert-danger">${err}</div>`);
           })
        }
       
       }).catch((err) => {
         if(err.response.status == 422) {
            var errors = err.response.data.errors
         }
        $.LoadingOverlay('hide')
       })

    });
</script>
@endsection