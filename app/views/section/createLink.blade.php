@extends('link.master')

@section('op-bar')
<div class="row op-bar">
    &nbsp;
</div>
@stop

@section('form')
{{ Form::open(array('action' => 'SectionController@storeLink', 'id'=>'frm_section_link_create')) }}
    <h4>Add Link</h4>
    
    <div class="form-group">
        <label>Name</label>
        {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'e.g. Google', 'data-validation-engine'=>'validate[required,custom[nameNotUrl]]')) }}
    </div>
    
    <div class="form-group">
        <label>URL</label>
        {{ Form::text('url', null, array('class'=>'form-control', 'placeholder'=>'e.g. www.google.com or http://www.google.com', 'data-validation-engine'=>'')) }}
    </div>
    
    <div class="form-group">
        <label>Section</label>
        <label style="font-weight:normal; color:#CCC;">(optional)</label>
        {{ Form::select('section_id', $section_selector, '', array('id'=>'section_id', 'class'=>'form-control', 'placeholder'=>'Choose a section', 'style'=>'width:50%;', 'onchange'=>'onSectionChange(this)', 'data-validation-engine'=>'')) }}
    </div>
    
    <a href="#" onclick="onClick_Create_Section();">+ Create Section</a>
    
    <div class="form-group" style="text-align:right;">
        <a href="{{ action('SectionController@index') }}" class="btn" style="padding:6px 0px;">Cancel</a>
        <a href="#" class="btn" style="padding:6px 0px; margin: 0px 10px;" onclick="$('#continue').val('1'); $('#frm_section_link_create').submit();">Save & Add Another</a>
        <button type="submit" class="btn btn-primary" onclick="$('#continue').val('0'); $('#frm_section_link_create').submit();">Save</button>
    </div>
    
    {{ Form::hidden('continue', '0', array('id'=>'continue')) }}
{{ Form::close() }}

<div id="dialog">
{{ Form::open(array('action' => 'SectionController@store', 'id'=>'frm_section_create')) }}
    <h4>Add Section</h4>
    
    <div class="form-group">
        <label>Name</label>
        {{ Form::text('name', null, array('id'=>'section_name', 'class'=>'form-control', 'placeholder'=>'e.g. Travel or Work Stuff', 'data-validation-engine'=>'validate[required,custom[nameNotUrl]]')) }}
    </div>
    
    <div class="form-group" style="text-align:right;">
        <a href="#" class="btn" style="padding:6px 0px;" onclick="onClick_Cancel_Section();">Cancel</a>
        <a href="" class="btn" style="padding:6px 0px; margin: 0px 10px;" onclick="onClick_SaveAndAdd_Section(event);">Save & Add Another</a>
        <button type="submit" class="btn btn-primary" onclick="onClick_Save_Section(event);">Save</button>
    </div>
    
    {{ Form::hidden('continue', '0', array('id'=>'continue')) }}
{{ Form::close() }}
</div>

<style>
    select#section_id option {
        color: #555;
    }
    
    select#section_id option[value='0'] {
        color: #999;
    }
    
    .ui-widget-overlay.ui-front {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0px;
        left: 0px;
        background-color: rgba(0,0,0, 0.6);
    } 
    
    .ui-dialog {
        padding: 1px 10px 1px 10px;
        background-color: #FFF;
    }
        .ui-dialog .ui-dialog-titlebar {
            height: 0px;
            display: none;
        }
</style>

<script>
    $(document).ready(function() {
       $('#frm_section_link_create').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
       onSectionChange($('#section_id'));
       
       $('#frm_section_create').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
       $("#dialog").dialog({
           width: 320,
           autoOpen: false,
           modal: true,
       });
    });
    
    function onClick_Create_Section() {
        $('#section_name').val('');
        $('#dialog').dialog('open');
    }
    
    function onClick_Cancel_Section() {
        $('#dialog').dialog('close');
    }
    
    function onClick_SaveAndAdd_Section(event) {
        event.preventDefault();
        
        // refreshSections(17);
        var isValid = $('#frm_section_create').validationEngine('validate');
        // console.log("Valid : " + isValid);
        
       if (isValid) {
            $.ajax({
                type: "post",
                url: "{{ action('SectionController@store') }}",
                data: {
                    name: $("#section_name").val()
                }
            })
            .done(function(response) {
                // console.log("Created Section Id : " + response.data);
                if (response.code == 1) {
                    refreshSections(response.data);
                    $("#section_name").val("");
                }
            });
        }
    }
    
    function onClick_Save_Section(event) {
        event.preventDefault();
        
        var isValid = $('#frm_section_create').validationEngine('validate');
        // console.log("Valid : " + isValid);
        
       if (isValid) {
            $.ajax({
                type: "post",
                url: "{{ action('SectionController@store') }}",
                data: {
                    name: $("#section_name").val()
                }
            })
            .done(function(response) {
                // console.log("Created Section Id : " + response.data);
                if (response.code == 1) {
                    refreshSections(response.data);
                    $("#section_name").val("");
                    $('#dialog').dialog('close');
                }
            });
        }
    }
    
    //===== onChange handler for a drop down "choose a section" =====//
    function refreshSections(section_id = 0) {
        $.ajax({
            type: "get",
            url: "{{ action('SectionController@getSections') }}",
            data: {
            }
        })
        .done(function(response) {
            // $('#section_id option').remove();
            
            // console.log(response);
            var sections = response.data;
            var sectionDropDownList = $('#section_id');
            
            sectionDropDownList.html('');
            // console.log(sections);
            // console.log(sections.length);
            for (i = 0; i < sections.length; i ++) {
                section = sections[i];
                
                if (section_id && section_id > 0 && section['id'] == section_id) {
                    sectionDropDownList.append('<option value="' + section['id'] + '" selected>' + section['name'] + '</option>');
                    sectionDropDownList.css({
                        'color': '#555'
                    });
                } else {
                    $('#section_id').append('<option value="' + section['id'] + '">' + section['name'] + '</option>');
                }
            }
        });
    }
    
    function onSectionChange(obj) {
       if ($(obj).val() == 0 ) {
           $(obj).css({
               'color': '#999',
           });
       } else {
           $(obj).css({
               'color': '#555',
           });
       }
    }
</script>
@stop
