@extends('layouts.appmaster')
@section('title', 'Explore Page')

@section('content')

<div class="explore-content">
        {{-- Search Bar --}}
        <div id="search">
            <form action="/search">
            <input type="text" name="search" class="searchTerm" placeholder="What are you looking for?">
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
            </form>
        </div>

        <div class="container">
            <div class="row">
            @if(!empty($posts))
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
