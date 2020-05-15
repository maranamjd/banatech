<?php
//for security: create external db file and include it here then remove any other code except for the include
// include '../../samples/db.php';
    //external file code:{
// <?php
// $host = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'drake';
// $connection = new PDO( 'mysql:host='.$host.';dbname='.$dbname, $username, $password );
//
// //for $mysqli
// $mysqli = mysqli_connect($host, $username, $password, $dbname);
// // Check connection
// if (mysqli_connect_errno()){
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//
// }
    //end external file code}

//for pdo

$username = 'root';
$password = '';
$connection = new PDO( 'mysql:host=localhost;dbname=banatech', $username, $password );

//for $mysqli
$mysqli = mysqli_connect("localhost","root","","banatech");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>
