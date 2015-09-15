<div class="panel panel-default section-panel" data-section-id="{{ $section->id }}">
    <div class="panel-heading">
        {{ $section->customizedName() }}
        @if (!$section->isMiscellaneous()) 
        <span style="float:right;">
            <a href="{{ action('SectionController@edit', array($section->id)) }}" title="Edit" style="margin-right:3px; color:#999999;">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="#" title="Delete" style="margin-right:3px; color:#999999;" onclick="section_delete({{ $section->id }});">
                {{ HTML::image('images/x_icon.png', 'X', array('style'=>'width:14px; margin:0px 0px 0px 0px;')) }}
            </a>
        </span>
        @endif
    </div>
    <div class="panel-body">
        <ul class="list-unstyled link-list">
            @if ($links and $links->count() > 0)
                @foreach ($links as $link)
                <li data-link-id="{{ $link->id }}">
                    {{ $link->name }}
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