@extends('layouts.appmaster')
@section('title', 'My Blog Posts')

@section('content')

<div class="profile-content">
    <div class="shadow-box">
        <a href="javascript:history.back()" style="color: black!important; padding-bottom: 150px!important">Go Back</a>

        <div class="container">
            <div class="row">
            @if(count($posts) != 0)
                @foreach($posts as $c)
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
