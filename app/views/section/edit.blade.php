@extends('link.master')

@section('op-bar')
<div class="row op-bar">
    &nbsp;
</div>
@stop

@section('form')
{{ Form::open(array('action' => array('SectionController@update', $section->id), 'method'=>'put', 'id'=>'frm_section_edit')) }}
    <h4>Edit Section</h4>
    
    <div class="form-group">
        <label>Name</label>
        {{ Form::text('name', $section->name, array('class'=>'form-control', 'placeholder'=>'e.g. Travel or Work Stuff', 'data-validation-engine'=>'validate[required,custom[nameNotUrl]]')) }}
    </div>
    
    <table class="table table-striped" style="margin:0px;">
    @foreach ($links as $link)
    <tr>
        <td>
            <label style="font-weight:normal;">{{ $link->name }}</label>
        </td>
        <td style="width:75px; text-align:right; vertical-align:middle;">
            <a href="{{ action('SectionController@editLink', array('section_id' => $link->section_id, 'id' => $link->id)) }}" title="Edit" style="margin-right:3px; color:#999999;">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="#" title="Delete" style="margin-right:3px; color:#999999;" onclick="link_delete({{ $link->id }});">
                <!-- <span class="glyphicon glyphicon-remove"></span> -->
                {{ HTML::image('images/x_icon.png', 'X', array('style'=>'width:14px; margin:-3px 0px 0px 0px;')) }}
            </a>
        </td>
    </tr>
    @endforeach
</table>
    
    <div class="form-group" style="text-align:right;">
        <a href="{{ action('SectionController@index') }}" class="btn" style="padding:6px 0px;  margin: 0px 10px;">Cancel</a>
        <button type="submit" class="btn btn-primary" onclick="$('#continue').val('0'); $('#frm_section_create').update();">Save</button>
    </div>
    
    {{ Form::hidden('continue', '0', array('id'=>'continue')) }}
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_section_edit').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
    
    function link_delete(link_id) {
        if (confirm("Are you sure to delete this link?")) {
            $.ajax({
                type: "delete",
                url: "{{ action('LinkController@index') }}/" + link_id,
                data: {
                }
            })
            .done (function (response) {
                location.reload();
            });
        }
    }
</script>
@stop
