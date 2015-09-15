@extends('home.master')

@section('form')
{{ Form::open(array('url'=>url('requestResetPassword'), 'method'=>'post', 'id'=>'frm_forgot_password', 'style'=>'text-align:center;')) }}
    <div class="form-group">
        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email', 'data-validation-engine'=>'validate[required,custom[email]]')) }}
    </div>
    <div class="form-group" style="text-align:center;">
        <button type="submit" class="btn btn-primary" onclick="$('#frm_forgot_password').submit();">Request Reset Password</button>
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_forgot_password').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop