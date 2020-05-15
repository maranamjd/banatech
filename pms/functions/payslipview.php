<?php
session_start();
include 'function.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $month = str_replace('pMs', '/', $_GET['month']);
  $year = str_replace('pMs', '/', $_GET['year']);
  $day = str_replace('pMs', '/', $_GET['day']);
  $month = decryptIt(str_replace('F0sN', '+', $month));
  $year = decryptIt(str_replace('F0sN', '+', $year));
  $day = decryptIt(str_replace('F0sN', '+', $day));
  $filename = $year.'-'.$month.'-'.$day;
  $downloadname = $id.'-'.date( 'F d, Y', strtotime($filename)).'.pdf';
  $filename =  str_replace('/', 'Fs', encryptIt($id.'-'.date( 'F d, Y', strtotime($filename)))).'.pdf';
  header('Cache-Control: public'); // required for certain browsers
  header('Content-Description: File Transfer');
  header('Content-Disposition: filename="'.$downloadname.'"');
  header('Content-Type: application/pdf');
  header('Content-Transfer-Encoding: binary');
  $filenamepath = '../assets/files/payslips/'.$filename;
  readfile($filenamepath);
  echo json_encode($filename);
  // exit;
}else {
  header('Location: ../');
}
