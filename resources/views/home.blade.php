@extends('layouts.appmaster')
@section('title', 'Login Page')

@section('content')
<div class="home-content">
    <div class="shadow-box">
        {{-- Search Bar --}}
        <div id="search">
            <input type="text" class="searchTerm" placeholder="What are you looking for?">
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
        </div>

        <header class="masthead text-white text-center">
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
    </div>

</div>
@endsection
