<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
  header('Location: ../');
}
if ($_SESSION['usertype'] == 0) {
  header('Location: ../hr');
}
elseif ($_SESSION['usertype'] == 2) {
  header('Location: ../employee');
}
$_SESSION['currentPage'] = 'loans';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Loans</title>
      <?php include '../includes/header.php'; ?>
      <link rel="stylesheet" href="../assets/css/custom.css">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

        <?php include '../includes/accounting/header.php'; ?>
        <?php include '../includes/accounting/sidenav.php'; ?>

         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper" style="margin-top: 50px">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  Loans
                  <small></small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-ac/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Loans</li>
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
                     <h3 class="box-title">Loans</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                        <i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                    <div class="container-fluid">
                      <div id="payrollbtns">
                        <?php
                        if (isset($_SESSION['reporton'])) {
                          echo '
                          <button class="btn btn-primary" id="showPayrollReport" type="button" name="button">Payroll Report Available</button>
                          ';
                        }
                        ?>
                      </div>
                      <div class="row">
                        <div id="empinfo" class="col-md-12">
                          <div class="table-responsive" style="overflow-x: hidden">
                            <br />
                            <br /><br />
                            <table id="empinformation" class="table table-hover table-striped table-condensed">
                              <thead>
                                <tr>
                                  <th width="5%">Image</th>
                                  <th width="10%">Employee Id</th>
                                  <th width="75%">Name</th>
                                  <th width="10%">Loan</th>
                                  <th width="10%">Action</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
         <!-- /.box -->
         </section>
         <!-- /.content -->
         <div id="payrollReportac" class="modal fade">
             <div class="modal-dialog">
                 <div class="modal-content" style="border-radius: 10px;">
                     <div class="modal-header" style="border-radius: 10px;background-color: rgba(40, 30, 110, 1); height: 55px;">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true" style="color: #fff;">&times;</span>
                         </button>
                         <h3 class="modal-title" style="color: #fff;">Payroll Report</h3>
                     </div>
                     <div class="modal-body" style="text-align: center; background-color: rgba(230, 230, 230, 0.5);">
                         <h4>Payroll Report Available</h4>
                         <button id="approvePayrollreportac" type="button" class="btn btn-primary" style="margin: 0 10px;" autofocus>Approve</button>
                         <button id="viewPayrollreportac" type="button" class="btn btn-default" style="margin: 0 10px;" >View</button>
                     </div>
                     <div class="modal-footer" style="background-color: rgba(230, 230, 230, 0.7);">
                     </div>
                 </div>
             </div>
         </div>
      <div class="control-sidebar-bg"></div>
      </div>
      <div id="inputloansmodal" class="modal fade" data-backdrop="static">
      <div class="modal-dialog">
         <form id="loanform" method="post" enctype="multipart/form-data">
            <div class="modal-content" style="width: 700px;">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="exitModal">&times;</button>
                  <h4 class="modal-title"></h4>
               </div>
               <div class="modal-body">
                 <div class="row">
                   <div class="col-xs-5">
                     <label>Employee Id</label>
                     <input type="text" name="EmployeeId" id="empid" class="form-control" disabled />
                     <br />
                   </div>
                   <div class="col-xs-5">
                     <label>Name</label>
                     <input type="text" name="FirstName" id="nameid" class="form-control" disabled />
                     <br />
                   </div>
                   <div class="col-xs-5">
                     <label>Payroll Date</label>
                     <input type="date" class="form-control" name="payrolldate" id="payrolldateid" disabled />
                     <br />
                   </div>
                   <div class="col-xs-5">
                     <label>HDMF LOAN</label>
                     <input type="number" min="1" step="0.01" class="form-control" name="hdmfamount" id="hdmfamountid" value="0"/>
                     <br />
                   </div>
                   <div class="col-xs-5">
                     <label>SSS LOAN</label>
                     <input type="number" min="1" step="0.01" class="form-control" name="sssamount" id="sssamountid" value="0" />
                     <br />
                   </div>
                   <div class="col-xs-5">
                     <label>Other Deductions</label>
                     <input type="number" min="1" step="0.01" class="form-control" name="otheramount" id="otheramountid" value="0" />
                     <br />
                   </div>
                 </div>
                  <div class="modal-footer">
                     <div class="col-xs-12">
                        <input type="submit" name="action" id="btnupid" class="btn btn-primary" value="Insert" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
         </form>
         </div>
      </div>
      </div>
      <?php include '../includes/footer.php' ?>
      <script type="text/javascript" src="../assets/js/accemployeeinf.js"></script>
   </body>
</html>
