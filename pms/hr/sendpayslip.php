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
$_SESSION['currentPage'] = 'sendPayslip';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Send Payslip</title>
      <?php include '../includes/header.php'; ?>
      <link rel="stylesheet" href="../assets/css/custom.css">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

           <?php include '../includes/hr/header.php';?>
          <?php include '../includes/hr/sidenav.php';?>

         <div class="content-wrapper" style="margin-top: 50px">
            <section class="content-header">
               <h1>
                  Payroll
                  <small>View Payslip</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="../payroll/">Payroll</a></li>
                  <li class="active">View Payslip</li>
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
                    <div class="container-fluid">
                      <div class="row">
                         <div id="employeeinfo" class="col-md-12">
                            <div class="table-responsive" style="overflow-x: hidden">
                               <br />
                               <br /><br />
                               <table id="paysliptable" class="table table-hover table-condensed table-striped table-responsive">
                                  <thead>
                                     <tr>
                                        <th width=10%>Image</th>
                                        <th width=15%>Employee Id</th>
                                        <th width=60%>Name</th>
                                        <th width=10%>Payslip</th>
                                     </tr>
                                  </thead>
                               </table>
                            </div>
                         </div>
                      </div>
                      <hr />
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
      <!-- /.content-wrapper -->
      <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->

      <?php include '../includes/footer.php'; ?>

      <script type="text/javascript" src="../assets/js/payslipDatatable.js"></script>
   </body>
</html>
