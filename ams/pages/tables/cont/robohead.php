<?php require('./robo_db_conn.php'); ?>

<?php
  if(!isset($_SESSION['ad_uname'])){
      header('Location:./login_admin.php');
  }

?>



<head>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BANATECH</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

  <link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Roboto|Source+Code+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Orbitron|Roboto|Source+Code+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit|Noto+Serif+JP|Orbitron|Poiret+One|Roboto|Source+Code+Pro" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../../assets/css/robo.css">
  <link rel="stylesheet" href="../../assets/css/headingss.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    

</head>



<body class="hold-transition skin-blue sidebar-mini">

<div class="container">
 
 <div id="add_emp" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title"><i class='fa fa-user-plus'></i> Employee</h4>
       </div>
       <div class="modal-body">
           <form method="post" id="insert_form" enctype='multipart/form-data'>
          
           <input type='file' id='emp_img' name='emp_img' style='display:none' />
        <input type='hidden' id='emp_img_id' name='emp_img_id'>
        <span id='btnimg' class='con'><i class='fa fa-image'></i><span id='caption_up'><small></small></span></span><br><br>

       <h class='con'><i class='fa fa-credit-card'></i></h>
         <input type='text' id='emp_id' name='emp_id' placeholder='Employee Id'><br><br>
        <h class='con'><i class='fa fa-user'></i></h> <br> <input type='text' id='fname' name='fname' placeholder='First Name' autofocus>
         <input type='text' id='mname' name='mname' placeholder='Middle Name'>
         <input type='text' id='lname' name='lname' placeholder='Last Name'><br>


            
    
     
     
       </div>
       <div class="modal-footer">

       
     
   
       <button type="submit" class='btn btn-default' name='insert' id='insert' onclick="return confirm('Are you sure?')" />Insert</button>
       </form> 
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>
     
   </div>
 </div>
 
</div>

<div id="edit_emp" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title"><i class='fa fa-edit'></i> Edit Employee</h4>
       </div>
       <div class="modal-body">
       <h class='con' style='float: right'><i class='fa fa-user'></i></h>
           <form method="post" id="update_form" enctype='multipart/form-data'>
           <input type='hidden' id='ed_emp_id' name='ed_emp_id' /><br>

    

        <table id='editt'> <tr>
          <td><th>First Name: </th></td>

          <td><input type='text' id='ed_fname' name='ed_fname' /><br></td>
        </tr>
        
        <tr>
        <td><th>Middle Name:</th></td> 
         <td><input type='text' id='ed_mname' name='ed_mname' /><br></td>
      </tr>

        <tr>
         <td><th>Last Name:</th></td>
        <td><input type='text' id='ed_lname' name='ed_lname' /></td>
        </tr>
      </table>
         
         <input type='hidden' id='id' name='id'>
   
       </div>
       <div class="modal-footer">
       <button type="submit" class='btn btn-default' name='update' id='update' class='upd' onclick="return confirm('Are you sure?')" />Update</button>
       </form> 
      
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>
     
   </div>
 </div>
 
</div>

<div id="edit_admin" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title"><i class='fa fa-edit'></i> Edit Admin</h4>
       </div>
       <div class="modal-body">
       <h class='con' style='float: right'><i class='fa fa-user'></i></h>
           <form method="post" id="update_admin" enctype='multipart/form-data'>

         

        <table id='editt'> <tr>

          <input type='hidden' id='ad_id' name='ad_id' />
          <td><th>Username: </th></td>

          <td><input type='text' id='ed_ad_uname' name='ed_ad_uname' /><br></td>
        </tr>
        
        <tr>
        <td><th>Email:</th></td> 
         <td><input type='text' id='ed_ad_email' name='ed_ad_email' /><br></td>
      </tr>
    

      </table>
         
      
   
       </div>
       <div class="modal-footer">
       <button type="submit" class='btn btn-default' name='update' id='update' class='upd' onclick="return confirm('Are you sure?')" />Update</button>
       </form> 
      
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>
     
   </div>
 </div>
 
</div>

