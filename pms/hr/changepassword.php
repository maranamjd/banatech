<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
  header('Location: ../');
}
if ($_SESSION['usertype'] == 1) {
  header('Location: ../accounting');
}
elseif ($_SESSION['usertype'] == 2) {
  header('Location: ../employee');
}
$_SESSION['currentPage'] = 'changePassword';
    unset($_SESSION['notif']['password']);
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Change Password</title>
      <?php include '../includes/header.php'; ?>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

           <?php include '../includes/hr/header.php';?>
          <?php include '../includes/hr/sidenav.php';?>

         <div class="content-wrapper" style="margin-top: 50px">
            <section class="content-header">
               <h1>
                  Profile
                  <small>Change Password</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="../profile-hr/">Profile</a></li>
                  <li class="active">Change Password</li>
               </ol>
               <br />
            </section>
            <!-- Main content -->
            <section class="content" style="overflow: hidden;">
              <?php include '../includes/confirmation.php'; ?>
              <?php include '../includes/alert.php'; ?>
               <!-- Default box -->
               <div class="box">
                  <div class="box-header with-border">
                     <h3 class="box-title">Change Password</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                        <i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                    <img class="profile-user-img img-responsive img-circle" src="../assets/upload/<?php echo $_SESSION['image']; ?>" alt="User profile picture">
                    <h3 class="profile-username text-center"><?php echo $_SESSION['Name']; ?></h3>
                    <p class="text-muted text-center"><?php echo $_SESSION['Position']; ?></p>
                       <div class="container">
                         <div class="row">
                           <div class="col-md-4">
                             <form id="changePassword" method="post">
                               <div class="form-group pass">
                                 <label for="newpass">New Password</label>
                                 <input class="pull-right form-control" type="password" name="newpass" id="newpass" pattern="^.*(?=.{12,})(?=.*[a-zA-Z])(?=.*\d).*$" title="must contain characters and numbers minimum length of 12" required>
                               </div>
                               <div class="form-group confpass"><br>
                                 <label for="confirmpass">Confirm Password</label>
                                 <input class="pull-right form-control" type="password" name="confirmpass" id="confirmpass" pattern="^.*(?=.{12,})(?=.*[a-zA-Z])(?=.*\d).*$" title="must contain characters and numbers minimum length of 12" required>
                               </div>
                               <br><br>
                               <div class="form-group">
                                 <input type="checkbox" id="showpass"> <a style="color: #666" href="#" id="showpasstoggle">Show Password</a>
                               </div>
                               <div class="form-group col-md-offset-2 col-md-8"><br>
                                  <input class="btn btn-primary btn-block" id="btnSave" type="submit" name="" value="Save">
                               </div>
                           </form>
                           </div>
                         </div>
                       </div>
                  </div>
                  <!-- /.box-body -->
               </div>
               <!-- /.box -->
         </div>
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </section>
      <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->

      <?php include '../includes/footer.php'; ?>
      <script type="text/javascript">
        $('#notifnum').attr('name', 'yes');
      </script>
   </body>
</html>
