
<?php
session_start();
include('db.php');
include('function.php');
$id = $_SESSION['EmployeeId'];
if (isset($_POST['fetch'])) {
	$query = '';
	$output = array();
	$query .= "SELECT a.*, b.* FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE b.isActive != 0 ";
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
  $haserr = 0;
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
    if($row["hasPayslip"] == 0){
      $sub_array[] = '<center><span id="btn'.$row["EmployeeId"].'"><button type="button" name="view" id="'.$row["EmployeeId"].'" class="btn btn-primary btn-sm viewpayslip" title="view data" disabled>
  		<input type="hidden" id="employeeid" value="'.$row['EmployeeId'].'">
  		<i class="fa fa-newspaper-o"></i></button></span></center>';
    }else {
      $sub_array[] = '<center><span id="btn'.$row["EmployeeId"].'"><button type="button" name="upload" id="'.$row["EmployeeId"].'" class="btn btn-primary btn-sm viewpayslip" title="view data">
      <input type="hidden" id="employeeid" value="'.$row['EmployeeId'].'">
      <i class="fa fa-newspaper-o"></i></button></span></center>';
    }
	$data[] = $sub_array;
}
if(get_total_all_records('', '', 'reset') == 0){
	$_SESSION['reseton'] = true;
}
$output = array(
"draw"				=>	intval($_POST["draw"]),
"recordsTotal"		=> 	get_total_all_records('employees', 'users', 'py'),
"recordsFiltered"	=>	get_total_all_records('employees', 'users', 'py'),
"data"				=>	$data
);
echo json_encode($output);
}
else {
  header('Location: ../');
}
