<?php session_start();
use App\Services\Business\PostBusinessService;
?>
@extends('layouts.appmaster')
@section('title', 'Blog Posts Page')

@section('content')

<head>
<style>
h1{
    margin-top: 25px;
    text-align: center;
}

.alert{
    margin-top: 25px;
}

#post {
    font-family: "Comic Sans", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    margin-top: 25px;
}
#post td, #post th {
    border: 1px solid #ddd;
    padding: 8px;
}
#post tr:nth-child(even) {
    background-color: #f2f2f2;
}
#post tr:hover {
    background-color: #ddd;
}
#post th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #f08700;
    color: white;
}
#post thead {
    background-color: #aabd8c;
}
</style>

</head>
<table id="post">
<thead>
    <th>Edit</th>
    <th>Delete</th>
	<th>Id</th>
	<th>Blog Title</th>
	<th>Blog Description</th>
    <th>Author</th>
</thead>
<tbody>

<h1>All Posts</h1>

    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<?php
//post business service is called
$bs = new PostBusinessService();
$posts = $bs->findAllBlogPosts();

//for loop to populate the data table in the displayPosts view
for ($x = 0; $x < count($posts); $x++) {
    echo "<tr>";

    echo "<td><form action='editPost'><input type='hidden' name='id' value=". $posts[$x]['id'] ."><input type='submit' value='Edit'></form>  </td>";
    echo "<td><form action='deletePost'><input type='hidden' name='id' value=". $posts[$x]['id'] ."><input type='submit' value='Delete'></form>  </td>";
    echo "<td>" . $posts[$x]['id'] . "</td>";
    echo "<td>" . $posts[$x]['title'] . "</td>";
    echo "<td>" . $posts[$x]['description'] . "</td>";
    echo "<td>" . $posts[$x]['users_id'] . "</td>";
    }

?>
</table>
<!-- //loops through person array and prints values -->

@endsection
