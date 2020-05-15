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
$_SESSION['currentPage'] = 'employeeInfo';
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

               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Employee Information</li>
               </ol>
               <br />
            </section>
            <!-- Main content -->
            <section class="content">
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
                     <div class="container-fluid">
                           <div class="row">
                              <div id="employeeinfo" class="col-md-12">
                                 <div class="table-responsive" style="overflow-x: hidden">
                                    <br />
                                    <br /><br />
                                    <table id="user_data" class="table table-hover table-condensed table-striped table-responsive">
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
         <form method="post" id="user_form" enctype="multipart/form-data">
            <div class="modal-content" style="width: 700px;">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="exitModal">&times;</button>
                  <h4 class="modal-title" id="addtitle">Add User</h4>
               </div>
               <div class="modal-body">
                  <div class="col-xs-6">
                     <label>Employee Id</label>
                     <input type="text" name="EmployeeId" id="EmployeeId" class="form-control" pattern="^([0-9]{4}-[0-9]{1}-[0-9]{3})$" title="XXXX-X-XXX" />
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
                     <input type="email" name="Email" id="Email" class="form-control" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" spellcheck="false"  disabled/>
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
                      <input type="time" name="timein" class="form-control" id="rtimein">
                    </div>
                    <div class="col-xs-6">
                      <label for="schedin">Time Out</label>
                      <input type="time" name="timeout" class="form-control" id="rtimeout">
                    </div>
                  </div>
                  <div class="col-xs-12"><br>
                    <label for="">Additionals:</label>
                  </div>
                  <div class="col-xs-12">
                    <div class="col-xs-4">
                      <label for="schedin">De Minimis</label>
                      <input type="number" min="1" step="0.01" name="deminimis" id="deminimis" class="form-control" >
                    </div>
                    <div class="col-xs-4">
                      <label for="schedin">Food & Travel Allowance</label>
                      <input type="number" min="1" step="0.01" name="ftallowance" id="ftallowance" class="form-control" >
                    </div>
                    <div class="col-xs-4">
                      <label for="schedin">Incentives</label>
                      <input type="number" min="1" step="0.01" name="incentives" id="incentives" class="form-control" >
                    </div>
                  </div>
                  <div class="col-xs-6"><br>
                     <label>Basic Pay</label>
                     &#8369;<input type="number" min="1" step="0.01" name="BasicPay" id="BasicPay" class="form-control" />
                     <br />
                  </div>
                  <div class="modal-footer">
                     <div class="col-xs-12">
                        <input type="submit" name="action" id="update" class="btn btn-primary" value="Update">
                        <input type="hidden" name="id" id="hiddenid">
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
         </form>
         </div>
      </div>
    </div>
      <?php include '../includes/footer.php'; ?>
      <script type="text/javascript" src="../assets/js/employeeInfDatatable.js"></script>
   </body>
</html>
