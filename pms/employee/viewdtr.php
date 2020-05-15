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
$_SESSION['currentPage'] = 'viewDtr';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | View DTR</title>

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
                  DTR
                  <small>View</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">View DTR</li>
               </ol>
               <br />
            </section>
            <!-- Main content -->
            <section class="content" id="content">
              <?php include '../includes/confirmation.php'; ?>
              <?php include '../includes/alert.php'; ?>
               <!-- Default box -->
               <div class="box">
                  <div class="box-header with-border">
                     <h3 class="box-title">DTR</h3>
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
                          <form class="" id="dtr_form" action="#" method="post">
                            <div class="form-group col-xs-7">
                              <label for="date">Date From</label>
                              <input type="date" name="date_from" id="date_from" class="form-control" required>
                            </div>
                            <div class="form-group col-xs-7">
                              <label for="date">Date To</label>
                              <input type="date" name="date_to" id="date_to" class="form-control" required>
                            </div>
                            <div class="form-group col-xs-2">
                              <input type="submit" name="submit" value="View" class="btn btn-primary">
                            </div>
                          </form>
                        </div>
                        <div class="col-xs-6" id="dtrDiv" style="display: none">
                          <table class="table table-striped">
                            <thead>
                              <th>Date</th>
                              <th>Time In</th>
                              <th>Time Out</th>
                            </thead>
                            <tbody id="dtrTb">
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

              </div><!--/tab-pane-->
          </div><!--/tab-content-->
                <br />
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

            <?php include '../includes/inloader.php'; ?>
            <?php include '../includes/footer.php'; ?>
   </body>
</html>
