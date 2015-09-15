<?php
    $welcome_signin_alert_enable = 0;
    if (isset($user) && $user->id > 0)
        $welcome_signin_alert_enable = (int) OptionHelper::getValue($user->id, 'welcome_signin_mode_alert_enable');
    
    $welcome_section_mode_alert_enable = 0;
    if (isset($user) && $user->id > 0)
        $welcome_section_mode_alert_enable = (int) OptionHelper::getValue($user->id, 'welcome_section_mode_alert_enable');
    
    /*
    $message = null;
    if (Session::has('message')) {
        $message = Session::get('message');
        Session::forget('message');
    }
     */
?>

@if ($welcome_signin_alert_enable == 1 && Session::has('welcome_signin'))
    <div class="alert alert-success alert-dismissable" >
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" onclick="disableWelcomeAlert();">×</button>
        {{ Session::get('welcome_signin') }}
        {{ Session::forget('welcome_signin') }}
    </div>
    
    <script>
        function disableWelcomeAlert() {
            $.ajax({
                type: 'get',
                url: "{{ url('user/'.$user->id.'/saveOption') }}",
                data: {
                    key: 'welcome_signin_alert_enable',
                    value: '0'
                }
            })
            .done(function(response) {
                console.log(response);
            });
        }
    </script>
@endif

@if ($welcome_section_mode_alert_enable == 1 && Session::has('welcome_section_mode'))
    <div class="alert alert-success alert-dismissable" >
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" onclick="disableWelcomeSectionModeAlert();">×</button>
        {{ Session::get('welcome_section_mode') }}
        {{ Session::forget('welcome_section_mode') }}
    </div>
    
    <script>
        function disableWelcomeSectionModeAlert() {
            $.ajax({
                type: 'get',
                url: "{{ url('user/'.$user->id.'/saveOption') }}",
                data: {
                    key: 'welcome_section_mode_alert_enable',
                    value: '0'
                }
            })
            .done(function(response) {
                console.log(response);
            });
        }
    </script>
@endif

@if (Session::has('success')) 
    <div class="alert alert-success alert-dismissable" >
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        {{ Session::get('success') }}
        {{ Session::forget('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        {{ Session::get('error') }}
        {{ Session::forget('error') }}
    </div>
@endif