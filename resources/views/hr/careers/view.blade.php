
<div class="modal-header">
    <h5 class="modal-title">{{  $title }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <p><strong>Title</strong><br/>{{ $data->title }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>No. of Vacancy</strong><br/>{{ $data->no_of_vacancy }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Department</strong><br/>{{ $data->department->name }}</p>
          </div>
          <div class="col-md-12">
            <p><strong>Job Responsibility</strong><br/>{!! nl2br($data->description)  !!}</p>
          </div>
          <div class="col-md-12">
            <p><strong>Educational Requirements</strong><br/>{!! nl2br($data->educational_requirements)  !!}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Employment Status</strong><br/>{{ $data->employment_status }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Location</strong><br/>{{ $data->location }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Salary</strong><br/>{{ $data->salary }}</p>
          </div>

          <div class="col-md-12">
            <p><strong>Is Hiring</strong><br/>
              @if ($data->status)
              <span class="badge badge-success">Open</span>
              @else
              <span class="badge badge-danger">Closed</span>
              @endif
          
            </p>
          </div>
          <div class="col-md-6">
            <p><strong>Created At</strong><br/>{{ $data->created_at }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Updated At</strong><br/>{{ $data->updated_at }}</p>
          </div>

          
        </div>   
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="btnAction('edit', {{ $data->id }})">Edit</button>
    <a type="button" target="_blank" href="{{ route('careers.view', $data->slug) }}" class="btn btn-info" >Preview</a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>

 