<?php

$admin = false;

session_start();

//Check if the user is logged in before updating row
//Redirect to index if not logged in
if(isset($_SESSION['login'])) {
	if($_SESSION['login']) {
		if(isset($_SESSION['user'])) {
			if($_SESSION['user']==1) {
				$admin=true;
			}

			$db = mysqli_connect('localhost','root','pizza','waterpark');

			//Escape special chars to prevent SQL injection
			$id = mysqli_real_escape_string($db, $_SESSION['id']);
			$name = mysqli_real_escape_string($db, $_POST['name']);
			$address = mysqli_real_escape_string($db, $_POST['address']);
			$zip = mysqli_real_escape_string($db, $_POST['zip']);
			$city = mysqli_real_escape_string($db, $_POST['city']);
			$state = mysqli_real_escape_string($db, $_POST['state']);
			$website = mysqli_real_escape_string($db, $_POST['website']);
			$image = mysqli_real_escape_string($db, $_POST['image']);
			if(!(isset($_POST['active']))){$_POST['active']='off';}
			if(!(isset($_SESSION['active']))){$_SESSION['active']=0;}
			if($_POST['active']=='on'||$_SESSION['active']==1) {$active=true;} else {$active=false;}

			$query = mysqli_real_query($db,"UPDATE parks SET name='".$name."', address='".$address."', zip='".$zip."', city='".$city."', state='".$state."', website='".$website."', image='".$image."', active='".$active."' WHERE id='".$id."'");

			unset($_SESSION['active']);

			header('location:../admin');

		}
	} else {
		header('location:../admin');
	}
} else {
	header('location:../admin');
}

?>