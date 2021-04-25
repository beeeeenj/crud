{{ Form::open(['url' => route('employees.store'), 'class' => 'formSubmit', 'files' => true]) }}
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
            {{ Form::label('applicant', 'Applicant', ['class' => '']) }}
            {{ Form::select('applicant', $applicants, [$selected], ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'select_id']) }}
        </div>
    </div>
    <div style="margin-top: 10px;" class="row">
        <div class="col-md-3">
            <div class="form-group ">
                {{ Form::label('first_name', 'First Name', ['class' => 'control-label']) }}
                {{ Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name']) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group ">
                {{ Form::label('middle_name', 'Middle Name', ['class' => 'control-label']) }}
                {{ Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => 'Optional', 'id' => 'middle_name']) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group ">
                {{ Form::label('last_name', 'Last Name', ['class' => 'control-label']) }}
                {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => '', 'id' => 'last_name']) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group ">
                {{ Form::label('nick_name', 'Nick Name', ['class' => 'control-label']) }}
                {{ Form::text('nick_name', null, ['class' => 'form-control', 'placeholder' => '', 'id' => 'nick_name']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('contact', 'Contact', ['class' => 'control-label']) }}
            {{ Form::text('contact', null, ['class' => 'form-control', 'id' => 'contact']) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('gender', 'Gender', ['class' => 'control-label']) }}
            {{ Form::select('gender', ['' => '', 'Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'id' => 'gender']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('birthday', 'Birthday ', ['class' => 'control-label']) }}
            {{ Form::date('birthday', null, ['class' => 'form-control dpicker', 'id' => 'birthday']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('birthplace', 'Birth Place', ['class' => 'control-label']) }}
            {{ Form::text('birthplace', null, ['class' => 'form-control', 'id' => '']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('living_arrangement', 'Living Arrangement ', ['class' => 'control-label']) }}
            {{ Form::select('living_arrangement', $living_arrangement, [null], ['class' => 'form-control ', 'style' => 'width:100%;', 'id' => '']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('present_address', 'Present Address', ['class' => 'control-label']) }}
            {{ Form::textarea('present_address', null, ['class' => 'form-control', 'rows' => '2']) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('provicial_address', 'Provicial Address', ['class' => 'control-label']) }}
            {{ Form::textarea('provicial_address', null, ['class' => 'form-control', 'rows' => '2']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('nationality', 'Nationality', ['class' => 'control-label']) }}
            {{ Form::select('nationality', $nationals, [61], ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'nationality']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('civil_status', 'Civil Status', ['class' => 'control-label']) }}
            {{ Form::select('civil_status', $civil_status, [null], ['class' => 'form-control ', 'style' => 'width:100%;', 'id' => '']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('blood_type', 'Blood Type', ['class' => 'control-label']) }}
            {{ Form::select('blood_type', $bloods, [null], ['class' => 'form-control ', 'style' => 'width:100%;', 'id' => '']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
            {{ Form::select('status', $employment_status, [null], ['class' => 'form-control ', 'style' => 'width:100%;', 'id' => '']) }}
        </div>
        <div class="col-md-4    ">
            {{ Form::label('hire_date', 'Hire Date', ['class' => 'control-label']) }}
            {{ Form::date('hire_date', null, ['class' => 'form-control dpicker', 'id' => '']) }}
            <small id="" class="form-text text-muted">Can't Update</small>
        </div>
        <div class="col-md-4">
            {{ Form::label('salary', 'Salary', ['class' => 'control-label']) }}
            {{ Form::text('salary', null, ['class' => 'form-control', 'id' => '']) }}
            
        </div>
        <div class="col-md-12">
            {{ Form::label('formal_picture', 'Formal Picture', ['class' => 'control-label']) }}
            {{ Form::file('formal_picture', null, ['class' => 'form-control ', 'id' => '']) }}

        </div>
    </div>
    <div style="margin-top: 20px;" class="row">
        <div class="col-md-12">
            <h4>User Account</h4><span style="font-size: 12px;">This part is from the IT Department to request create an
                account (For demo/under development it show for the meantime)</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('email', 'Company Email', ['class' => 'control-label']) }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
            <div class="input-group">
                {{ Form::text('password', null, ['class' => 'form-control', 'id' => 'gen_password']) }}
                <div class="input-group-append">
                    <button  class="btn btn-outline-secondary btnGenPassword" type="button">Gen. Password</button>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="modal-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'btnSubmit']) !!}
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}


<script>
    function generatePassword() {
        var length = 8,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }

    $(".btnGenPassword").on('click', function() {
        $("#gen_password").val(generatePassword())
    })

    $("#gen_password").val(generatePassword())

    var dpicker = $(".dpicker")

    //Display Only Date till today //

    var dtToday = new Date();
    var month = dtToday.getMonth() + 1; // getMonth() is zero-based
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    dpicker.attr('max', maxDate);

    $('.select2').select2({
        theme: 'bootstrap4',
        dropdownParent: $("#main-modal")
    })

    $('.select2').one('select2:open', function(e) {
        $('input.select2-search__field').prop('placeholder', 'Search');
    });




    var get_info = (id) => {
        var url = '{{ route('applicants.get_info', ':id') }}';
        url = url.replace(':id', id);
        axios.get(url).then((res) => {

            var results = res.data[0]
            for (var property in results) {
                $(`#${property}`).val(results[property])
            }

        }).catch((err) => {
            $("#first_name").val('')
            $("#middle_name").val('')
            $("#last_name").val('')
            $("#nick_name").val('')
            $("#contact").val('')
            $("#gender").val('')
        })
    }


    $("#select_id").on('change', function(e) {
        get_info($(this).val())
    })

    @if ($selected)
        get_info('{{ $selected }}')
    @endif

</script>
