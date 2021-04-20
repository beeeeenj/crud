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
                {{ Form::label('title', 'Title', ['class' => '']) }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">   
                {{ Form::label('department', 'Department', ['class' => '']) }}
                {{ Form::select('department', $departments, [null], ['class' => 'form-control']) }}
            </div>

            <div class="form-group">   
              {{ Form::label('description', 'Description', ['class' => '']) }}
              {{ Form::textarea('description', null, ['class' => 'form-control','id'=> 'summernote']) }}
           </div>

           <div class="form-group">   
            {{ Form::label('status', 'Is hiring', ['class' => '']) }}
            {{ Form::checkbox('status', null, []) }}
         </div>

  </div>
  <div class="modal-footer">
   {!! Form::submit('Save', ['class' => 'btn btn-success','id'=> 'btnSubmit']) !!}
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
  {{ Form::close() }}


  <script>
        $('#summernote').summernote({
            height: 500
        })
  </script>

 