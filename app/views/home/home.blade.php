@extends('home.master')

@section('form')
<?php
    // echo gethostname();
?>
<form style="text-align:center;">
    <div class="form-group">
        <a href="signup" class="btn btn-primary" style="width:70%;">Sign Up</a>
    </div> 
    <div class="form-group">
        or <a href="signin">Sign In</a>
    </div>
</form>
@stop