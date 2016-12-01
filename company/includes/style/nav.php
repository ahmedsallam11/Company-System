        <header class="header">
            <a href="index.php" class="logo">
                Company
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation" style="background:#283744;">
                <!-- Sidebar toggle button-->
                <?php if(Login::checkSession()){?>
               <div class="dropdown userInfo">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Hello <?php echo $_SESSION['username']; ?>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Edit Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </div><?php } ?> 
            </nav>
                </header>            