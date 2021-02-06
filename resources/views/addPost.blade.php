@extends('layouts.appmaster')
@section('title', 'Add Post')

@section('content')
    <div class="register-form">
        <form action="addPost" method="POST">
            <h2 class="text-center">Add Post</h2>
            <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
            <div class="form-group">
                <input type="text" class="form-control" name="title" placeholder="Title" required="required" value="{{ old("title") }}">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" placeholder="Description" required="required" rows="3"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="users_id"/>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </form>
    </div>

 @endsection