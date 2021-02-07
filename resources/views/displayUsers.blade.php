<?php session_start();
use App\Services\Business\UserBusinessService;
use App\Services\Business\AdminBusinessService;
?>
@extends('layouts.appmaster')
@section('title', 'Admin Users Page')

@section('content')

<head>
<style>
#user {
    font-family: "Comic Sans", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
#user td, #user th {
    border: 1px solid #ddd;
    padding: 8px;
}
#user tr:nth-child(even) {
    background-color: #f2f2f2;
}
#user tr:hover {
    background-color: #ddd;
}
#user th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #7554ba;
    color: white;
}
#user thead {
    background-color: #aabd8c;
}
</style>

</head>
<table id="user">
<thead>
	<th>Suspend</th>
	<th>ID</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Username</th>
	<th>Password</th>
	<th>Role</th>
	<th>Active</th>
	</thead>
<tbody>

<?php
//user business service is called
$bs = new AdminBusinessService();
$users = $bs->showUsers();
//for loop to populate the data table in the displayUsers view
for ($x = 0; $x < count($users); $x++) {
    if ($users[$x]['role'] != 1) {
    echo "<tr>";

    if ($users[$x]['active'] == 0) {
    echo "<td><form action='adminSuspend'><input type='hidden' name='id' value=". $users[$x]['id'] ."><input type='submit' value='Suspend'></form>  </td>";
    } else if ($users[$x]['active'] == 1) {
        echo "<td><form action='adminUnsuspend'><input type='hidden' name='id' value=". $users[$x]['id'] ."><input type='submit' value='Unsuspend'></form>  </td>";
    }
    echo "<td>" . $users[$x]['id'] . "</td>";
    echo "<td>" . $users[$x]['firstName'] . "</td>";
    echo "<td>" . $users[$x]['lastName'] . "</td>";
    echo "<td>" . $users[$x]['email'] . "</td>";
    echo "<td>" . $users[$x]['username'] . "</td>";
    echo "<td>" . $users[$x]['password'] . "</td>";
    echo "<td>" . $users[$x]['role'] . "</td>";
    echo "<td>" . $users[$x]['active'] . "</td>";
    }
}
?>
</table>
<!-- //loops through person array and prints values -->

@endsection
