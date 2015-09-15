@extends('link.master')

@section('op-bar')
<div class="row op-bar">
    &nbsp;
</div>
@stop

@section('form')
{{ Form::open(array('action' => 'LinkController@store', 'id'=>'frm_link_create')) }}
    <h4>Add Link</h4>
    
    <div class="form-group">
        <label>Name</label>
        {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'e.g. Google', 'data-validation-engine'=>'validate[required,custom[nameNotUrl]]')) }}
    </div>
    
    <div class="form-group">
        <label>URL</label>
        {{ Form::text('url', null, array('class'=>'form-control', 'placeholder'=>'e.g. www.google.com or http://www.google.com', 'data-validation-engine'=>'')) }}
    </div>
    
    <div class="form-group" style="text-align:right;">
        <!-- <a href="#" class="btn" onclick="window.history.back();">Cancel</a> -->
        <a href="{{ action('LinkController@index') }}" class="btn" style="padding:6px 0px;">Cancel</a>
        <a href="#" class="btn" style="padding:6px 0px; margin: 0px 10px;" onclick="$('#continue').val('1'); $('#frm_link_create').submit();">Save & Add Another</a>
        <!-- <button class="btn" onclick="$('#continue').val('1'); $('#frm_link_create').submit();">Save & Add Another</button> -->
        <button type="submit" class="btn btn-primary" onclick="$('#continue').val('0'); $('#frm_link_create').submit();">Save</button>
    </div>
    
    {{ Form::hidden('continue', '0', array('id'=>'continue')) }}
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_link_create').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop
