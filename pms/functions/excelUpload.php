<?php
session_start();
require_once "../classes/PHPExcel.php";
include("function.php");
include 'db.php';

function get_date($time){
	if ($time == 'to') {
		return (date('d') > '15') ? date('Y-m-t') : date('Y-m-15');
	}else {
		return (date('d') > '15') ? date('Y-m-16') : date('Y-m-01');
	}
}

if(isset($_POST['employeeid'])){
	$data								= new stdClass();
	$data->message 			= 0;
	$data_dtr 		 			= array();
	$day 								= array();
	$dailyDTR						= array();
	$totals							= array();
	$payrolldateArr			= array();
	$totals['hours'] 		= 0;
	$totals['late'] 		= 0;
	$totals['early'] 		= 0;
	$totals['undertime'] = 0;
	$total_hours 				= 0;
	$total_min 	 				= 0;
	$totalundertime_min	= 0;
	$totalovertime_min 	= 0;
	$totallate_min			= 0;
	$totalearly_min			= 0;
	$id 		 						= $_POST['employeeid'];

	//values must be get from employee details on database, dynamic for now
	$statement = $connection->prepare('SELECT TimeIn, TimeOut FROM employees WHERE EmployeeId = :id');
	$statement->execute(array(':id' => $id));
	$result = $statement->fetchAll();
	$employeetimein = $result[0]['TimeIn'];
	$employeetimeout = $result[0]['TimeOut'];

	$statement = $connection->prepare('SELECT time_in, time_out, date_in FROM date_in_tbl WHERE emp_id = :id AND date_in BETWEEN :date_from AND :date_to');
	$statement->execute(array(':id' => $id, ':date_from' => get_date('from'), ':date_to' => get_date('to')));
	$dtr = $statement->fetchAll();


	foreach ($dtr as $key => $time_record) {
		$newdate 		= $time_record['date_in'];

		//time ins
		$newin 		= date('H:i', strtotime($time_record['time_in']));
		// $newin 		= dec_hours($time);

		//time outs
		$newout 		= date('H:i', strtotime($time_record['time_out']));
		// $newout		= dec_hours($time);



		//initialize date, timein, timeout for total computation
		$fromin = $newin;
		$toout = $newout;
		$date = $newdate;
		$mustHour = strtotime($employeetimeout) - strtotime($employeetimein);

		if($fromin != "00:00" && $toout != "00:00"){
			//computation of total hours and minutes
			$total = strtotime($date . ' ' . $toout) - strtotime($date . ' ' . $fromin);
			if ($total>18000)
			{
				$total -= 3600;
			}
			$thours = floor($total / 60 / 60);
			$tminutes = round(($total - ($thours * 60 * 60)) / 60);
			$total_hours = $thourmins = $thours.":".$tminutes;
			$totals['hours'] += $thours;
			$total_min = compute_total_mins($thours, $tminutes);
			//

			//computation of total late hours and minutes
			$total = strtotime($fromin) - strtotime($employeetimein);
			if($total >= 0){
				$thourslate = floor($total/60/60);
				$tminuteslate = round(($total - ($thourslate * 60 * 60)) / 60);
				//give minute only to the array
				$totallate_min = compute_total_mins($thourslate, $tminuteslate);
				$totals['late'] += $totallate_min;
			}
			else{
				$total = strtotime($employeetimein) - strtotime($fromin);
				$thoursearlyin = floor($total/60/60);
				$tminutesearlyin = round(($total - ($thoursearlyin * 60 * 60)) / 60);
				//give minute only to the array
				$totalearly_min = compute_total_mins($thoursearlyin, $tminutesearlyin);
				$totals['early'] += $totalearly_min;
			}
			//

			//computation of total over hours and minutes
			$total = strtotime($toout) - strtotime($fromin);
			if($total > $mustHour){
				$total -= $mustHour;
				$thoursover = floor($total/60/60);
				$tminutesover = round(($total - ($thoursover * 60 * 60)) / 60);
				//give minute only to the array
				$totalovertime_min = compute_total_mins($thoursover, $tminutesover);
			}

			$total = strtotime($toout) - strtotime($fromin);
			if($total < $mustHour){
				$total = $mustHour - $total;
				$thoursearlyout = floor($total/60/60);
				$tminutesearlyout = round(($total - ($thoursearlyout * 60 * 60)) / 60);
				//give minute only to the array
				$totalundertime_min = compute_total_mins($thoursearlyout, $tminutesearlyout);
				$totals['undertime'] = $totalundertime_min;
			}
			//
			$day['date'] = $newdate;
			$day['in'] 	= $newin;
			$day['out']	= $newout;
			$day['totalHours']	= $total_hours;
			$day['totalMinutes']	= $total_min;
			$day['late']	= $totallate_min;
			$day['early']	= $totalearly_min;
			$day['overtime']	= $totalovertime_min;
			$day['undertime']	= $totalundertime_min;
			$dailyDTR[] = $day;

			$total_hours 				= 0;
			$total_min 	 				= 0;
			$totalundertime_min	= 0;
			$totalovertime_min 	= 0;
			$totallate_min			= 0;
			$totalearly_min			= 0;
		}
	}
	$data->dtr	= $dailyDTR;
	$data->totals = $totals;
	$data->dtrId = $id;
	$data->payroll = [
		'day' => date('d', strtotime(get_date('to'))),
		'month' => date('m', strtotime(get_date('to'))),
		'year' => date('Y', strtotime(get_date('to')))
	];
	$data->message = 4;

	// unlink($filename);
	//end ne filename
	echo json_encode($data);


}
else {
  header('Location: ../');
}
