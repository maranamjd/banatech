<?php

require('../robo_db_conn.php');


if(isset($_POST['ids'])){
    $query = mysqli_query($conn, "SELECT id, emp_id, fname, mname, lname FROM user_tbl WHERE id = '".$_POST['ids']."'");
    $row = mysqli_fetch_array($query);

    echo json_encode($row);
}

if(isset($_POST['id_ad'])){
    $query = mysqli_query($conn, "SELECT id, emp_id, email FROM user_tbl WHERE id = '".$_POST['id_ad']."'");
    $row = mysqli_fetch_array($query);

    echo json_encode($row);
}

if(isset($_POST['delete_data'])){
    $output = '';

    $query = mysqli_query($conn, "SELECT id, emp_id, fname, mname, lname FROM user_tbl WHERE id = '".$_POST['delete_data']."'");
  
        $row = mysqli_fetch_array($query);
   
         echo json_encode($row);
 
   
}

if(isset($_POST['imgs_id'])){



    $query = mysqli_query($conn, "SELECT id, emp_id, fname, mname, lname FROM user_tbl WHERE id = '".$_POST['imgs_id']."'");
    $row = mysqli_fetch_array($query);

    echo json_encode($row);
}


?>