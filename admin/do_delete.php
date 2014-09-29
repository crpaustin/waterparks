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

			$query = mysqli_real_query($db,"DELETE FROM parks WHERE id='".$id."'");
			$query = mysqli_real_query($db,"ALTER TABLE parks DROP COLUMN id");
			$query = mysqli_real_query($db,"ALTER TABLE parks ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");

			unset($_SESSION['id']);

			header('location:../admin');

		}
	} else {
		header('location:../admin');
	}
} else {
	header('location:../admin');
}

?>