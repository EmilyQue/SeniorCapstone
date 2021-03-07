@extends('layouts.appmaster')
@section('title', 'Error')

@section('content')

<?php
echo "Exception Occured: " . $errorMsg;
?>

<br>
<a href="login">Try Again</a>

@endsection
