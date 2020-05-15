<?php
session_start();
	if (isset($_SESSION['isLogin'])) {
		if ($_SESSION['usertype'] == 0) {
			header('Location: hr');
		}
		elseif ($_SESSION['usertype'] == 1) {
			header('Location: accounting');
		}
		elseif ($_SESSION['usertype'] == 2) {
			header('Location: employee');
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="assets/img/drakeicon.png">
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
		<title>Login</title>
	</head>
	<body style="overflow: hidden">
		<?php include 'includes/confirmation.php'; include 'includes/alert.php';?>

		  <div class="body"></div>
			<div class="grad"></div>
			<div class="main">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-offset-3 col-md-6">
							<div class="header">
								<div>Payroll <span>Management </span>System</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="login">
								<form action="functions/login.php" method="POST">
									<input type="text" placeholder="Email" name="username" value="<?php if(isset($_SESSION['logemail'])) echo $_SESSION['logemail'];?>" required autofocus><br>
									<input type="password" placeholder="Password" name="password" id="password" required>
									<br>
									<input type="checkbox" id="showpass"> <a style="color: #ccc" href="#" id="showpasstoggle">Show Password</a>
									<br><br>
									<a class="forgotPassword" href="#" id="forgotpassid">Forgot Password?</a>
									<input type="submit" class="button" value="Login" name="login">
								</form>
							</div>
						</div>
						<div class="message">
							<?php
								if(isset($_SESSION['message'])){
									echo '<div id="alert" class="alert alert-warning alert-dismissable">';
									echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
									echo $_SESSION['message'];
									echo "</div>";
									session_destroy();
								}
							?>
						</div>
					</div>
				</div>
			</div>


			<?php include 'includes/loader.php'; ?>
			<div id="forgotpasswordmodal" class="modal fade" style="margin-top: 150px;">
			    <div class="modal-dialog">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" id="exitModal">&times;</button>
			                    <h4 class="modal-title" id="uploadtitle">Forgot Password</h4>
			                </div>
			                <div class="modal-body">
			                	<form action="functions/forgotpassemail.php" method="POST" id="sendemailid">
			                	          <label for="empid"><h4>Employee ID</h4></label>
			                              <input type="text" class="form-control" name="empid" id="empid" required></input><br>
																		<input type="hidden" name="hash" id="hash" value="">
			                              <label id="notifid" style="display: none; color: red;">Employee ID unknown!!</label><br>
			                            <div class="modal-footer">
			                                <input type="submit" name="btnforgot" id="btnforgotid" class="btn btn-success" value="Submit" disabled="true" />
			                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                            </div>
			                    </form>
			                </div>
			            </div>
			    </div>
			</div>
			  <script src="bower_components/jquery/dist/jquery.min.js"></script>
			  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
				<script type="text/javascript" src="assets/js/profile.js"></script>
	</body>
</html>
