@extends('layouts.appmaster')
@section('title', 'My Blog Posts')

@section('content')

<div class="profile-content">
    <div class="shadow-box">
        <h1 style="color: #f08700; text-align: center">My Posts</h1>

        <div class="container">
            <div class="row">
            @if(count($posts) != 0)
                @foreach($posts as $c)
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/{{$c->getImage()}}" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>{{$c->getTitle()}}</h3>
                                <p><small>By: {{$username}}</small></p>
                                <p>{{$c->getDescription()}}</p>
                                <p>Posted: {{$c->getDate()}}</p>
                                <form action='displaySinglePost'><input type='hidden' name='id' value={{$c->getId()}}><input type='submit' value='Go To Post'></form>
                                {{-- <a href="displaySinglePost" class="btn-card">Go to Post</a> --}}
                            </div>
                        </div>
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
