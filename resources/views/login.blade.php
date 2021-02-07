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
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div><input type="hidden" name="active"/></div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            @if(session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
            @endif
        </form>
    </div>

 @endsection
