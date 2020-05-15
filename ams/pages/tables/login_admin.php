<!DOCTYPE html>
<html lang="en">

<style>

body{
    margin: 0;
    padding: 0;
    
}

input[name=uname], input[name=pass]{
    width: 70%;
    padding: 8px;
    border-radius: 3px;
    border: 1px solid lightgray;
    margin-top: 1em;
}

input[name=sub]{
    width: 70%;
    padding: 12px;
    background: #5b9bd5;
    color: white;
    border-radius: 3px;
    border: transparent;
    margin-top: 1em;
    font-size: 1em;
    font-family:arial;
}

#logform{
    display: grid;
    grid-template-columns: 1fr 1fr;
    width: 60%;
    left: 20%;
    margin-top: 15%;
    position: absolute;
  
    
}

#logform #banate2{
    display: grid;
    align-content: center;
}

.banate{
    top: 20%;
    width: 100%;
    height: 30%;
}

 .des{

background: #5b9bd5;
clip-path: polygon(100% 25%, 100% 0, 85% 0);
width: 100%;
height: 100%;
position: absolute;
}

 .des2{

background: #5b9bd5;
clip-path: polygon(100% 100%, 100% 75%, 85% 100%);
width: 100%;
height: 100%;
position: absolute;
}


 


.rob{
	/* font-family: 'Roboto', sans-serif;
font-family: 'Source Code Pro', monospace;
font-family: 'Noto Serif JP', serif;
font-family: 'Kanit', sans-serif;
font-family: 'Orbitron', sans-serif;
font-family: 'Poiret One', cursive; */
font-family: Arial;
color: #5b9bd5;
font-size: 17px;
}

.o{
	font-family: 'Roboto', sans-serif;
font-family: 'Source Code Pro', monospace;
font-family: 'Noto Serif JP', serif;
font-family: 'Kanit', sans-serif;
font-family: 'Orbitron', sans-serif;
font-family: 'Poiret One', cursive;
font-weight: bold;
color: red;
}

.adminlog{
    font-size: 30px;
    font-family: 'Roboto', sans-serif;
font-family: 'Source Code Pro', monospace;
font-family: 'Noto Serif JP', serif;
font-family: 'Kanit', sans-serif;
font-family: 'Orbitron', sans-serif;
font-family: 'Poiret One', cursive;
font-weight: bold;
}

@media(max-width: 900px){

    #logform{
    display: grid;
    grid-template-columns: 1fr;
    width: 60%;
    margin-top: 15%;
    
}


}





</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Roboto|Source+Code+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Orbitron|Roboto|Source+Code+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Orbitron|Poiret+One|Roboto|Source+Code+Pro" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Admin Log</title>
</head>
<body>

<?php
    session_start();

    if(isset($_SESSION['ad_uname'])){
        header('Location:data.php');
    }

?>


<center>


<div id='logform'>

<div id='banate2'>
<img src='../../banate2.png' class='banate'><br>
<h class='rob'>BANATE CELLPHONE REPAIR AND MAINTENANCE</h>
</div>


<div id='inputform'>
    
<h class='adminlog'>Admin Login</h>
  
    <form action='login_admin.php' method='POST' enctype="multipart/form-data">
    
        <input type='text' name='uname' id='uname' placeholder='Username'>
   
        <input type='password' name='pass' id='pass' placeholder='Password'>
    
        <input type='submit' name='sub' id='sub' value='Login'>
   

    </form>
</div>
</div>

</center>

<div class='des'>

</div>

<div class='des2'>

</div>


<?php

   
require('robo_db_conn.php');

    if(isset($_POST['sub'])){


        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        $pass = base64_encode($pass);
        
     


        $log = mysqli_query($conn, "SELECT * FROM user_tbl WHERE (emp_id = '$uname' and fname = '$pass') and role = 'Admin'");

        while($ress = mysqli_fetch_array($log)){
                $result_id = $ress['id'];
        }
   
        if(mysqli_num_rows($log) == 1 ){

       
        
            $_SESSION['ad_uname'] = $uname;
            $_SESSION['ad_pass'] = $pass;
            $_SESSION['id'] = $result_id;
            header('Location:data.php');
       
           }

           else{
            echo "<script>alert()</script>";
            echo "<script>alert('Wrong username or password')</script>";
        
           
        }
               
        }
       

    

?>


<?php
if(isset($_GET['out'])){
   
   echo "<script> alert('Logged out' + ' ' + '".$_SESSION['ad_uname']."'); </script>";
    
    session_destroy();
  } 

?>


<script>

  $('#uname').focus();


</script>


</body>
</html>