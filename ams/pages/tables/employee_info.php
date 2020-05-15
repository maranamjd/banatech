<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<?php require('cont/robohead.php'); ?>

  <div class="content-wrapper">
  
  <section class="content-header">
    <h1>
      <i class='fa fa-user'></i> Employee's
      <small>Information</small>
    </h1>
    <ol class="breadcrumb">
    
      <li class="active">Employee's data</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
      
         <div class="box-body">

      

         <?php
        
            

        $en = "10D07C33+asd1343454=312%dfg+fdg%^fghooi*dfgo&34dg%fdoigoidifooijo%oidifjog&idsf==123eeodn+j=joi923dfgdfgdf56rt";

                    date_default_timezone_set("Singapore");

            if(isset($_GET['visit'])){

                $id = $_GET['visit'];

    

                if(isset($_POST['data_date'])){
                    $datein = $_POST['data_date'];

                    $display = mysqli_query($conn, "SELECT * FROM user_tbl where id = '$id'");
                    $dis_time = mysqli_query($conn, "SELECT TIME_FORMAT(time_in, '%h:%i:%s %p') time_in, date_in, TIME_FORMAT(time_out, '%h:%i:%s %p') time_out, date_out, tot FROM date_in_tbl where id = '$id' and date_in LIKE '%$datein%' ");

                    $result_inf = mysqli_fetch_array($display);

                    if($result_inf['img'] != ''){ 

             
                   echo "<div id='emp_info'>";
                    echo "<div>";
                   echo '<a href="#" class="changes-img" id="'.$result_inf['id'].'"><img src="data:image/jpeg;base64,'.base64_encode( $result_inf['img'] ).'" class="dp"/ > </a>'; 
                    echo "</div>";
                    echo "<div id='empinfo_name'>";
                                                               echo $result_inf['fname']. " ";
                                                            echo $result_inf['mname']. " "; 
                                                             echo $result_inf['lname']. " "; 
                                                             echo "<br><small><a href='edit_empl.php?edit=".$result_inf['id']."' id='ed_rf'><i class='fa fa-edit'></i>Edit RFID</a></small>";
    
                                                               echo "</div></div>";
    
                                                               echo "<div id='pick'><form action='employee_info.php?visit=".$result_inf['id']."&".$en."' method='POST' id='date_form'>";
                                                               echo '<input type="month" name="data_date" id="datepicker">';
                                                              echo '<button type="submit" class="dates_butt" id="dates_butt"><i class="fa fa-search"></i></button>';
                                                               echo "</form></div>";

                                                               echo "<div id='pick_print'><form action='time_report.php?report=".$result_inf['id']."&".$en."' method='POST' id='report_form'>";
                                                               echo '<input type="month" name="print_date" id="datepicker">';
                                                              echo '<button type="submit" class="print_butt" id="print_butt"><i class="fa fa-file-pdf-o"></i></button>';
                                                              
                                                               echo "</form></div>";

                                                           


                ?>

                 <table id='example2' class='table table-bordered table-hover'><thead><th>Time In</th><th>Date In</th><th>Time OUT</th><th>Date Out</th><th>Total</th></thead>
                <?php
                   while($restime = mysqli_fetch_array($dis_time)){
                    $res_timeout = $restime['time_out'];


                    if($res_timeout == '12:00:00 AM'){

                   

               ?>

                <tr><td>
                                
                                <?php echo $restime['time_in']; ?>
                               </td><td>
                                <?php echo $restime['date_in']; ?>
                                </td><td>
                                <?php echo "00:00:00"; ?>
                                </td><td>
                                <?php echo $restime['date_out']; ?>
                                </td><td>
                                <?php echo $restime['tot']; ?>
                            </td></tr>


               <?php }else{ ?>
   
               
                        
                                 <tr><td>
                                
                                   <?php echo $restime['time_in']; ?>
                                  </td><td>
                                   <?php echo $restime['date_in']; ?>
                                   </td><td>
                                   <?php echo $restime['time_out']; ?>
                                   </td><td>
                                   <?php echo $restime['date_out']; ?>
                                   </td><td>
                                   <?php echo $restime['tot']; ?>
                               </td></tr>
                               

            <?php
                  }  }?>
                    </table>

            <?php
                  }else{

                      echo "<div id='emp_info'>";
                      echo "<div>";
                     echo '<a href="#" class="changes-img" id="'.$result_inf['id'].'"><img src="ad_def.png" class="dp"/ > </a>'; 
                      echo "</div>";
                      echo "<div id='empinfo_name'>";
                                                                 echo $result_inf['fname']. " ";
                                                              echo $result_inf['mname']. " "; 
                                                               echo $result_inf['lname']. " "; 
                                                               echo "<br><small><a href='edit_empl.php?edit=".$result_inf['id']."' id='ed_rf'><i class='fa fa-edit'></i>Edit RFID</a></small>";
                                                
                                                                 echo "</div></div>";
      
                                                                 echo "<div id='pick'><form action='employee_info.php?visit=".$result_inf['id']."&".$en."' method='POST' id='date_form'>";
                                                                 echo '<input type="month" name="data_date" id="datepicker">';
                                                                echo '<button type="submit" class="dates_butt" id="dates_butt"><i class="fa fa-search"></i></button>';
                                                                 echo "</form></div>";

                                                                 echo "<div id='pick_print'><form action='time_report.php?report=".$result_inf['id']."&".$en."' method='POST' id='report_form'>";
                                                                 echo '<input type="month" name="print_date" id="datepicker">';
                                                                echo '<button type="submit" class="print_butt" id="print_butt"><i class="fa fa-file-pdf-o"></i></button>';
                                                                
                                                                 echo "</form></div>";
  
                  ?>
                  
                 <table id='example2' class='table table-bordered table-hover'><thead><th>Time In</th><th>Date In</th><th>Time OUT</th><th>Date Out</th><th>Total</th></thead>
                <?php
                    while($restime = mysqli_fetch_array($dis_time)){
                      $res_timeout = $restime['time_out'];
  
  
                      if($res_timeout == '12:00:00 AM'){
  
                     
  
                 ?>
  
                  <tr><td>
                                  
                                  <?php echo $restime['time_in']; ?>
                                 </td><td>
                                  <?php echo $restime['date_in']; ?>
                                  </td><td>
                                  <?php echo "00:00:00"; ?>
                                  </td><td>
                                  <?php echo $restime['date_out']; ?>
                                  </td><td>
                                  <?php echo $restime['tot']; ?>
                              </td></tr>
  
  
                 <?php }else{ ?>
     
                 
                          
                                   <tr><td>
                                  
                                     <?php echo $restime['time_in']; ?>
                                    </td><td>
                                     <?php echo $restime['date_in']; ?>
                                     </td><td>
                                     <?php echo $restime['time_out']; ?>
                                     </td><td>
                                     <?php echo $restime['date_out']; ?>
                                     </td><td>
                                     <?php echo $restime['tot']; ?>
                                 </td></tr>
                                 
                   
                <?php   } } ?>
                </table>

                <?php 
                    }

                        ?>
                 

                <?php    

                }else{

            
            ?>

            <?php

              
          $date = date('Y-m');          
                  
            $display = mysqli_query($conn, "SELECT * FROM user_tbl where id = '$id'");
              $dis_time = mysqli_query($conn, "SELECT TIME_FORMAT(time_in, '%h:%i:%s %p') time_in, date_in, TIME_FORMAT(time_out, '%h:%i:%s %p') time_out, date_out, tot  FROM date_in_tbl where id = '$id' ");
                
                $result_inf = mysqli_fetch_array($display);

                if($result_inf['img'] != ''){
            
               echo "<div id='emp_info'>";
                echo "<div>";
               echo '<a href="#" class="changes-img" id="'.$result_inf['id'].'"><img src="data:image/jpeg;base64,'.base64_encode( $result_inf['img'] ).'" class="dp"/ > </a>'; 
                echo "</div>";
                echo "<div id='empinfo_name'>";
                                                       echo $result_inf['fname']. " ";
                                                      echo $result_inf['mname']. " "; 
                                                      echo $result_inf['lname']. " "; 
                                                      // echo "<br><small><a href='edit_empl.php?edit=".$result_inf['id']."'><i class='fa fa-edit'></i>Edit RFID</a></small>";
                                                      echo "<br><small><a href='edit_empl.php?edit=".$result_inf['id']."' id='ed_rf'><i class='fa fa-edit'></i>Edit RFID</a></small>";
                                                           echo "</div></div>";

                                                           echo "<div id='pick'><form action='employee_info.php?visit=".$result_inf['id']."&".$en."' method='POST' id='date_form'>";
                                                           echo '<input type="month" name="data_date" id="datepicker">';
                                                          echo '<button type="submit" class="dates_butt" id="dates_butt"><i class="fa fa-search"></i></button>';
                                                           echo "</form></div>";

                                                           echo "<div id='pick_print'><form action='time_report.php?report=".$result_inf['id']."&".$en."' method='POST' id='report_form'>";
                                                           echo '<input type="month" name="print_date" id="datepicker">';
                                                          echo '<button type="submit" class="print_butt" id="print_butt"><i class="fa fa-file-pdf-o"></i></button>';
                                                          
                                                           echo "</form></div>";
                                                           
                                                         

                                                         
            ?>



               <table id='example2' class='table table-bordered table-hover'><thead><th>Time In</th><th>Date In</th><th>Time OUT</th><th>Date Out</th><th>Total</th></thead>
                <?php
                     while($restime = mysqli_fetch_array($dis_time)){
                      $res_timeout = $restime['time_out'];
  
  
                      if($res_timeout == '12:00:00 AM'){
  
                     
  
                 ?>
  
                  <tr><td>
                                  
                                  <?php echo $restime['time_in']; ?>
                                 </td><td>
                                  <?php echo $restime['date_in']; ?>
                                  </td><td>
                                  <?php echo "00:00:00"; ?>
                                  </td><td>
                                  <?php echo $restime['date_out']; ?>
                                  </td><td>
                                  <?php echo $restime['tot']; ?>
                              </td></tr>
  
  
                 <?php }else{ ?>
     
                 
                          
                                   <tr><td>
                                  
                                     <?php echo $restime['time_in']; ?>
                                    </td><td>
                                     <?php echo $restime['date_in']; ?>
                                     </td><td>
                                     <?php echo $restime['time_out']; ?>
                                     </td><td>
                                     <?php echo $restime['date_out']; ?>
                                     </td><td>
                                     <?php echo $restime['tot']; ?>
                                 </td></tr>
                                 
                  <?php
                    }
                  }
                  ?>
                      </table>
                  <?php
                  
                  }else{
                    echo "<div id='emp_info'>";
                    echo "<div>";
                   echo '<a href="#" class="changes-img" id="'.$result_inf['id'].'"><img src="ad_def.png" class="dp"/ > </a>'; 
                    echo "</div>";
                    echo "<div id='empinfo_name'>";
                                                               echo $result_inf['fname']. " ";
                                                            echo $result_inf['mname']. " "; 
                                                             echo $result_inf['lname']. " "; 
                                                             echo "<br><small><a href='edit_empl.php?edit=".$result_inf['id']."' id='ed_rf'><i class='fa fa-edit'></i>Edit RFID</a></small>";
                                                               echo "</div></div>";
                                                               
                                                               echo "<div id='pick'><form action='employee_info.php?visit=".$result_inf['id']."&".$en."' method='POST' id='date_form'>";
                                                               echo '<input type="month" name="data_date" id="datepicker">';
                                                              echo '<button type="submit" class="dates_butt" id="dates_butt"><i class="fa fa-search"></i></button>';
                                                               echo "</form></div>";

                                                               echo "<div id='pick_print'><form action='time_report.php?report=".$result_inf['id']."&".$en."' method='POST' id='report_form'>";
                                                               echo '<input type="month" name="print_date" id="datepicker">';
                                                              echo '<button type="submit" class="print_butt" id="print_butt"><i class="fa fa-file-pdf-o"></i></button>';
                                                              
                                                               echo "</form></div>";


                  ?>                                        

               <table id='example2' class='table table-bordered table-hover'><thead><th>Time In</th><th>Date In</th><th>Time OUT</th><th>Date Out</th><th>Total</th></thead>
               <?php
                   while($restime = mysqli_fetch_array($dis_time)){
                    $res_timeout = $restime['time_out'];


                    if($res_timeout == '12:00:00 AM'){

                   

               ?>

                <tr><td>
                                
                                <?php echo $restime['time_in']; ?>
                               </td><td>
                                <?php echo $restime['date_in']; ?>
                                </td><td>
                                <?php echo "00:00:00"; ?>
                                </td><td>
                                <?php echo $restime['date_out']; ?>
                                </td><td>
                                <?php echo $restime['tot']; ?>
                            </td></tr>


               <?php }else{ ?>
   
               
                        
                                 <tr><td>
                                
                                   <?php echo $restime['time_in']; ?>
                                  </td><td>
                                   <?php echo $restime['date_in']; ?>
                                   </td><td>
                                   <?php echo $restime['time_out']; ?>
                                   </td><td>
                                   <?php echo $restime['date_out']; ?>
                                   </td><td>
                                   <?php echo $restime['tot']; ?>
                               </td></tr>
                               
                 <?php
                   }
                  }
                 ?>
                     </table>
  

              
                <?php    
                }
                 }
                    
                  }?>


 
      



     </div>
      
      </div>
 
    </div>

  </div>

</section>

</div>


 

<?php require('cont/robofoot.php'); ?>



    
</body>
</html>