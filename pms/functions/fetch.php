
<?php
session_start();
include('db.php');
include('function.php');
$id = $_SESSION['EmployeeId'];
if (isset($_POST['fetch'])) {
	$query = '';
	$output = array();
	$query .= "SELECT a.*, b.UserType, b.isActive, c.* FROM employees a inner join users b on a.EmployeeId = b.EmployeeId inner join additionals c on b.EmployeeId = c.EmployeeId WHERE b.isActive != 0 AND b.hasDTR != 1 ";
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
		$sub_array[] = '<center><span id="btn'.$row["EmployeeId"].'"><button type="button" name="upload" id="'.$row["EmployeeId"].'" class="btn btn-primary btn-sm edit" title="view data">
		<input type="hidden" id="employeeid" value="'.$row['EmployeeId'].'">
		<input type="hidden" id="firstname" value="'.$row['FirstName'].'">
		<input type="hidden" id="middlename" value="'.$row['MiddleName'].'">
		<input type="hidden" id="lastname" value="'.$row['LastName'].'">
		<input type="hidden" id="email" value="'.$row['Email'].'">
		<input type="hidden" id="position" value="'.$row['Position'].'">
		<input type="hidden" id="usertype" value="'.convert_id_to_usertype($row['UserType']).'">
		<input type="hidden" id="timein" value="'.$row['TimeIn'].'">
		<input type="hidden" id="timeout" value="'.$row['TimeOut'].'">
		<input type="hidden" id="demin" value="'.$row['DeMinimis'].'">
		<input type="hidden" id="ftallow" value="'.$row['FoodTravelAllowance'].'">
		<input type="hidden" id="incentive" value="'.$row['Incentives'].'">
		<input type="hidden" id="basicpay" value="'.$row['BasicPay'].'">
		<i class="fa fa-list-alt"></i>
	</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$row["EmployeeId"].'" class="btn btn-danger btn-sm delete" title="deactivate user"><i class=" fa fa-trash-o" ></i></button></span></center>';
	$data[] = $sub_array;
}
$output = array(
"draw"				=>	intval($_POST["draw"]),
"recordsTotal"		=> 	get_total_all_records('employees', 'users', $id),
"recordsFiltered"	=>	get_total_all_records('employees', 'users', $id),
"data"				=>	$data
);
echo json_encode($output);
}
else {
  header('Location: ../');
}
