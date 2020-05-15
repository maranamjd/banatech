<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<?php require('cont/robohead.php'); ?>



  <div class="content-wrapper">
  
  <section class="content-header">
    <h1>
    <i class="fa fa-plus-circle"></i> Change Admin's
      <small>Password</small>
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

       

             <form action='change_pass.php' method='POST' id='adminsform'>
           

             <h class='con'><i class='fa fa-unlock'></i></h><input type='password' name='pass1' id='pass1' placeholder='Current Password'><br>
             <h class='con'><i class='fa fa-lock'></i></h><input type='password' name='new_pass' id='new_pass' placeholder='New Password'><br>
             <h class='con'><i class='fa fa-lock'></i></h><input type='password' name='conf_pass' id='conf_pass' placeholder='Confirmation Password'><br>
            
            
             <input type='submit' name='sub' id='sub' onclick='return confirm("Are you sure?")' value='Save'>
             <input type='submit' name='can' id='can' value='Reset'>
            </form> 
        
         
           
        <?php



            if(isset($_POST['sub'])){

                
                $cur_pass = base64_encode($_POST['pass1']);
                $new_pass = base64_encode($_POST['new_pass']);
                $conf_pass = base64_encode($_POST['conf_pass']);

           


               

                $add_admin = "UPDATE user_tbl SET fname='$new_pass' where id = ".$_SESSION['id']."";

                    if($conf_pass != $new_pass){
                        echo "<script>alert('New password and Confirmation password should desame')</script>";
                    }
                    
                    elseif($cur_pass == ''){
                        echo "<script>alert('Need your current password')</script>";
                    }

                    elseif($cur_pass != $_SESSION['ad_pass']){
                        echo "<script>alert('Wrong Current password')</script>";
                    }

                   
                    else{
                
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