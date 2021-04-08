<!DOCTYPE HTML>

@extends('layouts.appmaster')
@section('title', 'Add Post')

@section('content')

    <div class="add-form">
        <form action="addPost" method="POST">
            <h1 class="text-center">Add Post</h1>

            <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
            <div class="form-group">
                <input type="text" class="form-control" name="title" placeholder="Enter title" required="required" value="{{ old("title") }}">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" placeholder="Enter description" required="required" rows="3"></textarea>
            </div>
            <div class="form-group">
                <textarea class="content" name="content" placeholder="Enter text here..." required="required" rows="6"></textarea>
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
                <button type="submit" class="btn btn-block">Submit</button>
                <button type="submit" class="btn btn-block" onclick="history.back();">Cancel</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.tiny.cloud/1/qlqj4mkrdpevlf3c2nlxh585ym3hii3907m42li43fmp3s94/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.content',
            apply_source_formatting : false,               
        verify_html : false,
            height: 300,
            menubar: false,
            plugins: [
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo ' +
                'bold italic | numlist bullist | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
        });
    </script>
 @endsection


