

     <?php
                $conn = mysqli_connect("localhost", "root");
                        mysqli_select_db($conn, "robolite");

                  
                       
                $query = mysqli_query($conn, "select MIN(a.time_in), a.emp_id,  b.fname, b.mname, b.lname, a.time_in, a.date_in, a.time_out,a.date_out from date_in_tbl a inner join user_tbl b where b.emp_id = a.emp_id and date_in = CURDATE() GROUP BY emp_id;");
                $result = array();
                    while($res = mysqli_fetch_array($query))
                        array_push($result, array('emp_id' => $res[1],
                                                  'fname' => $res[2],
                                                  'mname' => $res[3],
                                                  'lname' => $res[4],
                                                  'time_in' => $res[5],
                                                  'date_in' => $res[6],
                                                  'time_out' => $res[7],
                                                  'date_out' => $res[8] ));

                     
                     echo json_encode(array('result' => $result));

                    
                  ?>          
                               
                        