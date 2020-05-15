<?php
include '../functions/function.php';
include '../functions/db.php';


$email = decryptIt(str_replace('Fs', '/', $_GET['email']));
$id 	 = decryptIt(str_replace('Fs', '/', $_GET['id']));
$hash  = $_GET['hash'];

$statement = $connection->prepare("SELECT a.Email, b.hash FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE a.EmployeeId = '$id'");
$result = $statement->execute();
$result = $statement->fetchAll();
if($hash != $result[0]['hash'] || $email != $result[0]['Email'])
	header('Location: ../../../');

?>
<!DOCTYPE html>
<html>
<head>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="../../../assets/img/drakeicon.png">
	<link href="../../../assets/css/style.css" rel="stylesheet" />
	<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
	<title>Reset Password</title>
</head>
<body>

	  <div class="body"></div>
		<div class="grad"></div>
		<div class="main">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-offset-2 col-md-12">
						<div class="header2">
							<div>Payroll <span>Management </span>System</div>
						</div>
					</div>
				</div>
        <div class="row">
					<div class="col-md-offset-2 col-md-4">
						<div class="login">
							<form id="reset" action="#" method="post">
								<input type="password" placeholder="New Password" id="newpass" name="username" pattern="^.*(?=.{12,})(?=.*[a-zA-Z])(?=.*\d).*$" title="must contain characters and numbers minimum length of 12" autofocus required><br>
								<input type="password" placeholder="Verify Password" id="confirmpass" name="password" pattern="^.*(?=.{12,})(?=.*[a-zA-Z])(?=.*\d).*$" title="must contain characters and numbers minimum length of 12" required>
								<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
								<br><br>
								<input type="submit" class="button" value="Change Password" id="btnSave" name="login">
							</form>
						</div>
					</div>
        </div>
			</div>
		</div>
		<?php include '../includes/confirmation.php';
		include '../includes/alert.php'; ?>
			<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
			<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="../../../assets/js/profile.js"></script>
</body>
</html>
