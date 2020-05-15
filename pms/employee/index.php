<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
  header('Location: ../');
}
else {
  if ($_SESSION['usertype'] == 0) {
    header('Location: ../hr');
  }
  elseif ($_SESSION['usertype'] == 1) {
    header('Location: ../accounting');
  }
}
$_SESSION['currentPage'] = 'index';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Home</title>
      <?php include '../includes/header.php'; ?>

   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

                      <?php include '../includes/employee/header.php'; ?>
                      <?php include '../includes/employee/sidenav.php'; ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper" style="margin-top: 50px">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  Home
                  <small></small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
                     <h3 class="box-title">Print</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                        <i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                  </div>
               </div>
               <!-- /.box-body -->
               <!-- /.box-footer-->
         </div>
         <!-- /.box -->
         </section>
         <!-- /.content -->
      </div>
      <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->

      <?php include '../includes/footer.php'; ?>
   </body>
</html>
