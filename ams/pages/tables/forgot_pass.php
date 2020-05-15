<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>




<form action='forgot_pass.php' method='POST'>
<input type='email' name='email' id='email'>
<input type='submit' name='sub'>

</form>

<?php

  

?>


<?php
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;

     $key = md5('australia');
     $salt = md5('australia');

     function decrypt($string, $key){
         $string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($string), MCRYPT_MODE_ECB));
         return $string;
     }
 
  

$conn = mysqli_connect('localhost', 'root');
        mysqli_select_db($conn, 'robolite');

    if($_POST){

        $email = $_POST['email'];
        $query = mysqli_query($conn, "SELECT * FROM user_tbl where email = '$email'");
        $check = mysqli_num_rows($query);
        $res = mysqli_fetch_array($query);

        if($check > 0){

            

            require '../../vendor/autoload.php';


            $mail = new PHPMailer(true);
            try{
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
          
            $mail->SMTPAuth = true;
            $mail->Username = "lloydcruz1230@gmail.com";
            $mail->Password = "mot12301230";
            $mail->SMTPSecure = "false";
            $mail->Port = 587;

            $mail->From = 'lloydcruz1230@gmail.com';
            $mail->FromName = 'Lloyd';
            $mail->addAddress($res["email"],$res["email"]);

            $mail->isHTML(true);

            $mail->Subject = 'PASSWORD';
          
            $mail->Body = '<i>Your current username: </i>'.$res["emp_id"].'<br><i>Your current password: </i>'.base64_decode($res["fname"]);
           

            $mail->send();
             echo "Your password has been sent to you email";
         
            }
            catch(Exception $e){
                echo "Mail Error:". $mail->ErrorInfo;   
            }

        }
        
        else{
   
            echo 'tanga';
        }
    }


?>

    
</body>
</html>