<?php

require('../robo_db_conn.php');

        if(!empty($_POST)){

            $img = addslashes(file_get_contents($_FILES['emp_img']['tmp_name']));
            
           
            $empid = mysqli_real_escape_string($conn, $_POST['emp_id']);
            $fname= mysqli_real_escape_string($conn, $_POST['fname']);
            $mname = mysqli_real_escape_string($conn, $_POST['mname']);
            $lname = mysqli_real_escape_string($conn, $_POST['lname']);

            $select = mysqli_query($conn, "SELECT emp_id FROM user_tbl where emp_id = '$empid'");
          

            $query = "INSERT INTO user_tbl(emp_id, fname, mname, lname, img) VALUES ('$empid', '$fname', '$mname', '$lname', '$img')";
           
         
                $res = mysqli_query($conn, $query);
              
            }
       

         
         
            
     


?>