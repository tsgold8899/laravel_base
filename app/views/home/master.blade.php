@extends('layouts.master')
@section('content')
<div class="home-content" style="display:table;">
    <div class="row">
        <div class="col-sm-6 hidden-xs area-1">
            <table>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_what_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>What.</h3>
                        <p>XXXXXX is a page of links to webpages you care about.</p>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_where_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>Where.</h3>
                        <p>Access your links on your computer, phone, or tablet.</p>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_why_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>Why.</h3>
                        <p>Stay organized and get to webpages faster.</p>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_who_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>Who.</h3>
                        <p>You and only you – your XXXXXX page is private.</p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="col-sm-6 area-2">
            @include('layouts.message')
            
            <div style="margin:0px 0px 50px 0px; text-align:center;">
                <a href="{{ url('/') }}">
                    {{ HTML::image('images/XXXXXX_logo.png', 'XXXXXX', array('style'=>'width:auto; height:45px;')) }}
                </a>
                <p>Organize your life online with a free personalized startpage.</p>
            </div>
            
            @yield('form')
        </div>
        
        <div class="col-xs-12 visible-xs area-3">
            <table>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_what_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>What.</h3>
                        <p>XXXXXX is a page of links to webpages you care about.</p>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_where_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>Where.</h3>
                        <p>Access your links on your computer, phone, or tablet.</p>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_why_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>Why.</h3>
                        <p>Stay organized and get to webpages faster.</p>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle; padding-right:20px;">
                        {{ HTML::image("images/hp_who_icon.png", "", array()) }}
                    </td>
                    <td>
                        <h3>Who.</h3>
                        <p>You and only you – your XXXXXX page is private.</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@stop
