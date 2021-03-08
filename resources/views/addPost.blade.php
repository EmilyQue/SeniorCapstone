@extends('layouts.appmaster')
@section('title', 'Add Post')

@section('content')

    <div class="register-form">
        <form action="addPost" method="POST">
            <h1 class="text-center" style="color: #f08700">Add Post</h1>

            <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
            <div class="form-group">
                <input type="text" class="form-control" name="title" placeholder="Enter title" required="required" value="{{ old("title") }}">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" placeholder="Enter description" required="required" rows="3"></textarea>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" placeholder="Enter text here..." required="required" rows="6"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="date"/>
            </div>
            <div class="form-group">
                <input type="file" id="myFile" name="image">
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
