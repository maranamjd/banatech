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
$_SESSION['currentPage'] = 'bin';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Employee List</title>
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
                  Employee Information
                  <small>Bin</small>
               </h1>
               <ol class="breadcrumb">
                 <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                 <li><a href="../employees/">Employee Information</a></li>
                  <li class="active">Bin</li>
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
                     <h3 class="box-title">List</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                        <i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                     <div id="page wrapper">
                        <div id="page-inner">
                           <div class="row">
                              <div id="employeeinfo" class="col-md-12">
                                 <div class="table-responsive" style="overflow-x: hidden">
                                    <br />
                                    <br /><br />
                                    <table id="user_bin" class="table table-hover table-condensed table-striped" style="width: 100%;">
                                       <thead>
                                          <tr>
                                             <th width=5%>Image</th>
                                             <th width=10%>Employee Id</th>
                                             <th width=75%>Name</th>
                                             <th width=10%>Action</th>
                                          </tr>
                                       </thead>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <hr />
                        </div>
                        <!-- /. PAGE INNER  -->
                     </div>
                     <!-- /. PAGE WRAPPER  -->
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
      <div id="userModal" class="modal fade" data-backdrop="static">
      <div class="modal-dialog">
         <form method="post" id="user_bin_form" enctype="multipart/form-data">
            <div class="modal-content" style="width: 700px;">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="exitModal">&times;</button>
                  <h4 class="modal-title" id="addtitle">Employee Details</h4>
               </div>
               <div class="modal-body">
                  <div class="col-xs-6">
                     <label>Employee Id</label>
                     <input type="text" name="EmployeeId" id="EmployeeId" class="form-control" disabled />
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>First Name</label>
                     <input type="text" name="FirstName" id="FirstName" class="form-control" disabled />
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>Middle Name</label>
                     <input type="text" name="MiddleName" id="MiddleName" class="form-control" disabled />
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>Last Name</label>
                     <input type="text" name="LastName" id="LastName" class="form-control" disabled />
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>Email Address</label>
                     <input type="email" name="Email" id="Email" class="form-control" disabled/>
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>Business Unit</label>
                     <select type="text" name="BusinessUnitID" id="BusinessUnitID" class="form-control" disabled >
                        <option></option>
                        <option>ASC CEBU</option>
                        <option>ASC MNL</option>
                        <option>ATS CEBU</option>
                        <option>ATS MNL</option>
                        <option>DBT</option>
                        <option>DPP</option>
                        <option>KRYTERION</option>
                        <option>LUNDGREENS</option>
                        <option>SRT</option>
                        <option>SUPPORT</option>
                     </select>
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>UserType</label>
                     <select type="text" class="form-control" name="Usertype" id="Usertype" disabled >
                        <option></option>
                        <option>Admin-HR</option>
                        <option>Admin-Accounting</option>
                        <option>User-Employee</option>
                     </select>
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>Position</label>
                     <input type="text" name="Position" id="Position" class="form-control" disabled />
                     <br />
                  </div>
                  <div class="col-xs-6">
                     <label>Basic Pay</label>
                     &#8369;<input type="number" min="1" step="0.01" name="BasicPay" id="BasicPay" class="form-control" disabled />
                     <br />
                  </div>
                  <div class="modal-footer">
                     <div class="col-xs-12">
                        <input type="hidden" name="user_id" id="user_id" />
                        <input type="hidden" name="operation" id="operation" />
                        <input type="submit" name="action" id="activate" class="btn btn-primary" value="Activate" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
         </form>
         </div>
      </div>
    </div>
      <?php include '../includes/footer.php'; ?>
      <script type="text/javascript" src="../assets/js/BinDatatable.js"></script>
   </body>
</html>