<div id="edit_img" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Edit Image</h4>
       </div>
       <div class="modal-body">
       
           <form method="post" id="image_form" enctype='multipart/form-data'>

            <input type='file' id='ed_emp_img' name='ed_emp_img' style='display:none' />
        <input type='hidden' id='ed_emp_img_id' name='ed_emp_img_id'>
        <span id='ed_btnimg' class='con'><i class='fa fa-image'></i><span id='ed_caption_up'><small></small></span></span><br><br>
         
         <input type='hidden' id='changes_id' name='changes_id'>
   
       </div>
       <div class="modal-footer">
       <button type="submit" name='update_img' id='update_img' class='btn btn-default' onclick="return confirm('Are you sure?')" />Save</button>
       </form> 
      
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>
     
   </div>
 </div>
 
</div>

<div id="delete_emp" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         
         <h4 class="modal-title"><i class='fa fa-trash'></i> Delete Employee</h4>
       </div>
       <div class="modal-body">
           <form method="GET" id="delete_form" enctype='multipart/form-data'>
           <table id='dell'>
           
           <input type='hidden' id='del_emp_img_id' name='del_emp_img_id'>
           <tr><th>Employee Id:</th><td>
         
         <div id='del_emp_id' name='del_emp_id' class='hided'></div>
         </td></tr>
         
         <tr><th>First Name:</th><td>
        
         <div type='text' id='del_fname' name='del_fname' class='hided'></div>
         </td></tr>

           <tr><th>Middel Name:</th><td>
        
        <div type='text' id='del_mname' name='del_mname' class='hided'></div>
        </td></tr>
        
         <tr> <th>Last Name:</th><td>
             
         <div type='text' id='del_lname' name='del_lname' class='hided'></div>
         </td></tr>
         </table>
           
   
         <input type='hidden' id='del_id' name='del_id'>
         
   
       </div>
       <div class="modal-footer">
       <h class='con' style='float:left'><i class='fa fa-lock'> </i></h><input type='password' id='pass' name='pass_head' placeholder='Permission Password' style='float: left' class='passwording' required>
       <button type="submit" name='delete' id='delete' class='btn btn-default reddy' onclick="return confirm('Are you sure?')" />Delete</button>
       </form> 
         <button type="button" class="btn btn-default closer" data-dismiss="modal">Close</button>
       </div>
     </div>
     
   </div>
 </div>
 
</div>
 
</div>



<div class="wrapper">

  <header class="main-header">

    <a href="data.php" class="logo res">
   
      <span class="logo-mini res"><b>BCRS</b></span>
 
      <span class="logo-lg res2">BANATECH</span>
    </a>

    <nav class="navbar navbar-static-top">
     
      <a href="#" class="sidebar-toggle sidemin" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
 
        <li class="dropdown user user-menu">
            <a href="./login_admin.php?out" onclick='return confirm("Are you sure that you want to logout?")' class='outin'><i class='fa fa-sign-out'></i></a>

     
        
          </li>
    </ul>

      </div>
    </nav>
  </header>



  <aside class="main-sidebar">

    <section class="sidebar">
  
      <div class="user-panel">
        <div class="pull-left image">
          <img src="adm_def.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
  
          <a href="#" id='<?php echo $_SESSION['id']?>' class='edit-admin'><i class='fa fa-edit'></i>Profile</a>
      
          <a href="change_pass.php" id='<?php echo $_SESSION['']?>'><i class='fa fa-edit'></i>Password</a>
        </div>
      </div>

   

      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
          <li>
           <li><a href="data.php"><i class="fa fa-tachometer"></i> Time In & Out</a></li>
            <li><a href="employees.php"><i class="fa fa-user"></i> Employees </a></li>  
         
            <!-- <li><a href="head.php" data-toggle="modal" name="add" id="add"><i class='fa fa-user-plus'></i>Add Employee</a></li> -->
            <li><a href="add_employee.php"><i class="fa fa-plus-circle"></i> Add Employee </a></li>  
            <li><a href="deleted_emp.php"><i class="fa fa-recycle"></i> Deleted Employees </a></li>  
    </section>

  </aside> 
  

<?php
