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
$_SESSION['currentPage'] = 'uploadDtr';

  function get_date($time){
    if ($time == 'to') {
      return (date('d') > '15') ? date('Y-m-t') : date('Y-m-15');
    }else {
      return (date('d') > '15') ? date('Y-m-16') : date('Y-m-01');
    }
  }

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Payroll | Upload DTR</title>
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
   <body class="hold-transition skin-blue sidebar-mini" id="body">
      <div class="wrapper">

           <?php include '../includes/hr/header.php';?>
          <?php include '../includes/hr/sidenav.php';?>

         <div class="content-wrapper" style="margin-top: 50px">
            <section class="content-header">
               <h1>
                  Payroll
                  <small>Upload DTR</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="../home-hr/"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="../payroll/">Payroll</a></li>
                  <li class="active">Upload DTR</li>
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
                     <h3 class="box-title">Information</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                           title="Collapse">
                        <i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body" id="box-body">

                    <div class="row">
                      <div class="col-xs-6">
                        <div class="col-xs-6">
                          <label>Date From</label>
                          <input type="date" name="date_from" id="date_from" class="form-control" value="<?php echo get_date('from') ?>" disabled/>
                          <br />
                        </div>

                        <div class="col-xs-6">
                          <label>Date To</label>
                          <input type="date" name="date_to" id="date_to" class="form-control" value="<?php echo get_date('to') ?>" disabled/>
                          <br />
                        </div>
                      </div>
                    </div>

                    <div class="tab-content" id="tab-content">

                      <!-- tab content -->
                    </div>

                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
               </div>
               <!-- /.content-wrapper -->
         </div>
         <!-- /.content -->
         </section>
         <!-- ./wrapper -->
      </div>
      <div class="control-sidebar-bg"></div>
      </div>
      <?php include '../includes/inloader.php'; ?>
      <?php include '../includes/footer.php'; ?>
    <script type="text/javascript" src="../assets/js/fetchuploaddtr.js"></script>
   </body>
</html>
