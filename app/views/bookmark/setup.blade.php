@extends('bookmark.master')

@section('op-bar')
<div class="row op-bar">
    &nbsp;
</div>
@stop

@section('form')
{{ Form::open(array('action' => 'BookmarkController@installed', 'id'=>'frm_bookmark_create')) }}    
    <h4 style="margin:20px 0px 10px 0px;">Welcome!</h4>
    <p style="margin:0px 0px 20px 0px;">Select the sites to link to from your page. And don’t worry, you can easily add, edit, and remove links later.</p>
    
    @if ($sections)
    @foreach ($sections as $section)
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $section->name }}
        </div>
        
        <div class="panel-body">
            <?php $links = $section->links()->get(); ?>
            @if ($links)
            @foreach ($links as $link)
                <div class="col-sm-3" title="{{ $link->name }}" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis">
                    <input type="checkbox" name="links[]" value="{{ $link->id }}" />
                    {{ $link->name }}
                </div>
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
    @endif
    <div class="form-group" style="text-align:right;">
        <button type="submit" class="btn btn-primary">Done!</button>
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
       $('#frm_bookmark_create').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
    });
</script>
@stop