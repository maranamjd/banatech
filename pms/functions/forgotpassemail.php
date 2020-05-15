<?php
session_start();
include 'db.php';
include 'function.php';
if (isset($_POST['empid'])) {
	$EmployeeId = $mysqli->escape_string($_POST['empid']);
	$hash = $_POST['hash'];
	$result = $mysqli->query("SELECT a.Email, a.LastName, a.MiddleName, a.FirstName, b.hash FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE a.EmployeeId = '$EmployeeId'");

	$row = $result->fetch_assoc();
	$email = $row['Email'];
	$name = $row['FirstName'].' '.ucfirst($row['MiddleName']{0}).'. '.$row['LastName'];
	$hash = $row['hash'];
	$localIP = getHostByName(getHostName());
	$message_body = '
	Hello Mr./Ms. '.$row['LastName'].',<br><br>

	You have requested password reset.<br><br>

	Please click this link to reset your password:<br><br>

	http://'.'pms.drake/reset/'.str_replace('/', 'Fs', encryptIt($email)).'/'.str_replace('/', 'Fs', encryptIt($EmployeeId)).'/'.$hash;

	//Load composer's autoloader
	require '../classes/PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
		//Server settings
		// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'plms.drakeinternational@gmail.com';                 // SMTP username
		$mail->Password = 'mailer@plmsdrake';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('plms.drakeinternational@gmail.com', 'PLMS Mailer');
		$mail->addAddress($email, $name);     // Add a recipient

		//Attachments
		// $mail->addAttachment('../assets/img/drakeicon.png');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'PLMS - Password Reset Link';
		$mail->Body    = $message_body;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		echo 'Email has been sent';
	} catch (Exception $e) {
		echo 'Email could not be sent. Please make sure you are connected to a network. Mailer Error: ', $mail->ErrorInfo;
	}
}
else {
  header('Location: ../');
}
