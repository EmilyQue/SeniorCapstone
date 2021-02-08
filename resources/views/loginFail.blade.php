@extends('layouts.appmaster')
@section('title', 'Login Failed Page')

@section('content')

	@if (session()->has('active'))
		@if (session('active') == 1)
		<h3>Account Suspended</h3>
		@endif
	@endif

		<h3>Login Failed</h3>
	<br>
	<a href="login">Try Again</a>


@endsection
