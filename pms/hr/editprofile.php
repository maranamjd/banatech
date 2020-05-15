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
$_SESSION['currentPage'] = 'editProfile';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Edit Profile</title>
      <link rel="stylesheet" href="../assets/css/image.css">
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
                  <small>Edit</small>
               </h1>
               <ol class="breadcrumb">
                 <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                 <li><a href="../profile-hr/">Profile</a></li>
                  <li class="active">Edit Profile</li>
               </ol>
               <br />
            </section>
            <!-- Main content -->
            <section class="content" style="overflow: none;">
              <?php include '../includes/confirmation.php'; ?>
              <?php include '../includes/alert.php'; ?>
               <!-- Default box -->
               <div class="box">
                  <div class="box-header with-border">
                     <h3 class="box-title">Edit Information</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                        <i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body" id="box-body">
                    <div class="container">
                      <div class="col-lg-offset-4 col-lg-3 col-md-4 col-sm-5 col-sm-offset-2">
                        <div class="hovereffect">
                          <img class="img-responsive" src="../assets/upload/<?php echo $_SESSION['image']; ?>" alt="">
                          <div class="overlay">
                            <h2>
                              <label class="custom-file-upload info" for="changeprofile">
                                <input type="file" name="image" id="changeprofile" >
                                <span class="fa fa-camera">
                                </label>
                              </h2>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-offset-3col-md-4 text-left">
                      <h3 class="text-center"><?php echo $_SESSION['Name']; ?></h3>
                      <p class="text-muted text-center"><?php echo $_SESSION['Position']; ?></p>
                    </div>

                     <div class="container">
                       <div class="row">
                         <div class="col-md-10">
                           <form id="changeProfile" method="post">
                             <div class="form-group col-md-6">
                               <label for="employeeId">Employee ID</label>
                               <input class="form-control" type="text" name="employeeID" id="employeeId" value="<?php echo $_SESSION['EmployeeId']; ?>" disabled>
                             </div>
                             <div class="form-group col-md-6">
                               <label for="firstname">First Name</label>
                               <input class="form-control" type="text" name="firstname" id="firstName" value="<?php echo $_SESSION['FirstName']; ?>"  pattern="^([ \u00c0-\u01ffa-zA-Z'\-])+$" >
                             </div>
                             <div class="form-group col-md-6">
                               <label for="middlename">Middle Name</label>
                               <input class="form-control" type="text" name="middlename" id="middleName" value="<?php echo $_SESSION['MiddleName']; ?>"  pattern="^([ \u00c0-\u01ffa-zA-Z'\-])+$" >
                             </div>
                             <div class="form-group col-md-6">
                               <label for="lastname">Last Name</label>
                               <input class="form-control" type="text" name="lastname" id="lastName" value="<?php echo $_SESSION['LastName']; ?>"  pattern="^([ \u00c0-\u01ffa-zA-Z'\-])+$" >
                             </div>
                             <div class="form-group col-md-6 employeeEmail">
                               <label for="email">Email Address</label>
                               <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION['Email']; ?>" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" spellcheck="false" title="me@something.com" >
                             </div>
                             <div class="modal-footer">
                                <div class="form-group col-md-offset-5 col-md-1"><br>
                                   <input class="btn btn-primary" id="btnSave" type="submit" name="" value="Save">
                                </div>
                             </div>
                         </form>
                         </div>
                       </div>
                     </div>
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
