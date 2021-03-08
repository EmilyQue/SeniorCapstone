@extends('layouts.appmaster')
@section('title', 'Home Page')

@section('content')
<div class="home-content">
    <div class="shadow-box">
        {{-- Search Bar --}}
        <div id="search">
            <form action="/search">
            <input type="text" name="search" class="searchTerm" placeholder="What are you looking for?">
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
            </form>
        </div>

        <header class="masthead text-white text-left">
            <div class="overlay"></div>
            <div class="container">
              <div class="row">
                <div class="col-xl-9 mx-auto">
                  <h1 class="mb-5">This Month's Destination:</h1>
                  <h1 class="mb-5">SANTORINI</h1>
                </div>
              </div>
            </div>
          </header>

        <div class="content">
            <h1>Featured Posts</h1>

            <div class="container">
                <div class="row">
                    @if(count($posts) != 0)
                @foreach($posts as $c)
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/{{$c['image']}}" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>{{$c['title']}}</h3>
                                <p><small>By: {{$c['firstName']}} {{$c['lastName']}}</small></p>
                                <p>{{$c['description']}}</p>
                                <p>Posted: {{$c['date']}}</p>
                                <form action='displaySinglePost'><input type='hidden' name='id' value={{$c['id']}}><input type='submit' value='Go To Post'></form>
                                {{-- <a href="displaySinglePost" class="btn-card">Go to Post</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
