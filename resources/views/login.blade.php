@extends('layouts.appmaster')
@section('title', 'Login Page')

@section('content')
    <div class="login-form">
        <form action="login" method="POST">
            <h2 class="text-center">Login</h2>
            <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </form>
    </div>

 @endsection
