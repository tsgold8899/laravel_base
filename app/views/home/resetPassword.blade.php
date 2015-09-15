@extends('home.master')

@section('form')
<style>
    input:-webkit-autofill, input:-webkit-autofill:focus, input:focus:-webkit-autofill {
        -webkit-box-shadow: 0 0 0px 1000px #FFF inset;
        background-color: #FFF !important;
        color:#555;
    }
    
    input.not_visited, input.not_visited:-webkit-autofill, input.not_visited:-webkit-autofill:focus, input.not_visited:focus:-webkit-autofill {
        color:#999;
    }
</style>
{{ Form::open(array('url'=>url('changePassword'), 'method'=>'post', 'id'=>'frm_reset_password', 'autocomplete'=>'off', 'style'=>'text-align:center;')) }} 
    <div class="form-group">
        {{ Form::text('email', '', array('id'=>'email', 'class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Email', 'data-validation-engine'=>'validate[required,custom[email]]')) }}
    </div>
    <div class="form-group">
        {{ Form::text('code', '', array('id'=>'code', 'class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Reset Code', 'data-validation-engine'=>'validate[required]')) }}
    </div>
    <div class="form-group">
        {{ Form::password('password', array('id'=>'password', 'class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Password', 'data-validation-engine'=>'validate[required]')) }}
    </div>
    <div class="form-group">
        {{ Form::password('confirm_password', array('id'=>'confirm_password', 'class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Re-enter Password', 'data-validation-engine'=>'validate[required,equals[password]]')) }}        
    </div>
    <div class="form-group" style="text-align:center;">
        <button type="submit" class="btn btn-primary" onclick="$('#frm_reset_password').submit();">Change Password</button>
    </div>
{{ Form::close() }}

<script >
    $(document).ready(function() {
        $('#frm_reset_password').validationEngine('attach', {promptPosition:'bottomRight', scroll:false});
        
        if (navigator.userAgent.toLowerCase().indexOf('chrome') >= 0) {
            /*
            $('input:-webkit-autofill').each(function() {
                var type = $(this).attr('type');
                var name = $(this).attr('name');
                console.log(this.outerHTML);
                $(this).remove();
                // $(this).after(this.outerHTML).remove();
                // $('input[name=' + name +']').val('');
            });
            */
            /*
            setTimeout(function() {
                $('input[autocomplete="off"]').each(function(index, obj) {
                    var inputText = $(obj);
                    console.log("Before: " + inputText.val());
                    inputText.val('');
                    console.log("After:" + inputText.val());
                });
            }, 1000);
           */
           
           
           var bVisitedOnEmail = false;
           var bVisitedOnCode = false;
           var bVisitedOnPassword = false;
           var bVisitedOnConfirmPassword = false;
           
            $('#email').val('Email');
            $('#code').val('Reset Code');
            $('#password').val('Password');
            $('#confirm_password').val('Re-enter Password');
            
            $('#email').addClass('not_visited');
            $('#code').addClass('not_visited');
            $('#password').addClass('not_visited');
            $('#confirm_password').addClass('not_visited');
            
            $('#password').prop('type', 'text');
            $('#confirm_password').prop('type', 'text');
            
            $('#email').focus(function(e) {
                if (!bVisitedOnEmail) {
                    bVisitedOnEmail = true;
                    $('#email').removeClass('not_visited');
                    $('#email').val('');
                }
            });
            $('#code').focus(function(e) {
                if (!bVisitedOnCode) {
                    bVisitedOnCode = true;
                    $('#code').removeClass('not_visited');
                    $('#code').val('');
                }
            });
            $('#password').focus(function(e) {
                if (!bVisitedOnPassword) {
                    bVisitedOnPassword = true;
                    $('#password').prop('type', 'password');
                    $('#password').removeClass('not_visited');
                    $('#password').val('');
                }
            });
            $('#confirm_password').focus(function(e) {
                if (!bVisitedOnConfirmPassword) {
                    bVisitedOnConfirmPassword = true;
                    $('#confirm_password').prop('type', 'password');
                    $('#confirm_password').removeClass('not_visited');
                    $('#confirm_password').val('');
                }
            });
           
           
           /*
           var _loopCount = 0;
           var _interval = window.setInterval(function(){
               _loopCount ++;
               var autofills = $('input:-webkit-autofill');
               if (autofills.length > 0) {
                   autofills.each(function() {
                        var clone = $(this).clone(true, true);
                        $(this).after(clone).remove();
                        $(clone).val('');
                   });
               } 
               
               if (_loopCount > 10) {
                   window.clearInterval(_interval);
               }
           }, 20);
           */
        }
    });
</script>
@stop