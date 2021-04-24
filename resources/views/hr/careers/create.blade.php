{{ Form::open(array('url' => route('careers.store'), 'class'  => 'formSubmit','files'=>true )) }}
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
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">   
                  {{ Form::label('no_of_vacancy', 'No. of Vacancy', ['class' => '']) }}
                  {{ Form::number('no_of_vacancy', 1, ['class' => 'form-control','min' => 1]) }}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">   
                  {{ Form::label('department', 'Department', ['class' => '']) }}
                  {{ Form::select('department', $departments, [null], ['class' => 'form-control']) }}
              </div>
              </div>
            </div>
            
          <div class="form-group">   
              {{ Form::label('job_responsibility', 'Job Responsibility', ['class' => '']) }}
              {{ Form::textarea('job_responsibility', null, ['class' => 'form-control summernote','id'=> '']) }}
           </div>
           <div class="form-group">   
            {{ Form::label('educational_requirements', 'Educational Requirements', ['class' => '']) }}
            {{ Form::textarea('educational_requirements', null, ['class' => 'form-control summernote','id'=> '']) }}
           </div>

           <div class="row">
             <div class="col-md-6">
              <div class="form-group">   
                {{ Form::label('employment_status', 'Employment Status', ['class' => '']) }}
                {{ Form::select('employment_status', $employment_status, [null], ['class' => 'form-control']) }}
              </div>
             </div>
             <div class="col-md-6">
              
              <div class="form-group">   
                {{ Form::label('location', 'Location', ['class' => '']) }}
                {{ Form::text('location', 'Manila, Philippines', ['class' => 'form-control']) }}
              </div>
             </div>
           </div>

           <div class="form-group">   
            {{ Form::label('salary', 'Salary', ['class' => '']) }}
            {{ Form::text('salary', null, ['class' => 'form-control','placeholder'=> 'Optional']) }}
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
        $('.summernote').summernote({
            height: 100
        })
  </script>

 