
<?php
session_start();
include('db.php');
include('function.php');
$id = $_SESSION['EmployeeId'];
if (isset($_POST['fetch'])) {
	$query = '';
	$output = array();
	$query .= "SELECT a.*, b.UserType, b.isActive FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE a.EmployeeId != '$id' AND b.isActive != 1 ";
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
		$sub_array[] = $image;
		$sub_array[] = $row["EmployeeId"];
		$sub_array[] = $row["LastName"].', '.$row["FirstName"]." ".$row["MiddleName"]{0}.".";
		$sub_array[] = '<center><button type="button" name="upload" id="'.$row["EmployeeId"].'" class="btn btn-primary btn-sm edit">
		<input type="hidden" id="employeeid" value="'.$row['EmployeeId'].'">
		<input type="hidden" id="firstname" value="'.$row['FirstName'].'">
		<input type="hidden" id="middlename" value="'.$row['MiddleName'].'">
		<input type="hidden" id="lastname" value="'.$row['LastName'].'">
		<input type="hidden" id="email" value="'.$row['Email'].'">
		<input type="hidden" id="businessunitid" value="'.convert_id_to_bunit($row['BusinessUnitID']).'">
		<input type="hidden" id="position" value="'.$row['Position'].'">
		<input type="hidden" id="usertype" value="'.convert_id_to_usertype($row['UserType']).'">
		<input type="hidden" id="basicpay" value="'.$row['BasicPay'].'">
		<i class="fa fa-list"></i>
	</button></center>';
	$data[] = $sub_array;
}
$output = array(
"draw"				=>	intval($_POST["draw"]),
"recordsTotal"		=> 	get_total_all_records('employees', 'users', ''),
"recordsFiltered"	=>	get_total_all_records('employees', 'users', ''),
"data"				=>	$data
);
echo json_encode($output);
}
else {
  header('Location: ../');
}
