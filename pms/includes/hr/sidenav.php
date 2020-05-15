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
                  <li <?php if($_SESSION['currentPage'] == 'index'){echo 'class="active"';} ?>><a href="../home-hr/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                  <li <?php if($_SESSION['currentPage'] == 'profile' || $_SESSION['currentPage'] == 'editProfile' || $_SESSION['currentPage'] == 'changePassword'){echo 'class="active treeview menu-open"';} ?>>
                     <a href="../profile-hr/">
                     <i class="fa fa-user"></i> <span>Profile</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li <?php if($_SESSION['currentPage'] == 'profile'){echo 'class="active"';} ?>><a href="../profile-hr/"><i class="fa fa-desktop"></i> View</a></li>
                        <li <?php if($_SESSION['currentPage'] == 'editProfile'){echo 'class="active"';} ?>><a href="../edit-hr/"><i class="fa fa-pencil-square-o"></i> Edit</a></li>
                        <li <?php if($_SESSION['currentPage'] == 'changePassword'){echo 'class="active"';} ?>><a href="../passwordchange-hr/"><i class="fa fa-key"></i> Change Password</a></li>
                     </ul>
                  </li>
                  <li <?php if($_SESSION['currentPage'] == 'employeeInfo' || $_SESSION['currentPage'] == 'addEmployee'|| $_SESSION['currentPage'] == 'bin' || $_SESSION['currentPage'] == 'upload'){echo 'class="active treeview menu-open"';} ?>>
                  <a href="../employees/">
                  <i class="fa fa-info"></i> <span>Employees</span>
                     <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                  </a>
                  <ul class="treeview-menu">
                   <li <?php if($_SESSION['currentPage'] == 'employeeInfo'){echo 'class="active"';} ?>><a href="../employees/"><i class="fa fa-desktop"></i> View</a></li>
                   <li <?php if($_SESSION['currentPage'] == 'addEmployee'){echo 'class="active"';} ?>><a href="../newemployee/"><i class="fa fa-plus"></i> Add</a></li>
                   <li <?php if($_SESSION['currentPage'] == 'upload'){echo 'class="active"';} ?>><a href="../employee-upload/"><i class="fa fa fa-file-o"></i> Upload</a></li>
                   <li <?php if($_SESSION['currentPage'] == 'bin'){echo 'class="active"';} ?>><a href="../inactiveemployees/"><i class="fa fa fa-trash-o"></i> Bin</a></li>
                  </ul>
                  </li>
                  <li <?php if($_SESSION['currentPage'] == 'processPayroll' || $_SESSION['currentPage'] == 'uploadDtr' || $_SESSION['currentPage'] == 'sendPayslip'){echo 'class="active treeview menu-open"';} ?>>
                    <a href="../payroll/">
                    <i class="fa fa-pencil-square"></i> <span>Payroll</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                       <li <?php if($_SESSION['currentPage'] == 'processPayroll'){echo 'class="active"';} ?>><a href="../payroll/"><i class="fa fa-pencil-square-o"></i> Process</a></li>
                       <li <?php if($_SESSION['currentPage'] == 'uploadDtr'){echo 'class="active"';} ?>><a href="../dtr/"><i class="fa fa-file"></i> Process DTR</a></li>
                       <li <?php if($_SESSION['currentPage'] == 'sendPayslip'){echo 'class="active"';} ?>><a href="../payslip/"><i class="fa fa-list-alt"></i> View Payslips</a></li>
                    </ul>
                  </li>
                  <li <?php if($_SESSION['currentPage'] == 'hrpayslip'){echo 'class="active"';} ?>><a href="../mypayslip-hr/"><i class="fa fa-print"></i> <span>Payslip</span></a></li>
                  <li <?php if($_SESSION['currentPage'] == 'viewDtr'){echo 'class="active"';} ?>><a href="../mydtr-hr/"><i class="fa fa-clock-o"></i> <span>DTR</span></a></li>

               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
