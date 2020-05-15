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
         <li <?php if($_SESSION['currentPage'] == 'index'){echo 'class="active"';} ?>><a href="../home-ac/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
         <li <?php if($_SESSION['currentPage'] == 'acProfile' || $_SESSION['currentPage'] == 'editAcProfile' || $_SESSION['currentPage'] == 'aChangePassword'){echo 'class="active treeview menu-open"';} ?>>
            <a href="../profile-ac/">
            <i class="fa fa-user"></i> <span>Profile</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if($_SESSION['currentPage'] == 'acProfile'){echo 'class="active"';} ?>><a href="../profile-ac/"><i class="fa fa-desktop"></i> View</a></li>
               <li <?php if($_SESSION['currentPage'] == 'editAcProfile'){echo 'class="active"';} ?>><a href="../edit-ac/"><i class="fa fa-pencil-square-o"></i> Edit</a></li>
               <li <?php if($_SESSION['currentPage'] == 'aChangePassword'){echo 'class="active"';} ?>><a href="../passwordchange-ac/"><i class="fa fa-key"></i> Change Password</a></li>
            </ul>
         </li>
        <li <?php if($_SESSION['currentPage'] == 'loans'){echo 'class="active"';} ?>><a href="../loans/"><i class="fa fa-pencil-square"></i> Loans</a></li>  
         <li <?php if($_SESSION['currentPage'] == 'acpayslip'){echo 'class="active"';} ?>><a href="../mypayslip-ac/"><i class="fa fa-print"></i> <span>Payslip</span></a></li>
         <li <?php if($_SESSION['currentPage'] == 'viewDtr'){echo 'class="active"';} ?>><a href="../mydtr-ac/"><i class="fa fa-clock-o"></i> <span>DTR</span></a></li>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>
