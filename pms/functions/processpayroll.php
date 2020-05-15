<?php
include 'db.php';
include 'function.php';

function get_date($time){
	if ($time == 'to') {
		return (date('d') > '15') ? date('Y-m-t') : date('Y-m-15');
	}else {
		return (date('d') > '15') ? date('Y-m-16') : date('Y-m-01');
	}
}
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $date = $_POST['date'];
  $date = explode('-', $date);
  $month = $date[1];
  $year = $date[0];
  if($date[2] >= 1 && $date[2] <= 15)
  $batch = 1;
  else
  $batch = 2;

  // echo json_encode($_POST);die;

    $data = array();
    $data['info'] = getInfo($id, $connection);
    $data['gross'] = getGross($id, $connection, $month, $year, $batch);
    $data['contri'] = getContributions($id, $connection);
    $data['loans'] = getLoans($id, $connection, $month, $year, $batch);
    $data['add'] = getAdditionals($id, $connection);
    $data['contri']['totaltaxableincome'] = $data['gross']['GrossPay'] - $data['add']['deminimis'] - $data['contri']['totalcontri'];
    $data['tax'] = round(withholdingtax($data['contri']['totaltaxableincome']), 2);
    $data['loans']['totalloan'] = $data['loans']['totalloan'] + $data['tax'];
    $data['salaryinfo'] = array(
      'monthlyrate' => round($data['info']['monthly'], 2),
      'dailyrate'  => round((($data['info']['monthly'] * 12) / 261), 2),
      'hourlyrate'  => round(((($data['info']['monthly'] * 12) / 261) / 8), 2),
      'netpay'  => round(($data['gross']['GrossPay'] - $data['contri']['totalcontri'] - $data['loans']['totalloan']) + $data['add']['totaladd'] - $data['add']['deminimis'], 2)
    );//taxable income na to
    if ($batch == 2) {
      $month++;
    }
    $payoutdate = get_date('to');
    $dates = array(
      'payout' => date( 'F d, Y', strtotime($payoutdate)),
      'basis' => date('F d', strtotime(get_date('from'))) .' - '. date('d, Y', strtotime(get_date('to')))
    );
    $data['dates'] = $dates;
    echo json_encode($data);
}else {
  header('Location: ../');
}
