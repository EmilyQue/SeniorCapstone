@extends('layouts.loginmaster')
@section('title', 'Register Page')

@section('form')
    <div class="register-form">
        <form action="register" method="POST">
            <h1 class="text-center">ADVENTR</h1>
            <h4 class="text-center">A COMMUNITY TRAVEL GUIDE</h4>
            <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
            <div class="form-group">
                <input type="text" class="form-control" name="firstName" placeholder="First Name" required="required" value="{{ old("firstName") }}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastName" placeholder="Last Name" required="required" value="{{ old("lastName") }}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email" required="required" value="{{ old("email") }}">
                <div class="error">{{ $errors->first('email')}}</div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required" value="{{ old("username") }}">
                <div class="error">{{ $errors->first('username')}}</div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block">Submit</button>
            </div>
            <h6 class="text-center">Already have an account? Login <a href="login">here</a></h6>
        </form>
    </div>

 @endsection
