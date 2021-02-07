@extends('layouts.appmaster')
@section('title', 'Search Results')

@section('content')

<div class="home-content">
    <div class="shadow-box">
        <h3>Here is what was found: </h3>
        @if(count($blogPost) != 0)
                @foreach($blogPost as $e)
                <hr>
                <u>{{$e->getTitle()}}</u><br/>
                Description: {{$e->getDescription()}}<br/>
        <form action='post'><input type='hidden' name='id' value= '{{$e->getId()}}'><input type='submit' value='Read More'></form>
                @endforeach
        @else
            No results found
            @endif
    </div>
</div>
@endsection
