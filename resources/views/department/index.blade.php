@extends('layouts.app')

@section('content')

<script>
  var btnAction = (action_type, id) => {
         
         if(action_type == "edit") {
           $.LoadingOverlay('show')
            //modal.find('.modal-content').empty()
            axios.get(`/departments/${id}/edit`).then((res) => { 
              modal.find('.modal-content').html(res.data)
              modal.modal('show')
              $.LoadingOverlay('hide')
            }).catch((err) => {
              $.LoadingOverlay('hide')
            })
         }
 
         if(action_type == "delete") {

            Swal.fire({
              title: 'Are you sure?',
              text: "",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.LoadingOverlay('show')
                axios.delete(`/departments/${id}`).then((res) => {
                  tbl_dtable.ajax.reload()
                  Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                  )
                  $.LoadingOverlay('hide')
                  modal.modal('hide')
                })
              }
            })
         }
     } 
</script>
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
        <button type="button"  data-url="{{ route('departments.create') }}" class="btn btn-outline-primary btn-sm btn-modal"  title="Add Department">
          Add Department
        </button>
      </div>
    </div>

        <div class="card-body">
          <table id="tbl_dtable" class="table table-bordered table-hover table-sm">
            <thead>
            <tr>
              <th>Name</th>
              <th>Code</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th style="width: 1%"></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
            
        </div>
    </div>
    <!-- /.card-body -->
@endsection


@section('script')
<script>
    var tbl_dtable =  $('#tbl_dtable').DataTable({
            searchDelay: 400,
            "paging": true,
            "lengthChange": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            pageLength: 10,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "/api/department/list",
            },
    });

   $(document).on("submit", ".formSubmit", function(e) {
       e.preventDefault()
       var errors = $("#errors")

       var dt = $(this)
       var action = dt.attr("action")
       var method = dt.attr("method")
       var data = new FormData(this)

       

       var options = {
         method,
         url: action,
         data
       }

       try {  
         method = data.get('_method') 
         if(method == "PUT") {
           options['_method'] = 'PATCH'
         }
        } catch (error) {

       }

       console.log(options)

       $.LoadingOverlay('show')
       axios(options).then((res) => {
        errors.empty()
        $.LoadingOverlay('hide')
        if(res.data.errors) {
           res.data.errors.map((err) => {
            errors.append(` <div id="errors" class="alert alert-danger">${err}</div>`);
           })

           Toast.fire({
                icon: 'error',
                title: 'The given data was invalid.'
                
           })

           topFunction()
        }

        if(res.data.success) {
          modal.modal('hide')
          
          Toast.fire({
                icon: 'success',
                title: 'Record saved!'
          })

          tbl_dtable.ajax.reload()
        }
       
       }).catch((err) => {
        $.LoadingOverlay('hide')
       })

    });

    $("#tbl_dtable").on('click', '.btn-view', function() {
        var data = $(this)
        var id = data.attr('data-id')
        $.LoadingOverlay('show')
        modal.find('.modal-content').empty()
        axios.get(`/departments/${id}`).then((res) =>{
          modal.find('.modal-content').html(res.data)
          modal.modal('show')
          $.LoadingOverlay('hide')
        }).catch((err) => {
          $.LoadingOverlay('hide')
        })
    })

    //  


    
   
</script>
@endsection