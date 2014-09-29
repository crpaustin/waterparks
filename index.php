<!DOCTYPE html>
<html>
<head>
<title>Waterpark</title>
	<script src="js/jquery.js"></script>
	<script src="js/raphael.js"></script>
	<script src="js/jquery.usmap.js"></script>
	<script src="js/control.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body> 
	<?php
	$db = mysqli_connect('localhost','root','pizza','waterpark');
	$states = array();
	$states = addStates($states);

	if(isset($_GET['state'])) {
		$_GET['state'] = strtoupper($_GET['state']);
		if(in_array($_GET['state'],$states)) {
			loadState();
		} else {
			header('location:/water');
		}
	} else {
		loadMap();
	}

	function loadState() {
		GLOBAL $db;
		echo '<a href="/water">&lt Back</a>';
		echo '<h1 style="color:white;">State: ';
		echo $_GET['state'];
		echo '</h1>';
		$query = mysqli_query($db,"SELECT * FROM parks WHERE state='".$_GET['state']."'");
		echo '<ul>';
		while($i = mysqli_fetch_array($query)) {
			if($i['active']) {
				echo '<img src="img/'.$i['image'].'" alt="'.$i['name'].' Image">';
				echo '<li>';
				echo '<a href="'.$i['website'].'">';
				echo $i['name'];
				echo '</a>';
				echo '<ul>';
				echo '<li>';
				echo $i['address'];
				echo '</li>';
				echo '<li>';
				echo $i['city'].', '.$i['state'].' '.$i['zip'];
				echo '</li>';
				echo '</ul>';
				echo '</li>';
			}
		}
		echo '</ul>';
	}

	function loadMap() {
		echo '<div class="titlehome"><a class="titlename" href="#">NameFill</a></div>';
		echo '<h1 style="text-align:center; color: #2a2a2a;">Click what state you want to see waterparks in.</h1>';
		echo '<div id="map" style="width: 750px; height: 500px;"></div>';
		
	}

	function addStates($array) {
		$states = $array;
		array_push($states,'AL',
			'AK',
			'AZ',
			'AR',
			'CA',
			'CO',
			'CT',
			'DC',
			'DE',
			'FL',
			'GA',
			'HI',
			'ID',
			'IL',
			'IN',
			'IA',
			'KS',
			'KY',
			'LA',
			'ME',
			'MD',
			'MA',
			'MI',
			'MN',
			'MS',
			'MO',
			'MT',
			'NE',
			'NV',
			'NH',
			'NJ',
			'NM',
			'NY',
			'NC',
			'ND',
			'OH',
			'OK',
			'OR',
			'PA',
			'RI',
			'SC',
			'SD',
			'TN',
			'TX',
			'UT',
			'VT',
			'VA',
			'WA',
			'WV',
			'WI',
			'WY');
		return $states;
	}

	?>
</body>
</html>