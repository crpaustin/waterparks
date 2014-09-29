<?php

$admin = false;

session_start();

//Check if the user is logged in before inserting new row
//Redirect to index if not logged in
if(isset($_SESSION['login'])) {
	if($_SESSION['login']) {
		if(isset($_SESSION['user'])) {
			if($_SESSION['user']==1) {
				$admin=true;
			}

			$db = mysqli_connect('localhost','root','pizza','waterpark');

			//Escape special chars to prevent SQL injection
			$name = mysqli_real_escape_string($db, $_POST['name']);
			$address = mysqli_real_escape_string($db, $_POST['address']);
			$zip = mysqli_real_escape_string($db, $_POST['zip']);
			$city = mysqli_real_escape_string($db, $_POST['city']);
			$state = mysqli_real_escape_string($db, $_POST['state']);
			$website = mysqli_real_escape_string($db, $_POST['website']);
			$image = mysqli_real_escape_string($db, $_POST['image']);
			$active = 0;

			//Admin input is automatically active while user input must be activated by admin
			if($admin){$active=1;}

			$query = mysqli_real_query($db,"INSERT INTO parks VALUES (null,'".$name."','".$address."','".$zip."','".$city."','".$state."','".$website."','".$image."','".$active."')");

			header('location:../admin');

		}
	} else {
		header('location:../admin');
	}
} else {
	header('location:../admin');
}

?>