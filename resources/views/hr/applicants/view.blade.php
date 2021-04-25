{{ Form::open(array('url' => route('applicants.view.update',$data->id), 'class'  => 'formSubmit','files'=>true )) }}
<div class="modal-header">
    <h5 class="modal-title">{{ $data->career->title }} / {{ $data->career->department->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <p><strong>First Name</strong><br />{{ $data->first_name }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Middle Name</strong><br />{{ $data->middle_name }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Last Name</strong><br />{{ $data->last_name }}</p>
        </div>

        <div class="col-md-4">
            <p><strong>Email</strong><br />{{ $data->email }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Phone No.</strong><br />{{ $data->contact }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Gender</strong><br />{{ $data->gender }}</p>
        </div>


        <div class="col-md-12">
            <p><strong>Referred by</strong><br />{{ $data->referred_by }}</p>
        </div>
        

        <div class="col-md-6">
            <p><strong>Date Applied</strong><br />{{ $data->created_at }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Updated At</strong><br />{{ $data->updated_at }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">   
                {{ Form::label('note', 'Note', ['class' => '']) }}
                {{ Form::textarea('note', $data->note, ['class' => 'form-control summernote','id'=> '']) }}
             </div>
        </div>
        
        <div class="col-md-12 hide_status">
            <div class="form-group">   
                {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                {{ Form::select('status', array('Pending' => 'Pending', 'For Interview' => 'For Interview','Qualified'=> 'Qualified','Not Qualified'=> 'Not Qualified'), $data->status, ['class' => 'form-control ']) }}
             </div>
        </div>
       
    </div>

</div>
<div class="modal-footer">
    
    {!! Form::submit('Save', ['class' => 'btn btn-success','id'=> 'btnSubmit']) !!}

    <button type="button" onclick="btnAction('edit', {{ $data->id }})" class="btn btn-primary">Edit</button>

    @if ($data->status == "Qualified" && $data->is_hire == false)
        <button type="button" class="btn btn-danger">Create Account</button>
    @else
       <button type="button" data-toggle="tooltip" data-placement="top" title="Change status to Qualified" disabled class="btn btn-danger">Create Account</button>
    @endif

    <a href="{{ $data->file }}" target="_blank" class="btn btn-outline-info">Show File</a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
<script>

    @if ($data->is_hire == true)
        $('.hide_status').hide()
    @endif

    $('.summernote').summernote({
        height: 300
    })

    $(function () {
         $('[data-toggle="tooltip"]').tooltip()
    })
</script>

