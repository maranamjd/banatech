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
$_SESSION['currentPage'] = 'upload';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Upload</title>
      <?php include '../includes/header.php'; ?>
      <style media="screen">
        .panel img{
          border-radius: 5px;
          padding: 1px 1px;
          border: 1px solid #ccc;
          height: 45px;
          width: 45px;
        }
        input[type="file"] {
            display: none;
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
        #show{
          color: #777;
        }
      </style>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

           <?php include '../includes/hr/header.php';?>
          <?php include '../includes/hr/sidenav.php';?>

         <div class="content-wrapper" style="margin-top: 50px">
            <section class="content-header">
               <h1>
                  Employees
                  <small>Upload</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="../employees/">Employees</a></li>
                  <li class="active">Upload</li>
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
                    <button id="downloadtemplate" class="btn btn-success btn-sm pull-right"type="button" name="button"><i class="fa fa-download"></i>  Download Template File</button>
                    <label for="uploadfile">Input Excel File</label><br>
                    <label class="custom-file-upload btn-lg btn-primary">
                      <input type="file" name="uploadfile" id="uploadfile" >
                      <span class="fa fa-file-o">
                    </label>

                    <div class="row" id="res" style="display: none">
                      <div class="col-xs-8">
                        <label for="inserted">Rows Inserted: </label>
                        <p id="inserted"></p>
                      </div>
                      <div class="col-xs-8">
                        <label for="blank">Rows with blank column: </label>
                        <p id="blank"></p>
                      </div>
                      <div class="col-xs-8">
                        <label for="err">Rows with data error/data duplicate on database: </label>
                        <p id="err"></p>
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
      <!-- /.content-wrapper -->
      <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->

      <?php include '../includes/footer.php'; ?>
   </body>
</html>
