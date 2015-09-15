@extends('link.master')

@section('op-bar')
<div class="row op-bar">
    &nbsp;
</div>
@stop

@section('form')
{{ Form::open(array('action' => array('LinkController@update', $link->id), 'method'=>'put', 'id'=>'frm_link_edit')) }}    
    <h4>Edit Link</h4>
        
    <div class="form-group">
        <label>Name</label>
        {{ Form::text('name', $link->name, array('class'=>'form-control', 'placeholder'=>'e.g. Google', 'data-validation-engine'=>'validate[required,custom[nameNotUrl]]')) }}
    </div>
    
    <div class="form-group">
        <label>URL</label>
        {{ Form::text('url', $link->url, array('class'=>'form-control', 'placeholder'=>'e.g. www.google.com or http://www.google.com', 'data-validation-engine'=>'')) }}
    </div>
    
    <div class="form-group" style="text-align:right;">
        <!-- <a href="#" class="btn" onclick="window.history.back();">Cancel</a> -->
        <a href="{{ action('LinkController@index') }}" class="btn" style="padding:6px 0px; margin-right:20px;">Cancel</a>
        <button type="submit" class="btn btn-primary" style="" onclick="$('#frm_link_edit').submit();">Save</button>
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_link_edit').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop
