<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<?php require('cont/robohead.php'); ?>



  <div class="content-wrapper">
  
  <section class="content-header">
    <h1>
    <i class="fa fa-plus-circle"></i> Edit
      <small>Employee</small>
    </h1>
    <ol class="breadcrumb">
    
      <li class="active">Admin Fillup</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
      
         <div class="box-body">

             <?php
                if(isset($_GET['edit'])){
                    $id = $_GET['edit'];

                    $emp_data = mysqli_query($conn, "SELECT * FROM user_tbl where id = '$id'");

                    while($result = mysqli_fetch_array($emp_data)){
                            $getfname = $result['fname'];
                            $getmname = $result['mname'];
                            $getlname = $result['lname'];
                            $getempid = $result['emp_id'];


                    }

                }
             ?>

       

             <form action='edit_empl.php?edit=<?php echo $id; ?>' method='POST' id='adminsform'>
         
             <input type='hidden' name='id' id='id' value='<?php echo $id; ?>'>
             <b><div> <small>Employee Name:</small> <?php echo $getfname." ".$getmname." ".$getlname ?> </div></b>
             <h class='con'><i class='fa fa-credit-card'></i></h><input type='text' name='emp_rfid' id='emp_rfid' value='<?php echo $getempid; ?>'><br>
            
            
             <input type='submit' name='add_sub' id='add_sub' onclick='return confirm("Are you sure?")' value='Update'>
            <a href='employee_info.php?visit=<?php echo $id; ?>' class='btn btn-default'>Back</a>
            </form> 
            
         
           
        <?php


            if(isset($_POST['add_sub'])){
                $id_emp = $_POST['id'];
                $emp_rfid = $_POST['emp_rfid'];


           


                $admin_query = mysqli_query($conn, "SELECT * FROM user_tbl where emp_id='$emp_rfid'");

                $update_emp = "UPDATE user_tbl SET emp_id='$emp_rfid' where id = '$id_emp'";

                if(mysqli_num_rows($admin_query)){
              
                    echo "<script>alert('Employee ID was already used')</script>";
                   
                }
   
                else{

                    if($res = mysqli_query($conn, $update_emp)){
                        $update_emp2 = "UPDATE date_in_tbl SET emp_id='$emp_rfid' where id = '$id_emp'";
                        
                        if($res2 = mysqli_query($conn, $update_emp2)){

                        echo "<script>alert('Employee ID was successfully Updated')</script>";
                        echo "<meta http-equiv='refresh' content='0; url=employees.php'>";
                        }
                    }
                   

                }
                

            }

            



        ?>

             
     </div>
      
      </div>
 
    </div>

  </div>

</section>

</div>

    

<?php require('cont/robofoot.php'); ?>

<script>

    $('#uname').focus();

    $('#can').click(function(){
        $('#adminsform')[0].reset();
    });
 
</script>
</body>
</html>