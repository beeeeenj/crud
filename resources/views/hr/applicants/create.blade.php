{{ Form::open(['url' => route('applicants.store'), 'class' => 'formSubmit', 'files' => true]) }}
<div class="modal-header">
    <h5 class="modal-title">{{ $title }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div id="errors"></div>
    <div class="row">
        <div class="col-md-12">
            {{ Form::label('job', 'Job', ['class' => '']) }}
            {{ Form::select('job', $careers, [null], ['class' => 'form-control select2bs4']) }}
        </div>
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
                {{ Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control']) }}
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
</div>
<div class="modal-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'btnSubmit']) !!}
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}


<script>
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Select Job'
    })

    $('.select2bs4').one('select2:open', function(e) {
        $('input.select2-search__field').prop('placeholder', 'Search Job');
    });

</script>
