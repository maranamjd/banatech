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
$_SESSION['currentPage'] = 'employeeSlip';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Payslip</title>

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
                  Payslip
                  <small></small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../profile/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Payslip</li>
               </ol>
               <br />
            </section>
            <!-- Main content -->
            <section class="content" style="overflow-x: hidden;">
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
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-9">
                          <form class="" action="#" method="post">
                            <div class="form-group col-xs-7">
                              <label for="date">Payroll Date</label>
                              <input type="date" name="date" id="date" class="form-control">
                            </div>
                            <div class="form-group col-xs-2">
                              <input type="submit" id="downloadpayslip" name="downloadpayslip" value="View" class="btn btn-primary">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
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
