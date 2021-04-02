@extends('layouts.appmaster')
@section('title', 'Blog Post')

@section('content')

<div class="post-content">
        @if(count($posts) != 0)
                @foreach($posts as $c)
                <a href="javascript:history.back()"><< Go Back</a>

                @if(session('user_id') == $c['users_id'])
                <form action='deletePost'><input type='hidden' name='id' value="{{$c['id']}}"><button class="btn btn-danger" type='submit' onclick="return confirm('Are you sure?')" style="float: right"><i class="fa fa-trash"></i></button></form>
            @endif

        <div class="container">
            <div class="row">
                    <div class="card-body">
                        <h2 class="text-center">{{$c['title']}}</h2>
                        <p class="card-text-author"><small class="text-muted"><i>by </i> {{$c['firstName']}} {{$c['lastName']}} <i> on </i> {{$c['date']}}</small></p>
                    </div>
                    <img src="images/{{$c['image']}}" class="card-img-top">
                    <div class="card-body">
                    <p class="card-text">{{$c['content']}}</p>
                    </div>
                @endforeach
            @else
                <h3>No Blog Posts Yet!</h3>
            @endif
            </div>
        </div>
</div>
@endsection
