<?php
session_start();
$id = $_SESSION['EmployeeId'];
include('db.php');
include('function.php');
if (isset($_POST['fetch'])) {
	$query = '';
	$output = array();
	$query .= "SELECT a.image, a.EmployeeId, a.FirstName, a.MiddleName, a.LastName, b.hasLoans FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE b.isActive = 1 ";
	if(isset($_POST["search"]["value"]))
	{
		$query .= 'AND a.LastName LIKE "%'.$_POST["search"]["value"].'%" ';
	}
	if(isset($_POST["order"]))
	{
		$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
		$query .= 'ORDER BY a.LastName ASC ';
	}
	if($_POST["length"] != -1)
	{
		$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	$statement = $connection->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$data = array();
	$filtered_rows = $statement->rowCount();
	foreach($result as $row)
	{
		$image = '';
		if($row["image"] != '')
		{
			$image = '<img src="../assets/upload/'.$row["image"].'" />';
		}
		else
		{
			$image = '<img src="../assets/upload/unknown.jpg" />';
		}

		$sub_array = array();
		$sub_array[] = '<span id="img'.$row["EmployeeId"].'">'.$image."</span>";
		$sub_array[] = '<span id="empid'.$row["EmployeeId"].'">'.$row["EmployeeId"]."</span>";
		$sub_array[] = '<span id="name'.$row["EmployeeId"].'">'.$row["LastName"].', '.$row["FirstName"]." ".$row["MiddleName"]{0}.".</span>";
		if ($row["hasLoans"] == 1) {
      $sub_array[] = '<center><span id="loan'.$row["EmployeeId"].'"><i class="fa fa-check" style="color:#76EE00"></i></span></center>';
			$sub_array[] = '<center><span id="btn'.$row["EmployeeId"].'"><button type="button" name="upload" id="'.$row["EmployeeId"].'" class="btn btn-primary btn-sm upload" disabled>
			<input type="hidden" id="employeeid" value="'.$row['EmployeeId'].'">
			<input type="hidden" id="name" value="'.$row['FirstName'].' '.ucfirst($row['MiddleName']{0}).'. '.$row['LastName'].'">
			<i class="fa fa-list"></i>
			</button></span></center>';
    }else {
      $sub_array[] = '<center><span id="loan'.$row["EmployeeId"].'"><i class="fa fa-times" style="color:#B22222"></i></span></center>';
			$sub_array[] = '<center><span id="btn'.$row["EmployeeId"].'"><button type="button" name="upload" id="'.$row["EmployeeId"].'" class="btn btn-primary btn-sm upload">
			<input type="hidden" id="employeeid" value="'.$row['EmployeeId'].'">
			<input type="hidden" id="name" value="'.$row['FirstName'].' '.ucfirst($row['MiddleName']{0}).'. '.$row['LastName'].'">
			<i class="fa fa-list"></i>
			</button></span></center>';
		}
		$data[] = $sub_array;
	}
	$output = array(
		"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	get_total_all_records('employees', 'users', 'ac'),
		"recordsFiltered"	=>	get_total_all_records('employees', 'users', 'ac'),
		"data"				=>	$data
		);
		echo json_encode($output);
}
else {
  header('Location: ../');
}
