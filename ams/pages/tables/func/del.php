<?php

require('../robo_db_conn.php');

        if(!empty($_GET)){
            $id = mysqli_real_escape_string($conn, $_GET['del_id']);
            $empid = mysqli_real_escape_string($conn, $_POST['del_emp_id']);
          
            $query = "UPDATE user_tbl SET stat = 'Deleted' where id = '$id'";
    
         
                $res = mysqli_query($conn, $query);
           
         
        }


?>