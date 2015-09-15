@extends('link.master')

@section('op-bar')
<?php
    // if (isset($code))
        // var_dump($code);
?>
@stop

@section('form')
{{ Form::open(array('url'=>'user/'.$user->id.'/changePassword', 'id'=>'frm_password')) }}    
    <h4>Change Password</h4>

    <div class="form-group">
        <label>New Password</label>
        {{ Form::password('newPassword', array('id'=>'newPassword', 'class'=>'form-control', 'placeholder'=>'Password', 'data-validation-engine'=>'validate[required]')) }}
    </div>
    
    <div class="form-group">
        <label>Confirm Password</label>
        {{ Form::password('confirmPassword', array('class'=>'form-control', 'placeholder'=>'Re-enter Password', 'data-validation-engine'=>'validate[required,equals[newPassword]]')) }}
    </div>
    
    <div class="form-group" style="text-align:right;">
        <a href="{{ action('LinkController@index') }}" class="btn">Cancel</a>
        <button type="submit" class="btn btn-primary" style="" onclick="$('#frm_password').submit();">Done</a>
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_password').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop
