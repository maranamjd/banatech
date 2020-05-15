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
$_SESSION['currentPage'] = 'profile';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Profile</title>
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
                  <small>View</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Profile</li>
               </ol>
               <br />
            </section>
            <!-- Main content -->
            <section class="content" style="overflow-y: scroll;">
              <?php include '../includes/confirmation.php'; ?>
              <?php include '../includes/alert.php'; ?>
               <!-- Default box -->
               <div class="box">
                  <div class="box-header with-border">
                     <h3 class="box-title">Information</h3>
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
                     <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                           <b>ID</b> <a class="pull-right"><?php echo $_SESSION['EmployeeId']; ?></a>
                        </li>
                        <li class="list-group-item">
                           <b>Name</b> <a class="pull-right"><?php echo $_SESSION['Name']; ?></a>
                        </li>
                        <li class="list-group-item">
                           <b>Position</b> <a class="pull-right"><?php echo $_SESSION['Position']; ?></a>
                        </li>
                        <li class="list-group-item">
                           <b>Email</b> <a class="pull-right"><?php echo $_SESSION['Email']; ?></a>
                        </li>
                     </ul>
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
   </body>
</html>
