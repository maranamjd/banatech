<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="position: fixed;">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar" style="margin-top:10px">
      <!-- Sidebar user panel -->
      <div class="user-panel" id="user-panel">
        <div class="pull-left image">
           <img src="../assets/upload/<?php echo $_SESSION['image']; ?>" class="img-circle" alt="User Image">
        </div>
         <div class="pull-left info">
            <p><?php echo $_SESSION['LastName'].',<br>'.$_SESSION['FirstName'].' '.ucfirst($_SESSION['MiddleName']{0}).'.'; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree" style="margin-top: 10px;">
         <li class="header">NAVIGATION</li>
         <li <?php if($_SESSION['currentPage'] == 'index'){echo 'class="active"';} ?>><a href="../home/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
         <li <?php if($_SESSION['currentPage'] == 'employeeProfile' || $_SESSION['currentPage'] == 'eEditProfile' || $_SESSION['currentPage'] == 'eChangePassword'){echo 'class="active treeview menu-open"';} ?>>
            <a href="../profile/">
            <i class="fa fa-user"></i> <span>Profile</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if($_SESSION['currentPage'] == 'employeeProfile'){echo 'class="active"';} ?>><a href="../profile/"><i class="fa fa-desktop"></i> View</a></li>
               <li <?php if($_SESSION['currentPage'] == 'eEditProfile'){echo 'class="active"';} ?>><a href="../edit/"><i class="fa fa-pencil-square-o"></i> Edit</a></li>
               <li <?php if($_SESSION['currentPage'] == 'eChangePassword'){echo 'class="active"';} ?>><a href="../passwordchange/"><i class="fa fa-key"></i> Change Password</a></li>
            </ul>
         </li>
         <li <?php if($_SESSION['currentPage'] == 'employeeSlip'){echo 'class="active"';} ?>><a href="../mypayslip/"><i class="fa fa-print"></i> <span>Payslip</span></a></li>
         <li <?php if($_SESSION['currentPage'] == 'viewDtr'){echo 'class="active"';} ?>><a href="../mydtr/"><i class="fa fa-clock-o"></i> <span>DTR</span></a></li>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>
