@extends('layouts.appmaster')
@section('title', 'My Blog Posts')

@section('content')

<div class="profile-content">
    <div class="shadow-box">
        @if(count($posts) != 0)
                @foreach($posts as $c)
                <a href="javascript:history.back()" style="color: black!important; padding-bottom: 150px!important; text-decoration: underline"><< Go Back</a>

        <form action='deletePost'><input type='hidden' name='id' value="{{$c->getID()}}"><button class="btn btn-danger" type='submit' onclick="return confirm('Are you sure?')" style="float: right"><i class="fa fa-trash"></i></button></form>

        <div class="container">
            <div class="row">

                    <div class="card-body">
                        <h2>{{$c->getTitle()}}</h2>
                      <p class="card-text"><small class="text-muted">By: {{$username}} | Posted on {{$c->getDate()}}</small></p>
                    </div>
                    <img src="images/{{$c->getImage()}}" class="card-img-top">
                    <div class="card-body">
                    <p class="card-text">{{$c->getContent()}}</p>
                    </div>
                @endforeach
            @else
                <h3>No Blog Posts Yet!</h3>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
