<?php

require('../robo_db_conn.php');

        if(!empty($_POST)){
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $empid = mysqli_real_escape_string($conn, $_POST['ed_emp_id']);
            $fname= mysqli_real_escape_string($conn, $_POST['ed_fname']);
            $mname= mysqli_real_escape_string($conn, $_POST['ed_mname']);
            $lname = mysqli_real_escape_string($conn, $_POST['ed_lname']);
            

            $query = "UPDATE user_tbl SET emp_id='$empid', fname='$fname', mname='$mname', lname='$lname' where id = '$id'";
     
         
                $res = mysqli_query($conn, $query);
           
         
        }


?>