


<?php
     include_once '../../mpdf60/mpdf.php';
     
    require('robo_db_conn.php');


	$id = $_GET['report'];



    date_default_timezone_set("Singapore");

    $cur_date = date('Y-m');
    $cur_mont = date('M Y');
    
if(isset($_POST['print_date'])){

    $mont = $_POST['print_date'];


  
    $emp_query = mysqli_query($conn, "SELECT * FROM user_tbl where id = '$id'");
    $date_query = mysqli_query($conn, "SELECT  time_in, date_in, time_out, date_out, tot FROM date_in_tbl where id = '$id' and date_in LIKE '$mont%'");
    $res = mysqli_fetch_array($emp_query);
    $date_dis = mysqli_query($conn, "SELECT TIME_FORMAT(time_in, '%h:%i:%s %p') time_in, date_in, TIME_FORMAT(time_out, '%h:%i:%s %p') time_out, date_out, tot FROM date_in_tbl where id = '$id' and date_in LIKE '$mont%'");
    
 
        
    
        $mpdf=new mPDF('utf-8', 'A4-P');

        $mpdf->AddPage();
        $mpdf->SetFont('Cambria', 'B', 15);

        $newmont = date("M Y", strtotime($mont));
        
    if($mont != ''){

    
	$output ="<html>";
	$output .="<body>";

    $output.='<div style="padding-left: 460px; color:#BE2C2C"><small><span style="color:#212121"> Military Time Format "00 AM - 23 PM"</span></small></div>';
    $output.='<div style="padding-left: 595px; color:#BE2C2C"><small><span style="color:#212121"> No Time out </span>• </small></div>';
    $output.='<div style="padding-left: 639px; color:#868383"><small><span style="color:#212121"> Late </span>• </small></div>';
    $output .="<table id='tab_info'>";
        $output .="<tr>";
      
            
            $output .="<td>";
            $output .="<img id='logo_tech' src='../../banate2.png' />";
            $output .="</td>";
            $output .="<td class='headerN'>";	
           
            $output .="<p style='font-size:15px;'>Cellephone Repair and Maintenance</p>";
            $output .="</td>";


        $output .="</tr>";
    $output .="</table>";

  
$output.='<div class="indent" style="font-family: chelvetica"><small>Employee Name:</small><b> '.$res['lname'].', '.$res['fname'].' '.$res['mname'].' </b></div>' ;
$output.='<div style="padding-left: 625px"><small> '.$newmont.' </small></div>';

  	$output.='<table id="date_tab">';	
		$output.='<thead>';
			$output.='<tr class="ttr">';
			$output.='<th class="tth" style="font-family: chelvetica" align="center">TIME IN</th><br>';
        			$output.='<th class="tth" style="font-family: chelvetica" align="center">DATE IN</th><br>';
        			$output.='<th class="tth" style="font-family: chelvetica" align="center">TIME OUT</th><br>';
                    $output.='<th class="tth" style="font-family: chelvetica" align="center">DATE OUT</th><br>';
                    $output.='<th class="tth" style="font-family: chelvetica" align="center">TOTAL</th><br>';
		
			
			$output.='</tr>';
		$output.='</thead>';
		

	  
	  
	    while($dis_date = mysqli_fetch_array($date_dis)){
            $time_outt = $dis_date['time_out'];
            $time_inn = $dis_date['time_in'];
            $date_in = $dis_date['date_in'];
            $date_out = $dis_date['date_out'];
            $tot = $dis_date['tot'];
 

        $output .='<tbody>'; 

       $res_date = mysqli_fetch_array($date_query);
      
        if($res_date['time_out'] == '00:00:00'){

 

            $output .='<tr id="forget_out">';
            $output .='<td style="text-align:center; color: white"> '.$time_inn.' </td>';
            $output .='<td style="text-align:center; color: white"> '.$date_in.' </td>';
            $output .='<td style="text-align:center; color: white"> 00:00:00 </td>';
            $output .='<td style="text-align:center; color: white"> '.$date_out.'</td>';
            $output .='<td style="text-align:center; color: white"> '.$tot.' </td>';
        

            $output .='</tr>';
     
      
        }

        
        else{

            if($res_date['time_in'] > '07:00:00'){

                $output .='<tr id="latte">';
                $output .='<td style="text-align:center; color: white"> '.$time_inn.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$date_in.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$time_outt.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$date_out.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$tot.' </td>';
            

                $output .='</tr>';
            }
            
            else{
         
            $output .='<tr>';
            $output .='<td style="text-align:center"> '.$time_inn.' </td>';
            $output .='<td style="text-align:center"> '.$date_in.' </td>';
            $output .='<td style="text-align:center"> '.$time_outt.' </td>';
            $output .='<td style="text-align:center"> '.$date_out.' </td>';
            $output .='<td style="text-align:center"> '.$tot.' </td>';
        

            $output .='</tr>';
            
            }
 

         }   

         $output .='</tbody>';
        
        $today_dateins = $date_in;
        $today_timeins = $time_inn;

        $gtot +=  strtotime($tot) - strtotime('00:00:00');
            
  
    }

            
      
        

        $output .="</table><br>";
        
                  
        $hours = floor($gtot / 3600);
        $minutes = floor(($gtot - ($hours * 3600)) / 60);
        $sec = floor($gtot % 60);

        $gtot = $hours.':'.$minutes.':'.$sec;

           $output.= '<div id="totalhours">TOTAL HOURS FOR THE MONTH OF '.$newmont.' <center><span id="gtot"> '.$gtot.'</span></center></div>';
       
       		

	$output .="</body>";
    $output .="</html>";

    
}else{

    
$emp_query = mysqli_query($conn, "SELECT * FROM user_tbl where id = '$id'");
$date_query = mysqli_query($conn, "SELECT time_in, date_in, time_out, date_out, tot FROM date_in_tbl where id = '$id' and date_in LIKE '$cur_date%'");
$res = mysqli_fetch_array($emp_query);
$date_dis = mysqli_query($conn, "SELECT TIME_FORMAT(time_in, '%h:%i:%s %p') time_in, date_in, TIME_FORMAT(time_out, '%h:%i:%s %p') time_out, date_out, tot FROM date_in_tbl where id = '$id' and date_in LIKE '$cur_date%'");


	

	$mpdf=new mPDF('utf-8', 'A4-P');
    $mpdf->AddPage();
    $mpdf->SetFont('Cambria', 'B', 15);

	$output ="<html>";
	$output .="<body>";


    $output.='<div style="padding-left: 460px; color:#BE2C2C"><small><span style="color:#212121"> Military Time Format "00 AM - 23 PM"</span></small></div>';
    $output.='<div style="padding-left: 595px; color:#BE2C2C"><small><span style="color:#212121"> No Time out </span>• </small></div>';
    $output.='<div style="padding-left: 639px; color:#868383"><small><span style="color:#212121"> Late </span>• </small></div>';
    $output .="<table id='tab_info'>";
        $output .="<tr>";
      
            
            $output .="<td>";
            $output .="<img id='logo_tech' src='../../banate2.png' />";
            $output .="</td>";
            $output .="<td class='headerN'>";	
           
           $output .="<p style='font-size:15px;'>Cellephone Repair and Maintenance</p>";
            $output .="</td>";


        $output .="</tr>";
    $output .="</table>";

   
$output.='<div class="indent" style="font-family: chelvetica"><small>Employee Name:</small><b> '.$res['lname'].', '.$res['fname'].' '.$res['mname'].' </b></div>' ;
$output.='<div style="padding-left: 625px"><small> '.$cur_mont.' </small></div>';

  	$output.='<table id="date_tab">';	
		$output.='<thead>';
			$output.='<tr class="ttr">';
			$output.='<th class="tth" style="font-family: chelvetica" align="center">TIME IN</th><br>';
        			$output.='<th class="tth" style="font-family: chelvetica" align="center">DATE IN</th><br>';
        			$output.='<th class="tth" style="font-family: chelvetica" align="center">TIME OUT</th><br>';
                    $output.='<th class="tth" style="font-family: chelvetica" align="center">DATE OUT</th><br>';
                    $output.='<th class="tth" style="font-family: chelvetica" align="center">TOTAL</th><br>';
		
			
			$output.='</tr>';
		$output.='</thead>';
		

	  
	    while($dis_date = mysqli_fetch_array($date_dis)){
            $time_outt = $dis_date['time_out'];
            $time_inn = $dis_date['time_in'];
            $date_in = $dis_date['date_in'];
            $date_out = $dis_date['date_out'];
            $tot = $dis_date['tot'];
 

        $output .='<tbody>'; 

       $res_date = mysqli_fetch_array($date_query);
      
        if($res_date['time_out'] == '00:00:00'){

 

            $output .='<tr id="forget_out">';
            $output .='<td style="text-align:center; color: white"> '.$time_inn.' </td>';
            $output .='<td style="text-align:center; color: white"> '.$date_in.' </td>';
            $output .='<td style="text-align:center; color: white"> 00:00:00 </td>';
            $output .='<td style="text-align:center; color: white"> '.$date_out.'</td>';
            $output .='<td style="text-align:center; color: white"> '.$tot.' </td>';
        

            $output .='</tr>';
     
      
        }

        
        else{

            if($res_date['time_in'] > '07:00:00'){

                $output .='<tr id="latte">';
                $output .='<td style="text-align:center; color: white"> '.$time_inn.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$date_in.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$time_outt.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$date_out.' </td>';
                $output .='<td style="text-align:center; color: white"> '.$tot.' </td>';
            

                $output .='</tr>';
            }
            
            else{
         
            $output .='<tr>';
            $output .='<td style="text-align:center"> '.$time_inn.' </td>';
            $output .='<td style="text-align:center"> '.$date_in.' </td>';
            $output .='<td style="text-align:center"> '.$time_outt.' </td>';
            $output .='<td style="text-align:center"> '.$date_out.' </td>';
            $output .='<td style="text-align:center"> '.$tot.' </td>';
        

            $output .='</tr>';
            
            }
 

         }   

         $output .='</tbody>';
        
        $today_dateins = $date_in;
        $today_timeins = $time_inn;

        $gtot +=  strtotime($tot) - strtotime('00:00:00');
            
  
    }
            
      
    


        $output .="</table><br>";
        
                  
        $hours = floor($gtot / 3600);
        $minutes = floor(($gtot - ($hours * 3600)) / 60);
        $sec = floor($gtot % 60);

        $gtot = $hours.':'.$minutes.':'.$sec;

           $output.= '<div id="totalhours">TOTAL HOURS FOR THE MONTH OF '.$cur_mont.' <center><span id="gtot"> '.$gtot.'</span></center></div>';
       
       		

	$output .="</body>";
    $output .="</html>";

   
    
}
}else{

        
$emp_query = mysqli_query($conn, "SELECT * FROM user_tbl where id = '$id'");
$date_query = mysqli_query($conn, "SELECT time_in, date_in, time_out, date_out, tot FROM date_in_tbl where id = '$id' and date_in LIKE '$cur_date%'");
$res = mysqli_fetch_array($emp_query);
$date_dis = mysqli_query($conn, "SELECT TIME_FORMAT(time_in, '%h:%i:%s %p') time_in, date_in, TIME_FORMAT(time_out, '%h:%i:%s %p') time_out, date_out, tot FROM date_in_tbl where id = '$id' and date_in LIKE '$cur_date%'");


	

	$mpdf=new mPDF('utf-8', 'A4-P');

 
	$output ="<html>";
	$output .="<body>";

    $output.='<div style="padding-left: 460px; color:#BE2C2C"><small><span style="color:#212121"> Military Time Format "00 AM - 23 PM"</span></small></div>';
    $output.='<div style="padding-left: 595px; color:#BE2C2C"><small><span style="color:#212121"> No Time out </span>• </small></div>';
    $output.='<div style="padding-left: 639px; color:#868383"><small><span style="color:#212121"> Late </span>• </small></div>';
    $output .="<table id='tab_info'>";
 
        $output .="<tr>";
      
            
            $output .="<td>";
            $output .="<img id='logo_tech' src='../../banate2.png' />";
            $output .="</td>";
            $output .="<td class='headerN'>";	
           
            $output .="<p style='font-size:15px;'>Cellephone Repair and Maintenance</p>";
            $output .="</td>";


        $output .="</tr>";
       
    $output .="</table>";

	
$output.='<div class="indent" style="font-family: chelvetica"><small>Employee Name:</small><b> '.$res['lname'].', '.$res['fname'].' '.$res['mname'].' </b></div>' ;
$output.='<div style="padding-left: 625px"><small> '.$cur_mont.' </small></div>';

  	$output.='<table id="date_tab">';	
		$output.='<thead>';
			$output.='<tr class="ttr">';
			$output.='<th style="font-family: chelvetica" align="center">TIME IN</th><br>';
        			$output.='<th style="font-family: chelvetica" align="center">DATE IN</th><br>';
        			$output.='<th style="font-family: chelvetica" align="center">TIME OUT</th><br>';
                    $output.='<th style="font-family: chelvetica" align="center">DATE OUT</th><br>';
                    $output.='<th style="font-family: chelvetica" align="center">TOTAL</th><br>';
		
			
			$output.='</tr>';
		$output.='</thead>';
	
	  
	   	
	 
     
        
            while($dis_date = mysqli_fetch_array($date_dis)){
                $time_outt = $dis_date['time_out'];
                $time_inn = $dis_date['time_in'];
                $date_in = $dis_date['date_in'];
                $date_out = $dis_date['date_out'];
                $tot = $dis_date['tot'];
     

            $output .='<tbody>'; 

           $res_date = mysqli_fetch_array($date_query);
          
            if($res_date['time_out'] == '00:00:00'){

     

				$output .='<tr id="forget_out">';
				$output .='<td style="text-align:center; color: white"> '.$time_inn.' </td>';
				$output .='<td style="text-align:center; color: white"> '.$date_in.' </td>';
				$output .='<td style="text-align:center; color: white"> 00:00:00 </td>';
                $output .='<td style="text-align:center; color: white"> '.$date_out.'</td>';
                $output .='<td style="text-align:center; color: white"> '.$tot.' </td>';
			

                $output .='</tr>';
         
          
            }

            
            else{

                if($res_date['time_in'] > '07:00:00'){

                    $output .='<tr id="latte">';
                    $output .='<td style="text-align:center; color: white"> '.$time_inn.' </td>';
                    $output .='<td style="text-align:center; color: white"> '.$date_in.' </td>';
                    $output .='<td style="text-align:center; color: white"> '.$time_outt.' </td>';
                    $output .='<td style="text-align:center; color: white"> '.$date_out.' </td>';
                    $output .='<td style="text-align:center; color: white"> '.$tot.' </td>';
                
    
                    $output .='</tr>';
                }
                
                else{
	     	
				$output .='<tr>';
				$output .='<td style="text-align:center"> '.$time_inn.' </td>';
				$output .='<td style="text-align:center"> '.$date_in.' </td>';
				$output .='<td style="text-align:center"> '.$time_outt.' </td>';
                $output .='<td style="text-align:center"> '.$date_out.' </td>';
                $output .='<td style="text-align:center"> '.$tot.' </td>';
			

                $output .='</tr>';
                
                }
     

             }   

             $output .='</tbody>';
            
            $today_dateins = $date_in;
            $today_timeins = $time_inn;

               
            $gtot +=  strtotime($tot) - strtotime('00:00:00');
      
      
        }
         


        $output .="</table><br>";
        
                  
        $hours = floor($gtot / 3600);
        $minutes = floor(($gtot - ($hours * 3600)) / 60);
        $sec = floor($gtot % 60);

        $gtot = $hours.':'.$minutes.':'.$sec;

           $output.= '<div id="totalhours">TOTAL HOURS FOR THE MONTH OF '.$cur_mont.' <center><span id="gtot"> '.$gtot.'</span></center></div>';
       
       		

	$output .="</body>";
    $output .="</html>";

}







	
	$style = file_get_contents('time_reps.css');
	$mpdf->WriteHTML($style, 1);
	$mpdf->WriteHTML($output);

	$mpdf->Output(); //View	

?>

