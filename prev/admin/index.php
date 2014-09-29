<!DOCTYPE html>
<html>
<head>
	<title>Waterpark Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

	<?php

	session_start();

	if(isset($_SESSION['login'])) {
		if($_SESSION['login']) {
			if(isset($_SESSION['user'])) {
				if($_SESSION['user']==2) {
					loadUser();
				} elseif($_SESSION['user']==1) {
					loadAdmin();
				}
			} else {
				loadUser();
			}
		} else {
			loadLogin();
		}
	} else {
		loadLogin();
	}

	function loadUser() {
		echo 'user';
		?>

		<form action="logout.php">
			<button>Logout</button>
		</form>

		<?php
	}

	function loadAdmin() {
		echo 'admin';
		?>

		<form action="logout.php">
			<button>Logout</button>
		</form>

		<?php
	}

	function loadLogin() {
		?>

		<form action="login.php" method="POST">
			<input type="text" name="user" placeholder="Username" required>
			<input type="password" name="pass" placeholder="Password" required>
			<button>Login</button>
		</form>

		<?php
	}

	?>

</body>
</html>