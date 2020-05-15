<header class="main-header" style="position: fixed; width: 100%;">
   <!-- Logo -->
     <a href="#" class="logo" style="height: 55px">

       <span class="logo-mini"><img src="../assets/img/banate2.png" alt="" width='40px' height='22px'></span>
       <!-- logo for regular state and mobile devices -->
       <span class="logo-lg"><img src="../assets/img/banate2.png" class="image" width='100%' height='50px' /></span>
     </a>
   <!-- Header Navbar: style can be found in header.less -->
   <nav class="navbar navbar-static-top" style="height: 55px;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="height: 55px;">
      <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu" id="navbar-custom-menu">
         <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
               <a id="bell" href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <span class="fa fa-bell-o"></span><span class="badge label-danger" name="no" id="notifnum"></span>
               </a>
               <ul class="dropdown-menu" style="height: 40px;background-color: #241b75">
                  <!-- User image -->
                    <h4 class="menu-title text-center" style="color: #eee">Notifications</h4>
                  <div id="notification" class="list-group" style="overflow-y: scroll;height: 230px; background-color: #eee">
                    <p><img src="../assets/img/loading.gif" style="height: 100px; margin: 50px 80px;"></img></p>
                  </div>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
               </ul>
            </li>


            <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src="../assets/upload/<?php echo $_SESSION['image']; ?>" class="user-image" alt="User Image">
               <span class="hidden-xs"><?php echo $_SESSION['FirstName']; ?></span>
               </a>
               <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                     <img src="../assets/upload/<?php echo $_SESSION['image']; ?>" class="img-circle" alt="User Image">
                     <p>
                        <?php echo $_SESSION['Name']; ?> - <?php echo $_SESSION['Position']; ?>
                     </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                     <div class="pull-left">
                        <a href="../profile-hr/" class="btn btn-default btn-flat">Profile</a>
                     </div>
                     <div class="pull-right">
                        <a href="#" id="logoutbtn" class="btn btn-default btn-flat">Sign out</a>
                     </div>
                  </li>
               </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
         </ul>
      </div>
   </nav>
</header>
