@extends('link.master')

@section('op-bar')
<?php
    // if (isset($code))
        // var_dump($code);
?>
@stop

@section('form')
{{ Form::open(array('url'=>'user/'.$user->id.'/changeEmail', 'id'=>'frm_email')) }}    
    <h4>Change Email</h4>
        
    <div class="form-group">
        <label>New Email</label>
        {{ Form::text('newEmail', $user->email, array('class'=>'form-control', 'placeholder'=>'Email', 'data-validation-engine'=>'validate[required,custom[email]]')) }}
    </div>
    
    <div class="form-group" style="text-align:right;">
        <a href="{{ action('LinkController@index') }}" class="btn">Cancel</a>
        <button type="submit" class="btn btn-primary" style="" onclick="$('#frm_email').submit();">Done</button>
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_email').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop
