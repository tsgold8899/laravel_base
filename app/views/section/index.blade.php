@extends('link.master')

@section('op-bar')
<?php
    $links = array();
    $link_sort_by = (int) OptionHelper::getValue($user->id, 'link_sort_by');
    
    $columns = Array();
    for ($i = 0; $i < 3; $i ++) {
        $columns[$i] = $user->sections()->where('x', '=', $i)->orderby('y')->get();
    }
?>
<div class="row op-bar">
    <div class="col-sm-3">
        <!-- <a href="#" style="margin-right:10px;">+ Add</a> -->
        
        <div class="dropdown" style="float:left; margin: 16px 10px 0px 0px; line-height:16px;">
            <!-- Add Menu -->
            <a href="#" data-toggle="dropdown" role="presentation">
                + Add
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li role="presentation">
                    <a href="{{ action('SectionController@createLink') }}" style="text-align:left;" tabindex="-1" role="menuitem">Add Link</a>
                </li>
                <li role="presentation">
                    <a href="" style="text-align:left;" tabindex="-1" role="menuitem" onclick="onClick_Create_Section(event);">Add Section</a>
                </li>
            </ul>
        </div>
        
        <a href="{{ action('LinkController@index', array('view_mode_switched'=>'1')) }}" class="view-mode" title="list view mode"><span class="glyphicon glyphicon-th-list"></span></a>
        <a href="#" class="view-mode active" title="section view mode" style="margin-left:-5px;"><span class="glyphicon glyphicon-th"></span></a>
    </div>
</div>
@stop

@section('form')
<div class="row link-sort section-sort" style="margin-top:40px;">
    @foreach ($columns as $sections)
    <div class="col-md-4 column">
        <?php
            if ($sections && $sections->count() > 0) {
                foreach ($sections as $section) {
                    $links = $section->links()->orderby('y')->get();
        ?>
    
        <div class="panel panel-default section-panel" data-section-id="{{ $section->id }}">
            <div class="panel-heading">
                {{ $section->customizedName() }}
                @if (!$section->isMiscellaneous()) 
                    <span style="float:right; margin:-4px 0px 0px 0px;">
                        <a href="{{ action('SectionController@edit', array($section->id)) }}" title="Edit" style="margin-right:3px; color:#999999;">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="#" title="Delete" style="margin-right:3px; color:#999999;" onclick="section_delete({{ $section->id }});">
                            {{ HTML::image('images/x_icon.png', 'X', array('style'=>'width:14px; margin:-3px 0px 0px 0px;')) }}
                        </a>
                        <span class="glyphicon glyphicon-align-justify" style="margin:6px 0px 0px 0px; color:#999999;"></span>
                    </span>
                @else
                    <span style="float:right; margin:-4px 0px 0px 0px;">
                        <span class="glyphicon glyphicon-align-justify" style="margin:6px 0px 0px 0px; color:#999999;"></span>
                    </span>
                @endif
            </div>
            <div class="panel-body">
                <ul class="list-unstyled link-list">
                    @if ($links and $links->count() > 0)
                        @foreach ($links as $link)
                        <li data-link-id="{{ $link->id }}">
                            {{ $link->name }}
                            <span class="glyphicon glyphicon-align-justify" style="float:right; margin:6px 0px 0px 0px; color:#999999;"></span>
                        </li>
                        @endforeach
                    @else
                        <span class="description" style="color:#999999;">
                            Drag and drop a link here or select + Add > Add Link above.
                        </span>
                    @endif
                </ul>
            </div>
        </div>
        
        <?php
            }}
        ?>
    </div>
    @endforeach
</div>

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
    .panel.section-panel {
        
    }
        
        .panel.section-panel .panel-heading {
            padding: 10px 10px 10px 10px;*/
        }
        
        .panel.section-panel .panel-body {
            padding: 5px 10px 5px 10px;*/
        }
        .panel.section-panel ul.link-list {
            margin-bottom: 0px;
            padding: 5px 0px 5px 0px;
        }
        
            .panel.section-panel ul.link-list li {
                line-height: 30px;
            }
    
    .column {
        padding-bottom: 0px;
    }
    
    @media (min-width:768px) {
        .column {
            padding-bottom: 100px;
        }
    }
    
    .panel-placeholder {
        border: 1px dotted black;
        margin: 0px 0px 20px 0px;
        height: 50px;
    }
    
    .link-placeholder {
        border: 1px dotted black;
        margin: 0px 0px 0px 0px;
        height: 30px;
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
        position: fixed;
        padding: 1px 10px 1px 10px;
        background-color: #FFF;
    }
        .ui-dialog .ui-dialog-titlebar {
            height: 0px;
            display: none;
        }
</style>

