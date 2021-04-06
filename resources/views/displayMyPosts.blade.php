@extends('layouts.appmaster')
@section('title', 'My Blog Posts')

@section('content')

<div class="userposts-content">
        <h1 class="text-center">My Posts <a href="addPost"><i class="fas fa-plus"></i></a></h1>
        <div class="container">
            <div class="row">
            @if(count($posts) != 0)
                @foreach($posts as $c)
                    <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img src="resources/images/{{$c->getImage()}}" alt="">
                        </div>
                        <div class="card-desc">
                            <h5 class="text-center">{{$c->getTitle()}}</h5>
                            <p class="text-center"><small><i>by</i> {{$c->getFirstName()}} {{$c->getLastName()}} <i>on</i> {{$c->getDate()}}</small></p>
                            <p>{{$c->getDescription()}}</p>
                            <form action='displaySinglePost'><input type='hidden' name='id' value={{$c->getId()}}><input class="btn" type='submit' value='Go To Post'></form>
                            {{-- <a href="displaySinglePost" class="btn-card">Go to Post</a> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <h3>No Blog Posts <br><small>Click the + to add your first post!</small></h3>
            @endif
        </div>
        </div>
</div>
@endsection
