<!DOCTYPE html>
<html>

<style>
.bord{

}
body{
	margin:0;
	padding: 0;

}

input{
	/* border: none;
	color: white;
	outline: none; */
	position: absolute;

	top: 40%;
}

.empimg{
	width:  230px;
	height: 230px;

	border-radius: 50%;
	left: 20%;
	top: 30%;
	position: absolute;

}

#bord_time{
	display: grid;
	grid-template-columns: 1fr 1fr;
	border: 1px solid gray;
	background: white;
	width: 40%;
	height: 40%;
	color: #212121;
	font-family: Arial;
}

ul{

}
li{
	list-style: none;
}
.bana{
	left: 2.5%;
	top: 14%;
	font-family: Arial;

	color:#5b9bd5;
	font-size: 17.5px;
	position: absolute;
}
.o{
	color: red;
}


.log{
	top: 5%;
	left: 2%;
	position: absolute;
	width: 30%;
	height: 8%;

}
 #timer{
 	left: 75%;
 	color: white;
  	font-size: 50px;
  	position: absolute;
font-family: 'Roboto', sans-serif;
font-family: 'Source Code Pro', monospace;
font-family: 'Noto Serif JP', serif;
font-family: 'Kanit', sans-serif;
font-family: 'Orbitron', sans-serif;
font-family: 'Poiret One', cursive;
 }

 .des{

 	background: #5b9bd5;
 	clip-path: polygon(61% 0, 100% 0%, 100% 100%, 39% 100%);
 	width: 100%;
 	height: 100%;
 	position: absolute;
 }

 .timein{
 	position: absolute;
 	left: 60%;
 	top:30%;
font-family: 'Roboto', sans-serif;
font-family: 'Source Code Pro', monospace;
font-family: 'Noto Serif JP', serif;
font-family: 'Kanit', sans-serif;
font-family: 'Orbitron', sans-serif;
font-family: 'Poiret One', cursive;
 	color: white;
 }

 .timeout{
 	position: absolute;
 	left: 60%;
 	top:30%;
 	font-family: 'Roboto', sans-serif;
font-family: 'Source Code Pro', monospace;
font-family: 'Noto Serif JP', serif;
font-family: 'Kanit', sans-serif;
font-family: 'Orbitron', sans-serif;
font-family: 'Poiret One', cursive;
 	color: white;
 }

 .timee{
 	font-size: 50px;
 	font-weight: bold;

 }
 .link{
	 background-color: #e7e7e7;
	 color: black;
	 border: none;
	 padding: 15px 32px;
	 text-align: center;
	 text-decoration: none;
	 display: inline-block;
	 font-size: 16px;
	 margin-left: 30em;
	 margin-top: 3em;
 }
</style>

<head>
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Roboto|Source+Code+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Orbitron|Roboto|Source+Code+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Orbitron|Poiret+One|Roboto|Source+Code+Pro" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class="bord">
	<img src="banate2.png" class="log" />

	<form action='emp_timein.php'method="POST" id='forma' enctype="multipart/form-data">
			<input type="text" name="emp_name" id='emp_name' autocomplete="off">
	</form>



	<div class="des">
	<p id="timer"></p></div>


	<h class='bana'>BANATE CELLPHONE REPAIR AND MAINTENANCE</h>
	<a href="http://localhost/banatech/pms" class="link">Login</a>

<?php


	$conn = mysqli_connect("localhost", "root");
			mysqli_select_db($conn, "banatech");

			date_default_timezone_set("Singapore");

	$date = date('Y-m-d');
	$time = date('G:i:s');
	$timehour = date('h:i:s');
	$ranger = date('G:i:s', strtotime("+10 seconds"));
	if(isset($_POST['emp_name'])){
		$emp_id = $_POST['emp_name'];

		$user = mysqli_query($conn, "SELECT a.*, b.* FROM users a inner join employees b on a.EmployeeId = b.EmployeeId where (a.EmployeeId = '$emp_id') and a.isActive = '1'");

		$use_time = mysqli_query($conn, "SELECT * FROM date_in_tbl where emp_id = '$emp_id' and date_in = '$date'");



		$ranger_query = mysqli_query($conn, "SELECT * FROM date_in_tbl where (emp_id = '$emp_id' and ranger < '$time') and date_in = '$date' ");
		$time_out_again = mysqli_query($conn, "SELECT * FROM date_in_tbl where (emp_id = '$emp_id' and time_out != '00:00:00') and date_in = '$date'");


		$res = mysqli_fetch_array($user);
		$idd = $res['UserId'];

		// $rangers = mysqli_fetch_array($ranger_query);
		// $image = $res['pics'];

		if(mysqli_num_rows($user)){


		if(!mysqli_num_rows($ranger_query)){
			if(mysqli_num_rows($use_time)){
				echo "<div class='timein'><h1>You've already time in...</h1></div>";
			}
			else{

				$insertss = "INSERT into date_in_tbl(emp_id, time_in, date_in, time_out, date_out, ranger, id) VALUES('$emp_id', '$time', '$date', '', '', '$ranger', '$idd')";
				$rese = mysqli_query($conn, $insertss);
		// echo "<img src=".$res['pics']." class='empimg'>";
		echo "<div class='timein'><ul><li>";
		echo "<h class='timee'>TIME IN</h>";
		echo "</li><li><h1>";
		echo $res['FirstName']. " " .$res['MiddleName']. " " .$res['LastName'];
		echo "</h1></li><li><h3>";

		echo $date;

		echo "</h3></li></ul></div>";


	}

		}
		else
		{
			if(!!!mysqli_num_rows($time_out_again)){


				// echo "<img src=".$res['pics']." class='empimg'>";
			echo "<div class='timeout'><ul><li>";
			echo "<h class='timee'>TIME OUT</h>";

			echo "</li><li><h1>";
			echo $res['FirstName']. " " .$res['MiddleName']. " " .$res['LastName'];
			echo "</h1></li><li><h3>";

			echo $date;
			echo "</h3></li></ul></div>";
			$total = date('G:i:s');
			$get_in = mysqli_query($conn, "SELECT * FROM date_in_tbl where emp_id = '$emp_id' and date_in = '$date' ");
				$get_time_in = mysqli_fetch_array($get_in);
				$time_in = $get_time_in['time_in'];
				$date_in = $get_time_in['date_in'];

				$tot      = strtotime($date. ' ' .$time) - strtotime($date_in. ' ' .$time_in);
				$hours      = floor($tot / 3600) % 24;
				$minutes    = floor($tot  / 60) % 60;
				$sec = 			$tot % 60;

				$total = $hours. ':'. $minutes. ':'. $sec;

				echo $total;
				$out = "UPDATE date_in_tbl set time_out = '$time', date_out = '$date', tot = '$total' where emp_id = '$emp_id' and date_in = '$date'";
				$outt = mysqli_query($conn, $out);
			}
			else{
				echo "<div class='timein'><h1>You've already time out...</h1></div>";
		}

		}
	 }

		else{

			echo "<div class='timein'><h1>Employee data doesn't exist</h1></div>";

		}
	}
?>


<!-- <script type="text/javascript" src="beautiful_angels.js"></script> -->
<script type="text/javascript">

var myVar = setInterval(myTimer, 1000);

function myTimer() {
  var tim = new Date();
  document.getElementById("timer").innerHTML = tim.toLocaleTimeString();
}


$('#emp_name').focus();

$(document).ready(function(){
	$('#emp_name').keyup(function(){

		//  $('#forma').submit();

	});
});
</script>
</div>
</body>
</html>
