@extends('layouts.appmaster')
@section('title', 'Home Page')

@section('content')
    {{-- Santorini Banner --}}
    <header class="masthead text-white text-left">
        <div class="overlay"></div>
        <div class="container">
        <div class="row">
            <div class="col-xl-10 mx-auto">
            <h1 class="mb-5">This Month's Top Destination:</h1>
            <h1 class="mb-5">SANTORINI</h1>
            </div>
        </div>
        </div>
    </header>

    {{-- Featured Posts --}}
    <div class="content">
        <h1>FEATURED POSTS</h1>

        <div class="container">
            <div class="row">
                @if(count($posts) != 0)
            @foreach($posts as $c)
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img src="resources/images/{{$c['image']}}" alt="">
                        </div>
                        <div class="card-desc">
                            <h5 class="text-center">{{$c['title']}}</h5>
                            <p class="text-center"><small><i>by</i> {{$c['firstName']}} {{$c['lastName']}} <i>on</i> {{$c['date']}}</small></p>
                            <p>{{$c['description']}}</p>
                            <form action='displaySinglePost'><input type='hidden' name='id' value={{$c['id']}}><input class="btn" type='submit' value='Go To Post'></form>
                            {{-- <a href="displaySinglePost" class="btn-card">Go to Post</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
            </div>
        </div>

    </div>
@endsection
