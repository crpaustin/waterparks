<?php

session_start();

$db = mysqli_connect('localhost','root','pizza','waterpark') or die('Could not connect');

$user = mysqli_real_escape_string($db,$_POST['user']);
$pass = $_POST['pass'];

$query = mysqli_real_query($db,"SELECT * FROM `user` WHERE user='".$user."'");
$result = mysqli_store_result($db);

while($i = mysqli_fetch_array($result)) {
	if(password_verify($pass,$i['pass'])) {
		$_SESSION['login'] = true;
		$_SESSION['user'] = $i['id'];
	}
}

header('location:index.php');

?>