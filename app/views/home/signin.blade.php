@extends('home.master')

@section('form')
<?php
    // var_dump($failure);
?>

{{ Form::open(array('url'=>url('signin'), 'id'=>'frm_signin', 'style'=>'text-align:center;')) }}
    <div class="form-group">
        {{ Form::text('email', $user->email, array('class'=>'form-control', 'placeholder'=>'Email', 'data-validation-engine'=>'validate[required,custom[email]]')) }}        
    </div>
    <div class="form-group">
        {{ Form::password('password', array('id'=>'password', 'class'=>'form-control', 'placeholder'=>'Password', 'data-validation-engine'=>'validate[required]')) }}
    </div>
    <div class="form-group" style="text-align:left;">
        {{ Form::checkbox('remember', $user->remember) }}
        &nbsp;Remember me
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" style="width:70%;" onclick="$('#frm_signin').submit();">Sign In</button>
        <!-- <a href="#" class="btn btn-primary" style="width:70%;" onclick="$('#frm_signin').submit();">Sign In</a> -->
    </div>
    <div class="form-group">
        <a href="{{ url('forgotPassword') }}">Forgot your password?</a>
        &nbsp;|&nbsp; 
        <a href="{{ url('signup') }}">Sign Up</a>
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_signin').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop