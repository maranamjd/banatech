<?php
session_start();
include 'db.php';
include 'function.php';
date_default_timezone_set('Asia/Manila');
if (isset($_POST['notif'])) {

	$statement = $connection->prepare('SELECT id, Type, NotifTime, Status FROM notifications WHERE EmployeeId = :id ORDER BY Status DESC LIMIT 8');
	$result = $statement->execute(array(':id' => $_SESSION['EmployeeId']));
	$result = $statement->fetchAll();

	$statement = $connection->prepare('SELECT a.EmployeeId, a.Email, b.Password FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE a.EmployeeId = :id');
	$result2 = $statement->execute(array(':id' => $_SESSION['EmployeeId']));
	$result2 = $statement->fetchAll();
	$password = array();
	if (decrypt($result2[0]['Password']) == $result2[0]['EmployeeId'].$result2[0]['Email']) {
		$password['NotifTime'] = date('Y-m-d G:i:s');
		$password['Status'] = 0;
		$password['Type'] = 2;
		$result[] = $password;
	}
	for ($i=0; $i < count($result) ; $i++) {
		$result[$i]['NotifTime'] = date('D, F j, Y - g:i a', strtotime($result[$i]['NotifTime']));
	}

	echo json_encode($result);
}else {
	header('Location: ../');
}
