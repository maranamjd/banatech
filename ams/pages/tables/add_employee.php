<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<?php require('cont/robohead.php'); ?>



  <div class="content-wrapper">
  
  <section class="content-header">
    <h1>
    <i class="fa fa-plus-circle"></i> Add
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

       

             <form action='add_employee.php' method='POST' id='adminsform'>
             <h class='con'><i class='fa fa-user'></i></h>  <br> 
             <input type='text' name='emp_fname' id='emp_fname' placeholder='First Name'><br>
             <input type='text' name='emp_mname' id='emp_mname' placeholder='Middle Name'><br>
             <input type='text' name='emp_lname' id='emp_lname' placeholder='Last Name'><br><br>
             <h class='con'><i class='fa fa-credit-card'></i></h><input type='text' name='emp_rfid' id='emp_rfid' placeholder='Employee RFID'><br>
            
            
             <input type='submit' name='add_sub' id='add_sub' onclick='return confirm("Are you sure?")' value='Save'>
             <input type='submit' name='can' id='can' value='Reset'>
            </form> 
        
         
           
        <?php


            if(isset($_POST['add_sub'])){

                $emp_rfid = $_POST['emp_rfid'];
                $fname = $_POST['emp_fname'];
                $mname = $_POST['emp_mname'];
                $lname = $_POST['emp_lname'];

           


                $admin_query = mysqli_query($conn, "SELECT * FROM user_tbl where emp_id='$emp_rfid'");

                $add_admin = "INSERT INTO user_tbl(emp_id, fname, mname, lname, role, stat) VALUES('$emp_rfid','$fname','$mname','$lname','Employee', 'Active')";

                if(mysqli_num_rows($admin_query)){
                    echo "<script>alert('Employee ID was already used')</script>";
                }else{

                    $res = mysqli_query($conn, $add_admin);
                    echo "<script>alert('Employee was successfully Inserted')</script>";

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