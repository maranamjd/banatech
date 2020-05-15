<?php
include 'db.php';
include 'function.php';
session_start();
/* User login process, checks if user exists and password is correct */
if (isset($_POST['login'])) {
	// Escape email to protect against SQL injections
	$username = $mysqli->escape_string($_POST['username']);
	$result = $mysqli->query("SELECT a.*, b.* FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE a.email = '$username'");

	if ( $result->num_rows == 0 ){ // User doesn't exist
		$_SESSION['message'] = "Username or Password do not match. Please try again!";
		header("location: ../index.php");
	}
	else { // User exists
		$row = $result->fetch_assoc();
			if ( passwordVerify($_POST['password'], $row['Password']) ) {
				if($row['isActive'] == 1){
						//store user data to session

						$_SESSION['usertype'] 				= $row['UserType'];
						$_SESSION['Name'] 						= $row['FirstName'] . " " . ucfirst($row['MiddleName']{0}) . ". " . $row['LastName'];
						$_SESSION['image'] 						= $row['image'];
						$_SESSION['id'] 							= $row['id'];
						$_SESSION['password'] 				= $row['Password'];
						$_SESSION['EmployeeId'] 			= $row['EmployeeId'];
						$_SESSION['Position'] 				= $row['Position'];
						$_SESSION['Email']	 					= $row['Email'];
						$_SESSION['FirstName']	 			= $row['FirstName'];
						$_SESSION['LastName'] 				= $row['LastName'];
						$_SESSION['MiddleName'] 			= $row['MiddleName'];
						$_SESSION['isLogin']					= 'true';

						$statement = $connection->prepare('UPDATE users SET Status = 1 WHERE EmployeeId = :id');
						$result = $statement->execute(array(':id' => $row['EmployeeId']));
						//redirect user acc to usertype
						if ($row['UserType'] == 0) {
							header('Location: ../home-hr/');
						}
						elseif ($row['UserType'] == 1) {
							header('Location: ../home-ac/');
						}
						elseif ($row['UserType'] == 2) {
							header('Location: ../home/');
						}
					}
					else {
						$_SESSION['message'] = "Account inactive. Please contact administrator!";
						$_SESSION['type'] = 'warning';
						$_SESSION['logemail'] = $username;
						header("location: ../");
					}
			}
			else {
				$_SESSION['message'] = "Username or Password do not match. Please try again!";
				$_SESSION['type'] = 'danger';
				$_SESSION['logemail'] = $username;
				header("location: ../");
			}
	}
}
else {
  header('Location: ../');
}
