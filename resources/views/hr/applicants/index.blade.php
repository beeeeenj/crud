@extends('layouts.app')

@section('content')

<script>
  var btnAction = (action_type, id) => {
         if(action_type == "edit") {
          var url = '{{ route("applicants.edit", ":id") }}';
          url = url.replace(':id',id);

           $.LoadingOverlay('show')
            //modal.find('.modal-content').empty()
            axios.get(url).then((res) => { 
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
                axios.delete(`/hr/careers/${id}`).then((res) => {
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
            <li class="breadcrumb-item"><a href="#">Human Resources</a></li>
            <li class="breadcrumb-item"><a href="#">Recruitment</a></li>
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
        <div id="status_selector" class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-sm btn-warning active">
              <input type="radio" name="options" id="option1" value="Pending" autocomplete="off" checked> Pending (0) 
            </label>
            <label class="btn btn-sm btn-warning">
              <input type="radio" name="options" id="option2" value="For Interview" autocomplete="off"> For Interview (0) 
            </label>
            <label class="btn btn-sm btn-warning">
              <input type="radio" name="options" id="option3" value="Qualified" autocomplete="off"> Qualified (0) 
            </label>
            <label class="btn btn-sm btn-warning">
                <input type="radio" name="options" id="option4" value="Not Qualified" autocomplete="off"> Not Qualified (0) 
              </label>
          </div>
        <button type="button"  data-url="{{ route('applicants.create') }}" class="btn btn-outline-primary btn-sm btn-modal"  title="Add Applicant">
          Add Applicant
        </button>
      </div>
    </div>

        <div class="card-body">
          <table id="tbl_dtable" class="table table-bordered table-hover table-sm">
            <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone No.</th>
              <th>Referred by</th>
              <th>Department</th>
              <th>Job</th>
              <th>Location</th>
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

    var status = "Pending"
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
                url: "{{ route('applicant.list') }}",
                data: function(d) {
                    d.status = status
                }
            },
    });

    $("#status_selector input").on('click', function() {
        status = $(this).val()
        tbl_dtable.ajax.reload()
    })


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
          Toast.fire({
                icon: 'error',
                title: 'Internal Server Error'
                
           })
        $.LoadingOverlay('hide')
       })

    });

    $("#tbl_dtable").on('click', '.btn-view', function() {
        var data = $(this)
        var id = data.attr('data-id')
        $.LoadingOverlay('show')
        modal.find('.modal-content').empty()

        var url = '{{ route("applicants.show", ":id") }}';
        url = url.replace(':id',id);

        axios.get(`${url}`).then((res) =>{
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