@extends('layouts.appmaster')
@section('title', 'Login Page')

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
            <h1>Recent Posts</h1>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/santorini.jpg" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>Title</h3>
                                <p>Description</p>
                                <p>Author</p>
                                <p>Date</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/santorini.jpg" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>Title</h3>
                                <p>Description</p>
                                <p>Author</p>
                                <p>Date</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/santorini.jpg" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>Title</h3>
                                <p>Author</p>
                                <p>Date</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
