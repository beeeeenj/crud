
<div class="modal-header">
    <h5 class="modal-title">{{  $title }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Name</strong><br/>{{ $data->name }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Code</strong><br/>{{ $data->code }}</p>
          </div>
          <div class="col-md-12">
            <p><strong>Description</strong><br/>{!! nl2br($data->description)  !!}</p>
            
          </div>
          <div class="col-md-12">
            <p><strong>Image</strong><br/>
              @if ($data->image == null)
              No image found.
              @endif
            </p>

            @if ($data->image)
            <img class="img-fluid" src="{{ asset('storage/image/department/') }}/{{ $data->image }}" />
            @endif

          </div>
        </div>   
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="btnAction('edit', {{ $data->id }})">Edit</button>
    <button type="button" class="btn btn-danger" onclick="btnAction('delete', {{ $data->id }})">Delete</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>

 