<script>
    $(function() {
        $(".column").sortable({
            connectWith: ".column",
            handle: ".panel-heading",
            placeholder: "panel-placeholder",
            cursor: "move",
            update: function(event, ui) {
               //===== save orders in 1-dimentions[{"id":id, "x":x, "y":y}] =====//
               // console.log($(ui));
               // console.log($(ui.item).html());
               // console.log(ui.sender);
               
               if (ui.sender == null) {
                    var orders = [];
                    var column_length = $(".column").length;
                    var i = 0;
                    for (i = 0; i < column_length; i++) {
                        var current_column = $(".column")[i];
                        $(current_column).children().each(function(j) {
                            var id = $(this).attr('data-section-id'), order = $(this).index();
                            // console.log("id : " + id + " - order : " + order);
                            orders.push({"id": id, "x": i, "y": order});
                        });
                    }
                    console.log(JSON.stringify(orders));
                    
                    $.ajax({
                        type: 'post',
                        url: "{{ action('SectionController@saveSectionOrder') }}",
                        data: {
                            orders: orders
                        }
                    })
                    .done(function(response) {
                        // window.location = link_url;
                        console.log("Section orders have been saved successfully.");
                    });
                }
            }
        });
        
        $("ul.link-list").sortable({
            connectWith: "ul.link-list",
            placeholder: "link-placeholder",
            cancel: "span.description",
            cursor: "move",
            update: function(event, ui) {
                console.log($(this));
                if ($(this).children('li').length > 0) {
                    $(this).children('span').remove();
                } else {
                    $(this).html('<span class="description" style="color:#999999;">Drag and drop a link here or select + Add > Add Link above.</span>');
                }
                //===== save link order =====//
                if (ui.sender == null) {
                    var current_section = $(ui.item).parent();
                    var section_id = $(ui.item).parents('.panel').attr('data-section-id');
                    // console.log(current_section);
                    // console.log(section_id);
                    
                    var orders = [];
                    $(current_section).children('li').each(function(j) {
                        //console.log($(this));
                        var id = $(this).attr('data-link-id'), order = $(this).index();
                        // console.log("id : " + id + " - order : " + order);
                        orders.push({"id": id, "section_id": section_id, "y": order});
                    });
                    console.log(JSON.stringify(orders));
                    
                    $.ajax({
                        type: 'post',
                        url: "{{ action('SectionController@saveLinkOrder') }}",
                        data: {
                            orders: orders
                        }
                    })
                    .done(function(response) {
                        // window.location = link_url;
                        console.log("Link orders have been saved successfully.");
                    });
                }
            }
        });
        
        $('#frm_section_create').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
        $("#dialog").dialog({
            width: 320,
            autoOpen: false,
            modal: true,
            beforeClose: function( event, ui ) {
                location.reload();
            }
        });
    });
    
    function onClick_Create_Section(event) {
        event.preventDefault();
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
                    addNewSection(response.data);
                    $("#section_name").val("");
                }
            });
        }
        
        // addNewSection(26);
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
                    addNewSection(response.data);
                    $("#section_name").val("");
                    $('#dialog').dialog('close');
                }
            });
        }
    }
    
    function addNewSection(section_id) {
        var first_column = $(".column")[0];
        
        $.ajax({
            type: "post",
            url: "{{ action('SectionController@newSection') }}",
            data: {
                section_id: section_id
            }
        })
        .done(function(response) {
            // console.log(response.data)
            $(first_column).append(response.data);
            // $(".column").sortable("refresh");
            $("ul.link-list").sortable("refresh");
        });
            
            
        /*
        var str = '';
        str += '<div class="panel panel-default section-panel" data-section-id="' + section_id + '">' + '\n';
        str += '<div class="panel-heading">' + section_name + '\n';
        str += '<span style="float:right;">' + '\n';
        str += '<a href="' + section_edit_url + '" title="Edit" style="margin-right:3px; color:#999999;">' + '\n'; 
        str += '<span class="glyphicon glyphicon-pencil"></span></a>' + '\n';
        str += '<a href="#" title="Delete" style="margin-right:3px; color:#999999;" onclick="section_delete({{ $section->id }});">' + '\n';
        str += 'image';
        */
    }
    
    function section_goto(section_id, link_url) {
        $.ajax({
            type: 'get',
            url: "{{ action('LinkController@index') }}/" + link_id + '/visiting',
            data: {
            }
        })
        .done(function(response) {
            window.location = link_url;
        });
    }
    
    function section_delete(section_id) {
        if (confirm("Are you sure to delete this section?")) {
            $.ajax({
                type: "delete",
                url: "{{ action('SectionController@index') }}/" + section_id,
                data: {
                }
            })
            .done (function (response) {
                window.location = "{{ action('SectionController@index') }}";
            });
        }
    }
</script>
@stop

