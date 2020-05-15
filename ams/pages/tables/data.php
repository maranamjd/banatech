<!DOCTYPE html>
<html>

  <?php session_start(); ?>

  



<?php require('cont/robohead.php'); ?>

  


<div class="content-wrapper">
  
  <section class="content-header">
    <h1>
      <i class='fa fa-tachometer'></i> Time In & Out
      <small>Table</small>

    </h1>
    <ol class="breadcrumb">
    
      <li class="active">Time and Date</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-body">

              
  <form action="data.php" method="POST" id="date_form">
  <b>SELECT DATE:</b> <input type="date" name="data_date" id="datepicker">
  <button type="submit" class="dates_butt"><i class='fa fa-search'></i></button>
  </form>

  

                               
         <?php
          
                if(isset($_POST['data_date'])){

                  $data_date = $_POST['data_date'];

                
                if($data_date != ''){
                     echo "<table id='example2' class='table table-bordered table-hover'><thead><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Time In</th><th>Date In</th><th>Time OUT</th><th>DATE OUT</th></thead>";
                //$query_time = mysqli_query($conn, "select b.fname, b.mname, b.lname, TIME_FORMAT(a.time_in, '%h:%i:%s %p') time_in, a.date_in, TIME_FORMAT(a.time_out, '%h:%i:%s %p') time_out, a.date_out, a.emp_id, MIN(a.time_in) from date_in_tbl a inner join user_tbl b where b.id = a.id and date_in = '$data_date' GROUP BY emp_id");
                $query_time = mysqli_query($conn, "select b.fname, b.mname, b.lname, a.emp_id, b.stat, MIN(a.time_in) time_in, a.time_out, a.date_in, a.date_out from date_in_tbl a inner join user_tbl b where (b.emp_id = a.emp_id and date_in = '$data_date') and b.stat = 'Active' GROUP BY emp_id  ");
                while($res = mysqli_fetch_array($query_time)){
                  $outi = $res['time_out'];
    
            
                  if($outi == '12:00:00 AM'){
              
                    echo "<tr><td>";
                    echo $res['fname'];
                     echo "</td><td>";
                     echo $res['mname'];
                      echo "</td><td>";
                      echo $res['lname'];
                      echo "</td><td>";
                      echo $res['time_in'];
                      echo "</td><td>";
                      echo $res['date_in'];
                        echo "</td><td>";
                      echo "00:00:00";
                      echo "</td><td>";
                      echo $res['date_out'];
                   echo "</td></tr>";


                  }else{


                    echo "<tr><td>";
                    echo $res['fname'];
                     echo "</td><td>";
                     echo $res['mname'];
                      echo "</td><td>";
                      echo $res['lname'];
                      echo "</td><td>";
                      echo $res['time_in'];
                      echo "</td><td>";
                      echo $res['date_in'];
                        echo "</td><td>";
                      echo $res['time_out'];
                      echo "</td><td>";
                      echo $res['date_out'];
                   echo "</td></tr>";

                
                    
                  }
                }
                     echo "</table>";
                 

              }else{

                echo "<table id='example2' class='table table-bordered table-hover'><thead><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Time In</th><th>Date In</th><th>Time OUT</th><th>Date Out</th></thead>";
                    
                //$query_time2 = mysqli_query($conn, "select b.fname, b.mname, b.lname, TIME_FORMAT(a.time_in, '%h:%i:%s %p') time_in, a.date_in, TIME_FORMAT(a.time_out, '%h:%i:%s %p') time_out, a.date_out, a.emp_id, MIN(a.time_in) from date_in_tbl a inner join user_tbl b where b.id = a.id and date_in = CURDATE() GROUP BY emp_id");
                $query_time2 = mysqli_query($conn, "select b.fname, b.mname, b.lname, a.emp_id, MIN(a.time_in) time_in, a.time_out, a.date_in, a.date_out from date_in_tbl a inner join user_tbl b where (b.emp_id = a.emp_id and date_in = CURDATE())  and b.stat = 'Active' GROUP BY emp_id");
                while($res2 = mysqli_fetch_array($query_time2)){
                  $outi2 = $res2['time_out'];
            
                  if($outi2 == '12:00:00 AM'){
              
                    echo "<tr><td>";
                    echo $res2['fname'];
                     echo "</td><td>";
                     echo $res2['mname'];
                      echo "</td><td>";
                      echo $res2['lname'];
                      echo "</td><td>";
                      echo $res2['time_in'];
                      echo "</td><td>";
                      echo $res2['date_in'];
                        echo "</td><td>";
                      echo "00:00:00";
                      echo "</td><td>";
                      echo $res2['date_out'];
                   echo "</td></tr>";


                  }else{


                    echo "<tr><td>";
                    echo $res2['fname'];
                     echo "</td><td>";
                     echo $res2['mname'];
                      echo "</td><td>";
                      echo $res2['lname'];
                      echo "</td><td>";
                      echo $res2['time_in'];
                      echo "</td><td>";
                      echo $res2['date_in'];
                        echo "</td><td>";
                      echo $res2['time_out'];
                      echo "</td><td>";
                      echo $res2['date_out'];
                   echo "</td></tr>";

                
                    
                  }
                }
             
                 echo "</table>";


                
              }

                }
                else{


                    echo "<table id='example2' class='table table-bordered table-hover'><thead><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Time In</th><th>Date In</th><th>Time OUT</th><th>Date Out</th></thead>";
                    
                    //$query_time2 = mysqli_query($conn, "select b.fname, b.mname, b.lname, TIME_FORMAT(a.time_in, '%h:%i:%s %p') time_in, a.date_in, TIME_FORMAT(a.time_out, '%h:%i:%s %p') time_out, a.date_out, a.emp_id, MIN(a.time_in) from date_in_tbl a inner join user_tbl b where b.id = a.id and date_in = CURDATE() GROUP BY emp_id");
                  $query_time2 = mysqli_query($conn, "select b.fname, b.mname, b.lname, a.emp_id, MIN(a.time_in) time_in, a.time_out, a.date_in, a.date_out from date_in_tbl a inner join user_tbl b where (b.emp_id = a.emp_id and date_in = CURDATE()) and b.stat = 'Active' GROUP BY emp_id ");
                    while($res2 = mysqli_fetch_array($query_time2)){
                      $outi2 = $res2['time_out'];
                
                      if($outi2 == '12:00:00 AM'){
                  
                        echo "<tr><td>";
                        echo $res2['fname'];
                         echo "</td><td>";
                         echo $res2['mname'];
                          echo "</td><td>";
                          echo $res2['lname'];
                          echo "</td><td>";
                          echo $res2['time_in'];
                          echo "</td><td>";
                          echo $res2['date_in'];
                            echo "</td><td>";
                          echo "00:00:00";
                          echo "</td><td>";
                          echo $res2['date_out'];
                       echo "</td></tr>";


                      }else{


                        echo "<tr><td>";
                        echo $res2['fname'];
                         echo "</td><td>";
                         echo $res2['mname'];
                          echo "</td><td>";
                          echo $res2['lname'];
                          echo "</td><td>";
                          echo $res2['time_in'];
                          echo "</td><td>";
                          echo $res2['date_in'];
                            echo "</td><td>";
                          echo $res2['time_out'];
                          echo "</td><td>";
                          echo $res2['date_out'];
                       echo "</td></tr>";

                    
                        
                      }
                    }
                 
                     echo "</table>";


                  
                    
                

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
