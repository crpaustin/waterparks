<!DOCTYPE html>
<html>
<head>
	<title>Waterpark Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

	<?php

	session_start();

	//Check if user is logged in
	//If so load page with bool that says if admin
	//If not, load login page
	if(isset($_SESSION['login'])) {
		if($_SESSION['login']) {
			if(isset($_SESSION['user'])) {
				if($_SESSION['user']==2) {
					loadUser(false);
				} elseif($_SESSION['user']==1) {
					loadUser(true);
				}
			} else {
				loadUser(false);
			}
		} else {
			loadLogin();
		}
	} else {
		loadLogin();
	}

	//Select which page to load based on URL $_GET variable 'p'
	function loadUser($admin) {
		if(isset($_GET['p'])) {
			switch($_GET['p']) {
				case 'new': loadNew($admin); break;
				case 'edit': loadEdit($admin); break;
				case 'delete': loadDelete($admin); break;
				default: loadHome($admin); break;
			}
		} else {
			loadHome($admin);
		}
	}

	//Load the default which displays list of parks
	//If admin, adds active variable and delete option
	function loadHome($admin) {
		?>
		
		<form action="logout.php">
			<table>
				<tr>
					<td>
						<?php if($admin) { ?>
						<h3>Welcome admin.</h3>
						<?php } else { ?>
						<h3>Welcome user.</h3>
						<?php } ?>
					</td>
					<td>
						<button>Logout</button>
					</td>
				</tr>
			</table>
		</form>

		<a href="?p=new">New</a>

		<table class="parks">
			<tr>
				<td><b>ID</b></td>
				<td><b>Name</b></td>
				<td><b>Address</b></td>
				<td><b>Zip</b></td>
				<td><b>City</b></td>
				<td><b>State</b></td>
				<td><b>Website</b></td>
				<td><b>Image</b></td>
				<?php if($admin) {?>
				<td><b>Active</b></td>
				<?php } ?>
				<td><b>Edit</b></td>
				<?php if($admin) {?>
				<td><b>Delete</b></td>
				<?php } ?>
			</tr>

			<?php

			$db = mysqli_connect('localhost','root','pizza','waterpark');
			$query = mysqli_query($db,"SELECT * FROM parks");
			while($i = mysqli_fetch_array($query)) {
				echo '<tr>';
				echo '<td>'.$i['id'].'</td>';
				echo '<td>'.$i['name'].'</td>';
				echo '<td>'.$i['address'].'</td>';
				echo '<td>'.$i['zip'].'</td>';
				echo '<td>'.$i['city'].'</td>';
				echo '<td>'.$i['state'].'</td>';
				echo '<td>'.$i['website'].'</td>';
				echo '<td>'.$i['image'].'</td>';
				if($admin){echo '<td>'.$i['active'].'</td>';}
				echo '<td><a href="?p=edit&id='.$i['id'].'">';
				if($admin){echo 'Edit';}else{if(!($i['active'])){echo 'Edit';}}
				echo '</a></td>';
				if($admin){echo '<td><a href="?p=delete&id='.$i['id'].'">Delete</a></td>';}
				echo '</tr>';
			}
			?>
		</table>

		<?php
	}

	//Load the page where you can add a new park
	//Submit goes to 'do_new.php'
	function loadNew($admin) {
		?>
		<form action="do_new.php" method="POST">
			<table>
				<tr><td><a href="../admin">&lt Back</a></td></tr>
				<tr><td>Name:</td><td><input type="text" name="name" required></td></tr>
				<tr><td>Address:</td><td><input type="text" name="address" required></td></tr>
				<tr><td>Zip:</td><td><input type="text" name="zip" required></td></tr>
				<tr><td>City:</td><td><input type="text" name="city" required></td></tr>
				<tr><td>State:</td><td><input type="text" name="state" required></td></tr>
				<tr><td>Website:</td><td><input type="text" name="website" required></td></tr>
				<tr><td>Image:</td><td><input type="text" name="image" required></td></tr>
				<tr><td><button>Submit</button></td></tr>
			</table>
		</form>
		<?php
	}

	//Load the page where you can edit a park
	//Submit goes to 'do_edit.php'
	function loadEdit($admin) {
		$db = mysqli_connect('localhost','root','pizza','waterpark');
		$id = mysqli_real_escape_string($db,$_GET['id']);
		$query = mysqli_real_query($db, "SELECT * FROM parks WHERE id='".$id."'");
		$result = mysqli_use_result($db);
		$park = array();
		while($i = mysqli_fetch_array($result)) {
			if($i['active']){if(!($admin)){header('location:../admin');}}
			$park['id'] = $i['id'];
			$park['name'] = $i['name'];
			$park['address'] = $i['address'];
			$park['zip'] = $i['zip'];
			$park['city'] = $i['city'];
			$park['state'] = $i['state'];
			$park['website'] = $i['website'];
			$park['image'] = $i['image'];
			$park['active'] = $i['active'];
		}
		$_SESSION['id'] = $park['id'];
		?>
		<form action="do_edit.php" method="POST">
			<table>
				<tr><td><a href="../admin">&lt Back</a></td></tr>
				<tr><td>ID:</td><td><?php echo $park['id'] ?></td></tr>
				<tr><td>Name:</td><td><input type="text" name="name" value="<?php echo $park['name'] ?>" required></input></td></tr>
				<tr><td>Address:</td><td><input type="text" name="address" value="<?php echo $park['address'] ?>" required></input></td></tr>
				<tr><td>Zip:</td><td><input type="text" name="zip" value="<?php echo $park['zip'] ?>" required></input></td></tr>
				<tr><td>City:</td><td><input type="text" name="city" value="<?php echo $park['city'] ?>" required></input></td></tr>
				<tr><td>State:</td><td><input type="text" name="state" value="<?php echo $park['state'] ?>" required></input></td></tr>
				<tr><td>Website:</td><td><input type="text" name="website" value="<?php echo $park['website'] ?>" required></input></td></tr>
				<tr><td>Image:</td><td><input type="text" name="image" value="<?php echo $park['image'] ?>" required></input></td></tr>
				<!-- If admin, add active checkbox -->
				<?php unset($_SESSION['active']); ?>
				<?php if($admin){ ?><tr><td>Active:</td><td><input type="checkbox" name="active" <?php if($park['active']) { ?>checked<?php } ?>></td></tr>
				<?php } else {$_SESSION['active']=$park['active'];} ?>
				<tr><td><button>Update</button></td></tr>
			</table>
		</form>
		<?php
	}

	//Load the page where you can delete a park
	//Submit goes to 'do_delete.php'
	//Must be an admin
	function loadDelete($admin) {
		
	}

	//If not logged in, will load this page
	//Submit goes to 'do_login.php'
	function loadLogin() {
		?>

		<form action="do_login.php" method="POST">
			<input type="text" name="user" placeholder="Username" required>
			<input type="password" name="pass" placeholder="Password" required>
			<button>Login</button>
		</form>

		<?php
	}

	?>

</body>
</html>