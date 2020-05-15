<?php

function getContributions($id, $connection){
  $statement = $connection->prepare('SELECT SSS, Philhealth, HDMF FROM contributions WHERE EmployeeId = :id  ');
  $result = $statement->execute(array(':id' => $id));
  $result = $statement->fetchAll();
  $sssamount = $result[0]['SSS'];
  $philhealth = $result[0]['Philhealth'];
  $hdmf = $result[0]['HDMF'];

  $data = array(
    'sss' => $sssamount,
    'philhealth' => $philhealth,
    'hdmf' => $hdmf,
    'totalcontri' => $sssamount + $philhealth + $result[0]['HDMF'],
  );
return $data;
}

function getInfo($id, $connection){

  $statement = $connection->prepare('SELECT FirstName, MiddleName, LastName, BasicPay FROM employees WHERE EmployeeId = :id');

  $statement->execute(array(':id' => $id));
  $result = $statement->fetchAll();
    $data = array(
      'id' => $id,
      'name' => $result[0]['FirstName'].' '.ucfirst($result[0]['MiddleName']{0}).'. '.$result[0]['LastName'],
      'basicpay' => round($result[0]['BasicPay'] / 2, 2),
      'monthly' => round($result[0]['BasicPay'], 2)
    );
  return $data;
}

