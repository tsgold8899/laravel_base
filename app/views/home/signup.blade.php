@extends('home.master')
@section('form')
<?php 
    // var_dump($user); 
?>

{{ Form::open(array('url'=>url('signup'), 'id'=>'frm_signup', 'style'=>'text-align:center;')) }}
    <div class="form-group">
        {{ Form::text('email', $user->email, array('class'=>'form-control', 'placeholder'=>'Email', 'data-validation-engine'=>'validate[required,custom[email]]')) }}        
    </div>
    <div class="form-group">
        {{ Form::password('password', array('id'=>'password', 'class'=>'form-control', 'placeholder'=>'Password', 'data-validation-engine'=>'validate[required]')) }}
    </div>
    <div class="form-group">
        {{ Form::password('confirm_password', array('class'=>'form-control', 'placeholder'=>'Re-enter Password', 'data-validation-engine'=>'validate[required,equals[password]]')) }}        
    </div>
    <div class="form-group">
        <input type="checkbox" name="agree" data-validation-engine="validate[required]" /> I agree to <a href="{{ url('terms') }}" target="_blank">XXXXXX Terms</a>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" style="width:70%;" onclick="$('#frm_signup').submit();">Sign Up</button>
    </div>
    <div class="form-group">
        or <a href="{{ url('signin') }}">Sign In</a>
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_signup').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
<!--
<form style="text-align: center;">
    <h1>XXXXXX</h1>
    <p>Organize your life online with a free personalized startpage.</p>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Email" />
    </div>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Password" />
    </div>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Re-enter Password" />
    </div>
    <div class="form-group">
        <input type="checkbox" /> I agree to <a href="#">XXXXXX Terms</a>
    </div>
    <div class="form-group">
        <a href="signup" class="btn btn-primary" style="width:70%;">Sign Up</a>
    </div>               
    <div class="form-group">
        or <a href="signin">Sign In</a>
    </div>
</form>
-->
@stop