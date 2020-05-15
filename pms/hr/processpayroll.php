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
$_SESSION['currentPage'] = 'processPayroll';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Process Payroll</title>
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
                  <small>Process</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Process Payroll</li>
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
                      <div id="payrollbtns">
                        
                      </div>

                          <div class="row">
                             <div id="employeeinfo" class="col-md-12">
                                <div class="table-responsive" style="overflow-x: hidden">
                                   <br />
                                   <br /><br />
                                   <table id="userpayroll" class="table table-hover table-condensed table-striped table-responsive">
                                      <thead>
                                         <tr>
                                            <th width=5%>Image</th>
                                            <th width=10%>Employee Id</th>
                                            <th width=55%>Name</th>
                                            <th width=10%>DTR</th>
                                            <th width=10%>Loans</th>
                                            <th width=10%>Payslip</th>
                                            <th width=10%>Process</th>
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
      <div id="payrollReport" class="modal fade">
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
                      <button id="sendPayrollreport" type="button" class="btn btn-primary" style="margin: 0 10px;" autofocus>Send</button>
                      <button id="viewPayrollreport" type="button" class="btn btn-default" style="margin: 0 10px;" >View</button>
                  </div>
                  <div class="modal-footer" style="background-color: rgba(230, 230, 230, 0.7);">
                  </div>
              </div>
          </div>
      </div>


      <div id="processModal" class="modal fade" data-backdrop="static">
      <div class="modal-dialog">
         <form method="post" id="processform" enctype="multipart/form-data">
            <div class="modal-content" style="width: 700px;">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="exitModal">&times;</button>
                  <h4 class="modal-title" id="addtitle">Payroll Summary</h4>
               </div>
               <div class="col-xs-12">
                 <br />
               </div>
               <div class="col-xs-10">
                 <table class="table table-condensed table-striped">
                   <tbody>
                     <tr>
                       <td>EMPLOYEE NAME</td>
                       <td id="name"></td>
                     </tr>
                     <tr>
                       <td>EMPLOYEE ID</td>
                       <td id="EmployeeId"></td>
                     </tr>
                     <tr>
                       <td>PAYOUT DATE</td>
                       <td id="payoutdate"></td>
                     </tr>
                     <tr>
                       <td>Basis of deductions and premium pay</td>
                       <td id="basis"></td>
                     </tr>
                     <tr>
                       <td>Monthly Rate</td>
                       <td id="monthly"></td>
                     </tr>
                     <tr>
                       <td>Daily Rate</td>
                       <td id="daily"></td>
                     </tr>
                     <tr>
                       <td>Hourly Rate</td>
                       <td id="hourly"></td>
                     </tr>
                     <tr>
                       <td>NET PAY</td>
                       <td id="netpay"></td>
                     </tr>
                   </tbody>
                 </table>
               </div>

                  <div class="col-xs-12">
                    <label for="">Taxable Income:</label>
                  </div>
                  <div class="col-xs-12">
                    <table class="table table-condensed table-striped">
                      <thead>
                        <th style="width: 70%">Description</th>
                        <th style="width: 30%">Amount</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Basic Pay</td>
                          <td class="value" id="basicpay"></td>
                        </tr>
                        <tr>
                          <td>Absences</td>
                          <td class="value" id="absences"></td>
                        </tr>
                        <tr>
                          <td>Tardiness</td>
                          <td class="value" id="tardiness"></td>
                        </tr>
                        <tr>
                          <td>Undertime</td>
                          <td class="value" id="undertime"></td>
                        </tr>
                        <tr>
                          <td>Adjustments</td>
                          <td class="value"  id="adjustments"></td>
                        </tr>
                        <tr>
                          <td>Gross Taxable Pay</td>
                          <td class="value" style="font-weight: bold;" id="grosstaxablepay"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    <div class="col-xs-12">
                      <label for="">Less:</label>
                    </div>
                    <div class="col-xs-12">
                      <table class="table table-condensed table-striped">
                        <thead>
                          <th style="width: 70%">Description</th>
                          <th style="width: 30%">Amount</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>SSS Contribution</td>
                            <td class="value" id="ssscontribution"></td>
                          </tr>
                          <tr>
                            <td>Philhealth Contribution</td>
                            <td class="value" id="philhealthcontribution"></td>
                          </tr>
                          <tr>
                            <td>HDMF Contribution</td>
                            <td class="value" id="hdmfcontribution"></td>
                          </tr>
                          <tr>
                            <td>Total Deductions Before Tax</td>
                            <td class="value" style="font-weight: bold;" id="totaldeductionsbeforetax"></td>
                          </tr>
                          <tr>
                            <td>Total Taxable Income</td>
                            <td class="value" style="font-weight: bold;" id="totaltaxableincome"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                      <div class="col-xs-12">
                        <label for="">Deductions:</label>
                      </div>
                      <div class="col-xs-12">
                        <table class="table table-condensed table-striped">
                          <thead>
                            <th style="width: 70%">Description</th>
                            <th style="width: 30%">Amount</th>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Withholding Tax</td>
                              <td class="value" id="withholdingtax"></td>
                            </tr>
                            <tr>
                              <td>HDMF Loan</td>
                              <td class="value" id="hdmfloan"></td>
                            </tr>
                            <tr>
                              <td>SSS Salary Loan</td>
                              <td class="value" id="sssloan"></td>
                            </tr>
                            <tr>
                              <td>Other Deductions</td>
                              <td class="value" id="otherdeductions"></td>
                            </tr>
                            <tr>
                              <td>Total Deductions</td>
                              <td class="value" style="font-weight: bold;" id="totaldeductions"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-xs-12">
                        <label for="">Add:</label>
                      </div>
                      <div class="col-xs-12">
                        <table class="table table-condensed table-striped">
                          <thead>
                            <th style="width: 70%">Description</th>
                            <th style="width: 30%">Amount</th>
                          </thead>
                          <tbody>
                            <tr>
                              <td>DE MINIMIS</td>
                              <td class="value" id="deminimis"></td>
                            </tr>
                            <tr>
                              <td>TRAVEL AND MEAL ALLOWANCE</td>
                              <td class="value" id="allowance"></td>
                            </tr>
                            <tr>
                              <td>INCENTIVES</td>
                              <td class="value" id="incentives"></td>
                            </tr>
                            <tr>
                              <td>Total</td>
                              <td class="value" style="font-weight: bold;" id="total"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                <div class="col-xs-12">
                  <hr />
                </div>

                  <div class="modal-footer">
                     <div class="col-xs-12">
                        <input type="hidden" name="bunit" id="bunitid">
                        <input type="submit" name="process" id="process" class="btn btn-primary" value="Process">
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
         </form>
         </div>
      </div>
    </div>
      <?php include '../includes/inloader.php'; ?>
      <?php include '../includes/footer.php'; ?>
      <script type="text/javascript" src="../assets/js/payrollDatatable.js"></script>
   </body>
</html>