function getGross($id, $connection, $month, $year, $batch){
  $statement = $connection->prepare('
  SELECT BasicPay, Absences, Tardiness, Undertime, SalaryAdjustments, GrossPay FROM grosspay WHERE EmployeeId = :id AND Month = :Month AND Year = :Year AND Batch = :Batch
  ');

  $result = $statement->execute(array(
    ':id' => $id,
    ':Month' => $month,
    ':Year' => $year,
    ':Batch' => $batch
  ));
  $result = $statement->fetchAll();
  $data = array(
    'Absences' => round(((($result[0]['BasicPay'] * 12) / 261) / 8) * $result[0]['Absences'], 2),
    'Tardiness' => round((((($result[0]['BasicPay'] * 12) / 261) / 8) / 60) * $result[0]['Tardiness'], 2),
    'Undertime' => round((((($result[0]['BasicPay'] * 12) / 261) / 8) / 60) * $result[0]['Undertime'], 2),
    'SalaryAdjustments' => $result[0]['SalaryAdjustments'],
    'GrossPay' => round($result[0]['GrossPay'], 2)
  );
return $data;
}


function getTax($id, $connection){
  $statement = $connection->prepare('
  SELECT Amount FROM tax WHERE EmployeeId = :id
  ');

  $result = $statement->execute(array(':id' => $id));
  $result = $statement->fetchAll();
  $data = array(
    'tax' => $result[0]['Amount']
  );
return $data;
}

function getLoans($id, $connection, $month, $year, $batch){
  $statement = $connection->prepare('
  SELECT HDMF, SSS, OtherDeduction, TotalLoan FROM loans WHERE EmployeeId = :id AND Month = :Month AND Year = :Year AND Batch = :Batch
  ');

  $result = $statement->execute(array(
    ':id' => $id,
    ':Month' => $month,
    ':Year' => $year,
    ':Batch' => $batch
  ));
  $result = $statement->fetchAll();
  $data = array(
    'sss' => $result[0]['HDMF'],
    'hdmf' => $result[0]['SSS'],
    'other' => $result[0]['OtherDeduction'],
    'totalloan' => $result[0]['TotalLoan']
  );
  return $data;
}

function getAdditionals($id, $connection){
  $statement = $connection->prepare('
  SELECT DeMinimis, FoodTravelAllowance, Incentives FROM additionals WHERE EmployeeId = :id
  ');

  $result = $statement->execute(array(':id' => $id));
  $result = $statement->fetchAll();
  $data = array(
    'deminimis' => $result[0]['DeMinimis'],
    'ftallow' => $result[0]['FoodTravelAllowance'],
    'incentives' => $result[0]['Incentives'],
    'totaladd' => $result[0]['DeMinimis'] + $result[0]['FoodTravelAllowance'] + $result[0]['Incentives']
  );
  return $data;
}






function withholdingtax($salary){
  $tax=0;
  $excess=0;
  if ($salary<=10417) {
    $tax=0;
  } elseif ($salary>=10418 && $salary <=16666) {

    $excess = $salary-10417;
    $tax = $excess*0.20;
  } elseif ($salary>=16667 && $salary <=33332) {

    $excess = $salary-16667;
    $tax = $excess*0.25;
    $tax = $tax+1250;
  } elseif ($salary>=33333 && $salary <=83332) {

    $excess = $salary-33333;
    $tax = $excess*0.30;
    $tax = $tax+5416.67;
  } elseif ($salary>=83333 && $salary <=333332) {

    $excess = $salary-83333;
    $tax = $excess*0.32;
    $tax = $tax+20416.67;
  } elseif ($salary>=333333) {

    $excess = $salary-333333;
    $tax = $excess*0.35;
    $tax = $tax+100416.67;
  }
return $tax;
}

function sss($salary){
  $data=0;
if ($salary>=1000 && $salary<=1249.99) {
  $data=36.30;
} elseif ($salary>=1250 && $salary<=1749.99) {
    $data=54.50;
} elseif ($salary>=1750 && $salary<=2249.99) {
    $data=72.70;
} elseif ($salary>=2250 && $salary<=2749.99) {
    $data=90.80;
} elseif ($salary>=2750 && $salary<=3249.99) {
    $data=109.00;
} elseif ($salary>=3250 && $salary<=3749.99) {
    $data=127.20;
} elseif ($salary>=3750 && $salary<=4249.99) {
     $data=145.30;
} elseif ($salary>=4250 && $salary<=4749.99) {
    $data=163.50;
} elseif ($salary>=4750 && $salary<=5249.99) {
    $data=181.70;
} elseif ($salary>=5250 && $salary<=5749.99) {
    $data=199.80;
} elseif ($salary>=5750 && $salary<=6249.99) {
    $data=218.00;
} elseif ($salary>=6250 && $salary<=6749.99) {
    $data=236.20;
} elseif ($salary>=6750 && $salary<=7249.99) {
    $data=254.30;
} elseif ($salary>=7250 && $salary<=7749.99) {
    $data=272.50;
} elseif ($salary>=7750 && $salary<=8249.99) {
    $data=290.70;
} elseif ($salary>=8250 && $salary<=8749.99) {
    $data=308.80;
} elseif ($salary>=8750 && $salary<=9249.99) {
    $data=327.00;
} elseif ($salary>=9250 && $salary<=9749.99) {
    $data=345.20;
} elseif ($salary>=9750 && $salary<=10249.99) {
    $data=363.30;
} elseif ($salary>=10250 && $salary<=10749.99) {
    $data=381.50;
} elseif ($salary>=10750 && $salary<=11249.99) {
    $data=399.70;
} elseif ($salary>=11250 && $salary<=11749.99) {
    $data=417.80;
} elseif ($salary>=11750 && $salary<=12249.99) {
    $data=436.00;
} elseif ($salary>=12250 && $salary<=12749.99) {
    $data=454.20;
} elseif ($salary>=12750 && $salary<=13249.99) {
    $data=472.30;
} elseif ($salary>=13250 && $salary<=13749.99) {
    $data=490.50;
} elseif ($salary>=13750 && $salary<=14249.99) {
    $data=508.70;
} elseif ($salary>=14250 && $salary<=14749.99) {
    $data=526.80;
} elseif ($salary>=14750 && $salary<=15249.99) {
    $data=545.00;
} elseif ($salary>=15250 && $salary<=15749.99) {
    $data=563.20;
} elseif ($salary>=15750) {
    $data=581.30;
}
return $data/2;
}

function philhealth($salary){
$data=0;
if ($salary<=10000.00) {
  $data=68.75;
} elseif ($salary>=10000.01 && $salary<=39999.99) {
  $data= (($salary*.0275)/2)/2;
} elseif ($salary>=40000.00) {
  $data=275;
}
return $data;
}


function encrypt($txt){
  $encryption_key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $encrypted = openssl_encrypt($txt, 'aes-256-cbc', $encryption_key, 0,
  $iv);
  return base64_encode($encrypted . '::' . $iv);
}
function decrypt($hash){
  $encryption_key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
  list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($hash),
  2),2,null);
  return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0,
  $iv);
}

function passwordVerify($inputPassword, $dbPassword){
  return $inputPassword === decrypt($dbPassword) ? true : false;
}

function dec_hours($x) {
    $sec = intval($x * (24 * 60 * 60));
    $date = new DateTime("today +$sec seconds");
    return $date->format('H:i');
}
function dec_hours2($x) {
    $sec = intval(round($x * 24, 1) * (60 * 60));
    $date = new DateTime("today +$sec seconds");
    return $date->format('H:i');
}
function AddPlayTime($pays) {
		$total='';
		// loop throught all the times
		foreach ($pays as $pay)
		{
			$total += $pay;
		}
		return $total;
}

function compute_total_mins($hours, $mins){
	if($hours >= 1){
		$mins += $hours * 60;
	}
	return $mins;
}






function convert_id_to_bunit($bunit)
{
	$value = "ASC CEBU";
	if ($bunit == 2)
		$value = "ASC MNL";
  else if ($bunit == 3)
		$value = "ATS CEBU";
  else if ($bunit == 4)
		$value = "ATS MNL";
	else if ($bunit == 5)
		$value = "DBT";
	else if ($bunit == 6)
		$value = "DPP";
	else if ($bunit == 7)
		$value = "KRYTERION";
	else if ($bunit == 8)
		$value = "LUNDGREENS";
	else if ($bunit == 9)
		$value = "SRT";
  else if ($bunit == 10)
		$value = "SUPPORT";
	return $value;
}

function convert_bunit_to_id($bunit)
{
	$value = 1;
	if ($bunit == "ASC MNL")
		$value = 2;
  else if ($bunit == "ATS CEBU")
		$value = 3;
  else if ($bunit == "ATS MNL")
		$value = 4;
	else if ($bunit == "DBT")
		$value = 5;
	else if ($bunit == "DPP")
		$value = 6;
	else if ($bunit == "KRYTERION")
		$value = 7;
	else if ($bunit == "LUNDGREENS")
		$value = 8;
	else if ($bunit == "SRT")
		$value = 9;
  else if ($bunit == "SUPPORT")
		$value = 10;
	return $value;
}





function convert_id_to_usertype($usertype)
{
	$value = "User-Employee";
	if ($usertype == 0)
		$value = "Admin-HR";
	else if ($usertype == 1)
		$value = "Admin-Accounting";
	return $value;
}

function convert_usertype($usertype)
{
	$value = 0;
	if ($usertype == "User-Employee")
		$value = 2;
	elseif ($usertype == "Admin-Accounting")
		$value = 1;
	return $value;
}

function get_total_all_records($table1, $table2, $id)
{
	include('db.php');
    if ($id == '')
    $statement = $connection->prepare("SELECT * FROM $table1 a inner join $table2 b on a.EmployeeId = b.EmployeeId WHERE b.isActive = 0 ");
    elseif ($id == 'ac')
    $statement = $connection->prepare("SELECT a.image, a.EmployeeId, a.FirstName, a.MiddleName, a.LastName, b.hasLoans FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE b.isActive = 1 ");
    elseif ($id == 'pr')
    $statement = $connection->prepare("SELECT a.*, b.* FROM $table1 a inner join $table2 b on a.EmployeeId = b.EmployeeId WHERE b.isActive != 0 AND b.hasPayslip = 0 ");
    elseif ($id == 'py')
    $statement = $connection->prepare("SELECT a.*, b.* FROM $table1 a inner join $table2 b on a.EmployeeId = b.EmployeeId WHERE b.isActive != 0 ");
    elseif($id != '' )
    $statement = $connection->prepare("SELECT a.*, b.UserType, b.isActive, c.* FROM $table1 a inner join $table2 b on a.EmployeeId = b.EmployeeId inner join additionals c on b.EmployeeId = c.EmployeeId WHERE b.isActive !=0 AND b.hasDTR != 1");

    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();


}
?>
