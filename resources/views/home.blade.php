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
            <h1>Featured Posts</h1>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/grandcanyon.jpg" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>Hiking the Grand Canyon</h3>
                                <p>By Alice Paulson</p>
                                <p>The American West is one of the most beautiful places I’ve ever seen, and within it lies one of the world’s greatest wonders: the Grand Canyon.</p>
                                <p>Posted: June 11, 2019</p>
                                <a href="">Read More ></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/mexico.jpg" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>Planning a trip to Mexico City</h3>
                                <p>By John Smith</p>
                                <p>Picking a place to stay  in Mexico City can be overwhelming. You’ve got lots of choices when it comes great hotels and neighborhoods.</p>
                                <p>Posted: April 23, 2020</p>
                                <a href="">Read More ></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-img">
                                <img src="images/newyork.jpg" alt="">
                            </div>
                            <div class="card-desc">
                                <h3>The Big Apple</h3>
                                <p>By Emily Quevedo</p>
                                <p>From the Empire State Building to the SoHo to The Statue of Liberty to endless brunch spots. New York is a city that truly has it all.</p>
                                <p>Posted: January 17, 2020</p>
                                <a href="">Read More ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
