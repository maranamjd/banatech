<?php

require('../robo_db_conn.php');

        if(!empty($_POST)){
            $id = mysqli_real_escape_string($conn, $_POST['ad_id']);
            $uname = mysqli_real_escape_string($conn, $_POST['ed_ad_uname']);
            $email = mysqli_real_escape_string($conn, $_POST['ed_ad_email']);
            

            $query = "UPDATE user_tbl SET emp_id='$uname', email='$email' where id = '$id'";
     
         
                $res = mysqli_query($conn, $query);
           
         
        }


?>