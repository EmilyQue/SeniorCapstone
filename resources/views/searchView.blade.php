@extends('layouts.appmaster')
@section('title', 'Search Results')

@section('content')

<div class="search-content">
        <a href="javascript:history.back()"><< Go Back</a>

        <h3 class="text-center">Search Results</h3>

        <div class="container">
            <div class="row">
                @if(count($blogPost) != 0)
                        @foreach($blogPost as $c)
                        <div class="col-md-4">
                            <div class="card-content">
                                <div class="card-img">
                                    <img src="images/{{$c['image']}}" alt="">
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
                @else
                    <h4>No results found</h4>
                    @endif
            </div>
        </div>
</div>
@endsection
