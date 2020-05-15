<!DOCTYPE html>
<html>

  <?php session_start(); ?>

  <?php require('cont/robohead.php'); ?>



  <div class="content-wrapper">
  
  <section class="content-header">
    <h1>
      <i class='fa fa-user'></i> Employees
      <small>Table</small>
    </h1>
    <ol class="breadcrumb">
    
      <li class="active">Employee data</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
      
         <div class="box-body">



  <form action="employees.php" method="POST" id="employees" name="formal">
  <input type="text" name="emp" id="emp" placeholder="Employee Name" onkeyup="searchemp();">
  <button type="submit" class="dates_butt"><i class="fa fa-search"></i></button>
</form>
                               
         <?php
            
            $en = "10D07C33+asd1343454=312%dfg+fdg%^fghooi*dfgo&34dg%fdoigoidifooijo%oidifjog&idsf==123eeodn+j=joi923dfgdfgdf56rt";
           

                if(isset($_POST['emp'])){

                  $emp = $_POST['emp'];
                     echo "<table id='example2' class='table table-bordered table-hover'><thead><th>First Name</th><th>Middle Name</th><th>Last Name</th><th></th><th></th><th></th></thead>";
                       
                $query = mysqli_query($conn, "select * from user_tbl where (fname LIKE '$emp%' OR lname LIKE '$emp%' OR mname LIKE '$emp%') and role = 'Employee' and stat = 'Active'");

                    while($res = mysqli_fetch_array($query)){
                        echo "<tr><td>";
                  
                        echo $res['fname'];
                         echo "</td><td>";
                         echo $res['mname'];
                          echo "</td><td>";
                          echo $res['lname'];
                          echo "</td><td>";
                          echo "<a href='#' name='edit' id=".$res['id']." class='edit-data'><i class='fa fa-edit'></i></a>";
                          echo "</td><td>";
                          echo "<a href='employee_info.php?visit=".$res['id']."&".$en."' name='visit' id='visit'><i class='fa fa-user'></i></a>";
                          echo "</td><td>";
                          echo "<a href='#' name='delete' id=".$res['id']." class='delete-data'><i class='fa fa-trash-o'></i></a>";
                       echo "</td></tr>";
                     }
                     echo "</table>";
                 

                }
                else{

                

                 

                  echo "<table id='example2' class='table table-bordered table-hover'><thead><th>First Name</th><th>Middle Name</th><th>Last Name</th><th></th><th></th><th></th></thead>";
                       
                $query2 = mysqli_query($conn, "select * from user_tbl where role = 'Employee' and stat = 'Active'");

                    while($res2 = mysqli_fetch_array($query2)){

                  
                    ?>
                      
                       <tr><td>
                 
                        <?php echo $res2['fname']; ?>
                         </td><td>
                         <?php echo $res2['mname']; ?>
                         </td><td>
                         <?php echo $res2['lname']; ?>
                          </td><td>
                          <a href='#' name='edit' id="<?php echo $res2['id']; ?>" class='edit-data'><i class='fa fa-edit'></i></a>
                          
                           </td><td>
                          <a href='employee_info.php?visit=<?php echo $res2['id']; ?>&<?php echo $en; ?>' name='visit' id='visit'><i class='fa fa-user'></i></a>
                         </td><td>
                         <a href='#' name='delete' id="<?php echo $res2['id']; ?>" class='delete-data'><i class='fa fa-trash-o'></i></a>
                         
                          </td></tr>
                     
                  <?php   } ?>
                      </table>
                    

                   <?php } ?>                         
                               
                        
                               


              
            </div>
      
          </div>
     
        </div>
   
      </div>

    </section>
   
  </div>


  <?php require('cont/robofoot.php'); ?>
 
</body>
</html>
