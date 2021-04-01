@extends('layouts.loginmaster')
@section('title', 'Login Page')

@section('form')
    <div class="login-form">
        <form action="login" method="POST">
            <h1 class="text-center">ADVENTR</h1>
            <h4 class="text-center">A COMMUNITY TRAVEL GUIDE</h4>
            <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div><input type="hidden" name="active"/></div>
            <div class="form-group">
                <button type="submit" class="btn btn-block">Submit</button>
            </div>
            @if(session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h6 class="text-center">Don't have an account? Sign up <a href="register">here</a></h6>
        </form>
    </div>

 @endsection
