<?php
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
  echo json_encode($id.'-'.date('F d, Y', strtotime(get_date('to'))).'.pdf');
}else {
  header('Location: ../');
}
