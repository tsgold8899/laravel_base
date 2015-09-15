@extends('link.master')

@section('op-bar')
<div class="row op-bar">
    &nbsp;
</div>
@stop

@section('form')
{{ Form::open(array('action' => 'SectionController@store', 'id'=>'frm_section_create')) }}
    <h4>Add Section</h4>
    
    <div class="form-group">
        <label>Name</label>
        {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'e.g. Travel or Work Stuff', 'data-validation-engine'=>'validate[required,custom[nameNotUrl]]')) }}
    </div>
    
    <div class="form-group" style="text-align:right;">
        <a href="{{ action('SectionController@index') }}" class="btn" style="padding:6px 0px;">Cancel</a>
        <a href="#" class="btn" style="padding:6px 0px; margin: 0px 10px;" onclick="$('#continue').val('1'); $('#frm_section_create').submit();">Save & Add Another</a>
        <button type="submit" class="btn btn-primary" onclick="$('#continue').val('0'); $('#frm_section_create').submit();">Save</button>
    </div>
    
    {{ Form::hidden('continue', '0', array('id'=>'continue')) }}
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_section_create').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop
