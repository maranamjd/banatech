<?php

include "function.php";
include 'db.php';
require_once "../classes/PHPExcel.php";
if (isset($_POST['pass'])) {

	$data = array();
	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
  if($ext != 'xlsx'){
    $data['message'] = 0;
  }else {
    $filename = $uploadFilePath = '../temp/'.rand(0,1000).'.'.$ext;
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
    $excelReader = PHPExcel_IOFactory::createReaderForFile($filename);
    $obj 		 		= $excelReader->load($filename);
    $worksheet 	= $obj->getSheet();
    $hRow				= $worksheet->getHighestRow();
    $hCol				= $worksheet->getHighestColumn();
		$bool 				= 0;
    $header 		= array();
    for ($i='A'; $i <= 'N'; $i++) {
      $header[$i] = $worksheet->getCell($i.'1')->getValue();
    }
		if ($header['A'] != 'Employee ID')
			$bool = 1;
		if ($header['B'] != 'First Name')
			$bool = 2;
		if ($header['C'] != 'Middle Name')
			$bool = 3;
		if ($header['D'] != 'Last Name')
			$bool = 4;
		if ($header['E'] != 'Email Address')
			$bool = 5;
		if ($header['F'] != 'User type')
			$bool = 6;
		if ($header['G'] != 'Position')
			$bool = 7;
		if ($header['H'] != 'Reporting Time In')
			$bool = 8;
		if ($header['I'] != 'Reporting Time Out')
			$bool = 9;
		if ($header['J'] != 'De Minimis')
			$bool = 10;
		if ($header['K'] != 'Food & Travel Allowance')
			$bool = 11;
		if ($header['L'] != 'Incentives')
			$bool = 12;
		if ($header['M'] != 'Monthly Salary')
			$bool = 13;

		$employee = array();
    if ($bool == 0) {
			$blankerr = array();
			$dataerr = array();
			$rowsucc = array();
			$row = 2;
			while ($worksheet->getCell('A'.$row)->getValue() != '') {
				$id 				= $worksheet->getCell('A'.$row)->getValue();
				$fname 			= $worksheet->getCell('B'.$row)->getValue();
				$mname 			= $worksheet->getCell('C'.$row)->getValue();
				$lname 			= $worksheet->getCell('D'.$row)->getValue();
				$email 			= $worksheet->getCell('E'.$row)->getValue();
				$utype 			= $worksheet->getCell('F'.$row)->getValue();
				$position 	= $worksheet->getCell('G'.$row)->getValue();
				$timein 		= dec_hours2($worksheet->getCell('H'.$row)->getValue());
				$timeout 		= dec_hours2($worksheet->getCell('I'.$row)->getValue());
				$deminimis 	= $worksheet->getCell('J'.$row)->getValue();
				$allowance 	= $worksheet->getCell('K'.$row)->getValue();
				$incentives = $worksheet->getCell('L'.$row)->getValue();
				$salary 		= $worksheet->getCell('M'.$row)->getValue();
				if (($id !== null)
					&& ($fname !== null)
					&& ($mname !== null)
					&& ($lname !== null)
					&& ($email !== null)
					&& ($utype !== null)
				 	&& ($position !== null)
					&& ($timein !== null)
					&& ($timeout !== null)
					&& ($deminimis !== null)
					&& ($allowance !== null)
					&& ($incentives !== null)
					&& ($salary !== null)) {

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
										':EmployeeId'						=>	$id,
										':FirstName'						=>	$fname,
										':MiddleName'						=>	$mname,
										':LastName'							=>	$lname,
										':Email' 								=>  $email,
										':Position'							=>	$position,
										':TimeIn'								=>	$timein.':00',
										':TimeOut'							=>	$timeout.':00',
										':BasicPay'							=>	$salary,
										':Password' 						=> 	encrypt($id.$email),
										':UserType' 						=> 	convert_usertype($utype),
										':hash'									=> 	$mysqli->escape_string( md5( rand(0,1000) ) ),
										':isActive'							=> 	1,
										':DeMinimis'						=>	$deminimis,
										':FoodTravelAllowance' 	=>	$allowance,
										':Incentives'						=>	$incentives,
										':Philhealth'   				=>  philhealth($salary),
										':SSS'   								=>  sss($salary)
									)
								);
							if ($result) {
								$rowsucc[] = $row;
							} else{
								$dataerr[] = $row;
							}
				}
				else {
					$blankerr[] = $row;
				}
				$row++;
			}
			$data['success'] = $rowsucc;
			$data['dataerr'] = $dataerr;
			$data['blankerr'] = $blankerr;
    }else{
      $data['message'] = 0;
    }
		unlink($filename);
  }
	echo json_encode($data);
}
