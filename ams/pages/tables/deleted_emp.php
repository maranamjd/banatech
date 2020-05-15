<!DOCTYPE html>
<html>

  <?php session_start(); ?>

  <?php require('cont/robohead.php'); ?>



  <div class="content-wrapper">
  
  <section class="content-header">
    <h1>
      <i class='fa fa-user'></i> Deleted
      <small>Employees</small>
    </h1>
    <ol class="breadcrumb">
    
      <li class="active">Employee Info</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
      
         <div class="box-body">



  <form action="deleted_emp.php" method="POST" id="employees" name="formal">
  <input type="text" name="emp" id="emp" placeholder="Employee Name" onkeyup="searchemp();">
  <button type="submit" class="dates_butt"><i class="fa fa-search"></i></button>
</form>
                               
         <?php
            
            $en = "10D07C33+asd1343454=312%dfg+fdg%^fghooi*dfgo&34dg%fdoigoidifooijo%oidifjog&idsf==123eeodn+j=joi923dfgdfgdf56rt";
           

                if(isset($_POST['emp'])){

                  $emp = $_POST['emp'];
                     echo "<table id='example2' class='table table-bordered table-hover'><thead><th>First Name</th><th>Middle Name</th><th>Last Name</th><th></th><th></th></thead>";
                       
                $query = mysqli_query($conn, "select * from user_tbl where (fname LIKE '$emp%' OR lname LIKE '$emp%' OR mname LIKE '$emp%' and role = 'Employee') and stat = 'Deleted'");

                    while($res = mysqli_fetch_array($query)){

                        ?>
                            <tr><td>
                 
                 <?php echo $res['fname']; ?>
                  </td><td>
                  <?php echo $res['mname']; ?>
                  </td><td>
                  <?php echo $res['lname']; ?>
                    </td><td>
                   <a href='deleted_emp.php?recyc=<?php echo $res['id']; ?>&<?php echo $en; ?>' class='recyc' onclick='return confirm("Are you sure for restoring this employee?")'><i class='fa fa-recycle'></i></a>
                  </td><td>
                      <a href='deleted_emp.php?delete=<?php echo $res['id']; ?>' class='delete_emp' onclick='return confirm("Are you sure that you want to delete this employee?")'><i class='fa fa-trash-o'></i></a>
                  
                   </td></tr>
                   <?php   } ?>
                      </table>
                 

                <?php } else{

                

                 

                  echo "<table id='example2' class='table table-bordered table-hover'><thead><th>First Name</th><th>Middle Name</th><th>Last Name</th><th></th><th></th></thead>";
                       
                $query2 = mysqli_query($conn, "select * from user_tbl where role = 'Employee' and stat = 'Deleted'");

                    while($res2 = mysqli_fetch_array($query2)){

                  
                    ?>
                      
                       <tr><td>
                 
                        <?php echo $res2['fname']; ?>
                         </td><td>
                         <?php echo $res2['mname']; ?>
                         </td><td>
                         <?php echo $res2['lname']; ?>
                           </td><td>
                          <a href='deleted_emp.php?recyc=<?php echo $res2['id']; ?>&<?php echo $en; ?>' class='recyc' onclick='return confirm("Are you sure for restoring this employee?")'><i class='fa fa-recycle'></i></a>
                         </td><td>
                             <a href='deleted_emp.php?delete=<?php echo $res2['id']; ?>' class='delete_emp' onclick='return confirm("Are you sure that you want to delete this employee?")'><i class='fa fa-trash-o'></i></a>
                         
                          </td></tr>
                     
                  <?php   } ?>
                      </table>
                    

                   <?php } ?>       
                   
                   


                   <?php 


                        if(isset($_GET['recyc'])){

                            $id = $_GET['recyc'];

                            $upd = "UPDATE user_tbl SET stat = 'Active' where id = '$id'";

                            if($res = mysqli_query($conn, $upd))

                            echo '<meta http-equiv="refresh" content="0; url=deleted_emp.php">';


                        }

                        
                        if(isset($_GET['delete'])){

                            $id = $_GET['delete'];

                            $del = "DELETE FROM user_tbl WHERE id = '$id'";

                            if($res_del = mysqli_query($conn, $del))

                            echo '<meta http-equiv="refresh" content="0; url=deleted_emp.php">';


                        }


                    ?>
                               
                        
                               


              
            </div>
      
          </div>
     
        </div>
   
      </div>

    </section>
   
  </div>


  <?php require('cont/robofoot.php'); ?>
 
</body>
</html>
