@extends('bookmark.master')

@section('op-bar')
<?php
    $link_sort_by = (int) OptionHelper::getValue($user->id, 'link_sort_by');
?>
<div class="row op-bar">
    <div class="col-sm-3">
        <a href="{{ action('BookmarkController@create') }}" style="margin-right:10px;">+ Add</a>
        <a href="#" class="view-mode active" title="list view mode"><span class="glyphicon glyphicon-th-list"></span></a>
        <a href="#" class="view-mode" title="section view mode" style="margin-left:-5px;"><span class="glyphicon glyphicon-th"></span></a>
    </div>
    <div class="col-sm-9" style="text-align:center;">
        <div class="sorting">
            <span style="color:#999999;">Sort by</span>
            <!-- <a href="{{ url('bookmark', array('sort_by'=>'alphabetical')) }}">alphabetical</a> -->
            <a href="{{ action('BookmarkController@index', array('sort_by'=>'1')) }}" class="<?php echo ($link_sort_by == 1) ? "active" : ""; ?>">alphabetical</a>
            &nbsp;|&nbsp;
            <a href="{{ action('BookmarkController@index', array('sort_by'=>'2')) }}" class="<?php echo ($link_sort_by == 2) ? "active" : ""; ?>">most visited</a>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>
@stop

@section('form')
<table class="table table-striped bookmark-table">
    @foreach ($bookmarks as $bookmark)
    <tr>
        <td>
            <!-- <a href="{{ $bookmark->getUrl() }}" target="_blank">{{ $bookmark->name }}</a> -->
            <img src="http://www.google.com/s2/favicons?domain={{ parse_url($bookmark->getUrl(), PHP_URL_HOST) }}" style="margin-top:-3px; width:16px; height:16px;" />
            <!-- <img src="http://{{ parse_url($bookmark->getUrl(), PHP_URL_HOST) }}/favicon.ico" style="margin-top:-3px; width:16px; height:16px;" /> -->
            <!-- <a href="#" onclick="bookmark_goto({{ $bookmark->id }}, '{{ $bookmark->getUrl() }}');">{{ $bookmark->name }}</a> -->
            <label class="link" style="font-weight:normal;" onclick="bookmark_goto({{ $bookmark->id }}, '{{ $bookmark->getUrl() }}');">{{ $bookmark->name }}</label>
        </td>
        <td style="width:75px; text-align:right; vertical-align:middle;">
            <a href="{{ action('BookmarkController@edit', array($bookmark->id)) }}" title="Edit" style="margin-right:3px; color:#999999;">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="#" title="Delete" style="margin-right:3px; color:#999999;" onclick="bookmark_delete({{ $bookmark->id }});">
                <!-- <span class="glyphicon glyphicon-remove"></span> -->
                {{ HTML::image('images/x_icon.png', 'X', array('style'=>'width:14px; margin:0px 0px 0px 0px;')) }}
            </a>
        </td>
    </tr>
    @endforeach
</table>

<script>
    function bookmark_goto(bookmark_id, bookmark_url) {
        // console.log ("Bookmark Id : " + bookmark_id);
        // console.log ("Bookmark Id : " + bookmark_url);
        $.ajax({
            type: 'get',
            url: "{{ action('BookmarkController@index') }}/" + bookmark_id + '/visiting',
            data: {
            }
        })
        .done(function(response) {
            window.location = bookmark_url;
        });
    }
    
    function bookmark_delete(bookmark_id) {
        if (confirm("Are you sure to delete this link?")) {
            $.ajax({
                type: "delete",
                url: "{{ action('BookmarkController@index') }}/" + bookmark_id,
                data: {
                }
            })
            .done (function (response) {
                window.location = "{{ action('BookmarkController@index') }}";
            });
        }
    }
</script>
@stop
