{{ Form::open(array('url' => route('departments.store'), 'class'  => 'formSubmit','files'=>true )) }}
<div class="modal-header">
    <h5 class="modal-title">{{  $title }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
           <div id="errors"></div>
            <div class="form-group">   
                {{ Form::label('name', 'Name', ['class' => '']) }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">   
              {{ Form::label('description', 'Description', ['class' => '']) }}
              {{ Form::textarea('description', null, ['class' => 'form-control']) }}
          </div>
            <div class="form-group">   
                {{ Form::label('code', 'Code', ['class' => '']) }}
                {{ Form::text('code', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">   
              {{ Form::label('image', 'Image', ['class' => '']) }}
              {{ Form::file('image', null, ['class' => 'form-control','accept' => 'image/*']) }}
          </div>
  </div>
  <div class="modal-footer">
   {!! Form::submit('Save', ['class' => 'btn btn-success','id'=> 'btnSubmit']) !!}
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
  {{ Form::close() }}


 