<?php
	include 'db.php';
if (isset($_POST['empid'])) {
	$EmployeeId = $mysqli->escape_string($_POST['empid']);
	$result = $mysqli->query("SELECT hash FROM users WHERE EmployeeId = '$EmployeeId'");

	$data = [];
	if ( $result->num_rows == 0 ){ // User doesn't exist
		$data[] = 'Not Found';
	}
	else {
		$row = $result->fetch_assoc();
		$data[] = 'Found';
		$data[] = $row['hash'];
	}
	echo json_encode($data);
}
else {
  header('Location: ../');
}
