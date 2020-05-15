<?php
session_start();
include('db.php');
include('function.php');
if (isset($_POST['operation'])) {
	if($_POST["operation"] == "Add")
	{
		try {
			$statement = $connection->prepare("
			START TRANSACTION;
			INSERT INTO employees (image, EmployeeId, FirstName, MiddleName, LastName, Email, Position, TimeIn, TimeOut, BasicPay)
			VALUES (:image, :EmployeeId, :FirstName, :MiddleName, :LastName,  :Email, :Position, :TimeIn, :TimeOut, :BasicPay);
			INSERT INTO users (UserId, EmployeeId, Password, UserType, hash, isActive)
			VALUES (NULL, :EmployeeId, :Password, :UserType, :hash, :isActive);
			INSERT INTO additionals (id, EmployeeId, DeMinimis, FoodTravelAllowance, Incentives)
			VALUES (NULL, :EmployeeId, :DeMinimis, :FoodTravelAllowance, :Incentives);
			INSERT INTO contributions (iContributionId, EmployeeId, SSS, Philhealth)
			VALUES (NULL, :EmployeeId, :SSS, :Philhealth);
			COMMIT;
			");
			$result = $statement->execute(
				array(
					':image'								=>	'unknown.jpg',
					':EmployeeId'						=>	$_POST["employeeid"],
					':FirstName'						=>	$_POST["firstname"],
					':MiddleName'						=>	$_POST["middlename"],
					':LastName'							=>	$_POST["lastname"],
					':Email' 								=>  $_POST["email"],
					':Position'							=>	$_POST["position"],
					':TimeIn'								=>	$_POST["timein"].':00',
					':TimeOut'							=>	$_POST["timeout"].':00',
					':BasicPay'							=>	$_POST["basicpay"],
					':Password' 						=> 	encrypt($_POST['email']),
					':UserType' 						=> 	convert_usertype($_POST['usertype']),
					':hash'									=> 	$mysqli->escape_string( md5( rand(0,1000) ) ),
					':isActive'							=> 	1,
					':DeMinimis'						=>	$_POST["deminimis"],
					':FoodTravelAllowance' 	=>	$_POST["ftallowance"],
					':Incentives'						=>	$_POST["incentives"],
					':Philhealth'   				=>  philhealth($_POST["basicpay"]),
					':SSS'   								=>  sss($_POST["basicpay"]),
				)
			);
			echo 'Data Successfuly Inserted';
		} catch (PDOException $e) {
			echo 'Data Insertion Failed '.$e;
		}

	}


	elseif($_POST["operation"] == "Edit")
	{
		$data = new stdClass();
	 try {
		 $statement = $connection->prepare("
	 	START TRANSACTION;
		UPDATE employees SET EmployeeId = :EmployeeId, FirstName = :FirstName, MiddleName = :MiddleName, LastName = :LastName, Email = :Email, Position = :Position, TimeIn = :TimeIn, TimeOut = :TimeOut, BasicPay = :BasicPay WHERE EmployeeId = :id;
	 	UPDATE users SET EmployeeId = :EmployeeId, UserType = :UserType WHERE EmployeeId = :id;
		UPDATE additionals SET EmployeeId = :EmployeeId,  DeMinimis = :DeMinimis, FoodTravelAllowance = :FoodTravelAllowance, Incentives = :Incentives WHERE EmployeeId = :id;
		UPDATE contributions SET EmployeeId = :EmployeeId, SSS = :SSS, Philhealth = :Philhealth WHERE EmployeeId = :id;
		UPDATE notifications SET EmployeeId = :EmployeeId WHERE EmployeeId = :id;
		COMMIT;");
	 	$result = $statement->execute(
	 		array(
	 			':EmployeeId'						=>	$_POST["newid"],
	 			':FirstName'						=>	$_POST["firstname"],
	 			':MiddleName'						=>	$_POST["middlename"],
	 			':LastName'							=>	$_POST["lastname"],
	 			':Email'								=>  $_POST['email'],
	 			':UserType'							=> 	convert_usertype($_POST['usertype']),
	 			':Position'							=>	$_POST["position"],
	 			':TimeIn'								=>	$_POST["timein"],
	 			':TimeOut'							=>	$_POST["timeout"],
	 			':BasicPay'							=>	$_POST["basicpay"],
	 			':id'										=>	$_POST["employeeid"],
				':DeMinimis'						=>	$_POST["deminimis"],
				':FoodTravelAllowance'	=>	$_POST["ftallowance"],
				':Incentives'						=>	$_POST["incentives"],
				':Philhealth'   				=>  philhealth($_POST["basicpay"]),
				':SSS'   								=>  sss($_POST["basicpay"]),
	 		)
	 	);
		$data->message = 1;
		if ($_POST["employeeid"] == $_SESSION['EmployeeId']) {
			$_SESSION['usertype'] 				= convert_usertype($_POST['usertype']);
			$_SESSION['EmployeeId'] 			= $_POST["newid"];
			$_SESSION['Position'] 				= $_POST["position"];
			$_SESSION['isLogin']					= 'true';
			$data->rel = 1;
		}
	 } catch (PDOException $e) {
		 $data->message = 2;
	 }
	 echo json_encode($data);
	}
}
else {
  header('Location: ../');
}
