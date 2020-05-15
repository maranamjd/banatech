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
$_SESSION['currentPage'] = 'addEmployee';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Add Employee</title>
      <?php include '../includes/header.php'; ?>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

           <?php include '../includes/hr/header.php';?>
          <?php include '../includes/hr/sidenav.php';?>

         <div class="content-wrapper" style="margin-top: 50px">
            <section class="content-header">
               <h1>
                  Employee Information
                  <small>Add</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="../employees/">Employee Information</a></li>
                  <li class="active">Add Employee</li>
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
                     <h3 class="box-title">Add Employee</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                        <i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                     <!-- /.box-header -->
                     <!-- form start -->
                     <form method="post" id="user_form" enctype="multipart/form-data">
                        <div class="box-body">
                           <div class="col-xs-6" id="employeeID">
                              <label>Employee Id</label>
                              <input type="text" name="EmployeeId" id="EmployeeId" class="form-control" title="XXXX-X-XXX" />
                              <br />
                           </div>
                           <div class="col-xs-6">
                              <label>First Name</label>
                              <input type="text" name="FirstName" id="FirstName" class="form-control" pattern="^([ \u00c0-\u01ffa-zA-Z'\-])+$" />
                              <br />
                           </div>
                           <div class="col-xs-6">
                              <label>Middle Name</label>
                              <input type="text" name="MiddleName" id="MiddleName" class="form-control" pattern="^([ \u00c0-\u01ffa-zA-Z'\-])+$"  />
                              <br />
                           </div>
                           <div class="col-xs-6">
                              <label>Last Name</label>
                              <input type="text" name="LastName" id="LastName" class="form-control" pattern="^([ \u00c0-\u01ffa-zA-Z'\-])+$"  />
                              <br />
                           </div>
                           <div class="col-xs-6" id="employeeEmail">
                              <label>Email Address</label>
                              <input type="email" name="Email" id="Email" class="form-control" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" spellcheck="false"/>
                              <br />
                           </div>
                           <div class="col-xs-6">
                             <label>Position</label>
                             <input type="text" name="Position" id="Position" class="form-control" />
                             <br />
                           </div>
                           <div class="col-xs-6">
                              <label>UserType</label>
                              <select type="text" class="form-control" name="Usertype" id="Usertype" >
                                 <option></option>
                                 <option>Admin-HR</option>
                                 <option>Admin-Accounting</option>
                                 <option>User-Employee</option>
                              </select>
                              <br />
                           </div>
                           <div class="col-xs-12">
                             <label for="">Reporting Time:</label>
                           </div>
                           <div class="col-xs-6">
                             <div class="col-xs-6">
                               <label for="schedin">Time In</label>
                               <input type="time" name="timein" class="form-control" id="rtimein" value="08:00">
                             </div>
                             <div class="col-xs-6">
                               <label for="schedin">Time Out</label>
                               <input type="time" name="timeout" class="form-control" id="rtimeout" value="17:00">
                             </div>
                           </div>
                           <div class="col-xs-12"><br>
                             <label for="">Additionals:</label>
                           </div>
                           <div class="col-xs-8">
                             <div class="col-xs-4">
                               <label for="schedin">De Minimis</label>
                               <input type="number" min="0" step="0.01" name="deminimis" id="deminimis" class="form-control" value="0">
                             </div>
                             <div class="col-xs-4">
                               <label for="schedin">Food & Travel Allowance</label>
                               <input type="number" min="0" step="0.01" name="ftallowance" id="ftallowance" class="form-control" value="0" >
                             </div>
                             <div class="col-xs-4">
                               <label for="schedin">Incentives</label>
                               <input type="number" min="0" step="0.01" name="incentives" id="incentives" class="form-control" value="0" >
                             </div>
                           </div>
                           <div class="col-xs-12"><br>
                             <div class="col-xs-3">
                               <label>Monthly Salary</label>
                               &#8369;<input type="number" min="0" step="0.01" name="BasicPay" id="BasicPay" class="form-control" value="0" />
                             </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <div class="col-xs-15">
                              <input type="submit" name="action" id="btnAdd" class="btn btn-primary" value="Add" />
                              <button type="button" class="btn btn-default">Cancel</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!--     <script src="assets/js/bootstrap.js"></script> -->
               <!--     <script src="assets/js/lenguajeusuario.js"></script>     -->
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
