<?php

require('../robo_db_conn.php');

        if(!empty($_POST)){
            $id = mysqli_real_escape_string($conn, $_POST['changes_id']);
            $img = addslashes(file_get_contents($_FILES['ed_emp_img']['tmp_name']));

            $query = "UPDATE user_tbl SET img='$img' where id = '$id'";
     
         
                $res = mysqli_query($conn, $query);
           
         
        }


?>