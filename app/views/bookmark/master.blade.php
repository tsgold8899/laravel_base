@extends('layouts.master')

@section('content')
<div class="header" style="position:absolute; left:0px; top:0px; width:100%; height:50px; background-color:#EEE; z-index:-1;">&nbsp;</div>
<div class="bookmark-content">
    <div class="row" style="background-color:#EEE; height:50px;">
        <!-- style="display:table-cell; width:1%;" -->
        <div class="col-sm-4">
            <a href="{{ url('/') }}" style="display:block; float:left; margin:10px 0px 0px 0px;">
                <!-- <h2>XXXXXX</h2> -->
                {{ HTML::image('images/XXXXXX_logo.png', 'XXXXXX', array('style'=>'width:auto; height:30px;')) }}
            </a>
        </div>
        <!-- <div class="col-sm-6">&nbsp;</div> -->
        <div class="col-sm-8">
            <div class="dropdown" style="float:right; margin:15px 0px 0px 0px;">
                <!-- Profile Menu -->
                <a href="#" data-toggle="dropdown" role="presentation" style="display:block; width:100%; color:#999999;">
                    <span style="float:left;">{{ $user->email }} </span> 
                    {{ HTML::image('images/dropdown_icon.png', '\/', array('style'=>'width:16px; margin:6px 0px 0px 2px;')) }}
                    <!-- <span class="glyphicon glyphicon-chevron-down" style="margin-top:3px;"></span> -->
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li role="presentation">
                        <a href="{{ url('user/'.$user->id.'/changeEmail') }}" style="text-align:left;" tabindex="-1" role="menuitem">Change Email</a>                        
                    </li>
                    <li role="presentation">
                        <a href="{{ url('user/'.$user->id.'/changePassword') }}" style="text-align:left;" tabindex="-1" role="menuitem">Change Password</a>
                    </li>
                    <li class="divider" role="presentation"></li>
                    <li role="presentation">
                        <a href="{{ url('signout') }}" style="text-align:left;" tabindex="-1" role="prsentation">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php
        // $fetch = RSS::fetch('http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml');
        // $fetch = RSS::fetch('http://www.odesk.com/jobs/rss?c1=Web+Development&c2=Web+Programming?c1=Web+Development&c2=Web+Programming');
        // $fetch = RSS::fetch('http://feeds.reuters.com/news/artsculture');
        // print_r($fetch);
        // var_dump($fetch);
    ?>
    
    @yield('op-bar')
    
    @include('layouts.message')

    <div class="row">
        <div class="col-sm-8">
            @yield('form')
        </div>
        <div class="col-sm-4">
            @include('layouts.feed')
        </div>
    </div>
</div>
@stop
