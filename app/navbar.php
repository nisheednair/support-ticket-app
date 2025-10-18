<!-- Logo -->
<a href="../../index2.html" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>T</b>SE</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>TICKET </b></span>
</a>
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <li class="dropdown messages-menu">
      </li>

      <!-- Messages: style can be found in dropdown.less-->
      <?php
      // Connect to database
      $servername = "127.0.0.1";
      $username = "db_tickets_user"; // Database username
      $password = "Mysql$123456789"; // Database password
      $dbname = "db_tickets"; // Your database name

      // Create a connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check the connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Pull data from the tbl_ticket table.
      $sql = "SELECT * FROM tbl_ticket WHERE piority = 'medium'"; // Example of retrieving data with status 'medium'
      $result = $conn->query($sql);

      // Check if the information is available
      if ($result->num_rows > 0) {
        $count = $result->num_rows;  // Count the number of retrieved data
        echo '<li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-bell-o"></i>
                          <span class="label label-warning">' . $count . '</span>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="header">Ticket status medium</li>
                          <li>
                            <ul class="menu">';

        // Loop display data
        while ($row = $result->fetch_assoc()) {
          $ticket_id = $row['ticket_id'];
          $title = $row['title']; // Suppose there is a description field.


          // Display data in list item format
          echo '<li>
                            <a href="#">
                              <i class="fa fa-warning text-yellow"></i> ' . $title . '
                            </a>
                          </li>';
        }

        echo '    </ul>
                          </li>
                          <li class="footer"><a href="view_ticket.php">View all</a></li>
                        </ul>
                      </li>';
      } else {
        //echo "No tickets found.";
        echo " ";
      }

      // Close database connection
      $conn->close();
      ?>
      <!-- Notifications: style can be found in dropdown.less -->


      <!-- Messages: style can be found in dropdown.less-->
      <?php
      // Connect to database
      $servername = "127.0.0.1";
      $username = "db_tickets_user"; // Database username
      $password = "Mysql$123456789"; // Database password
      $dbname = "db_tickets"; // Your database name

      // Create a connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check the connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Pull data from the tbl_ticket table.
      $sql = "SELECT * FROM tbl_ticket WHERE piority = 'heigh'"; // Example of retrieving data with status 'medium'
      $result = $conn->query($sql);

      // Check if the information is available
      if ($result->num_rows > 0) {
        $count = $result->num_rows;  // Count the number of retrieved data
        echo '<li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-flag-o"></i>
                          <span class="label label-danger">' . $count . '</span>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="header">Ticket status heigh</li>
                          <li>
                            <ul class="menu">';

        // Loop display data
        while ($row = $result->fetch_assoc()) {
          $ticket_id = $row['ticket_id'];
          $title = $row['title']; // Suppose there is a description field.


          // Display data in list item format
          echo '<li>
                            <a href="#">
                              <i class="fa fa-warning text-red"></i> ' . $title . '
                            </a>
                          </li>';
        }

        echo '    </ul>
                          </li>
                          <li class="footer"><a href="view_ticket.php">View all</a></li>
                        </ul>
                      </li>';
      } else {
        //echo "No tickets found.";
        echo " ";
      }

      // Close database connection
      $conn->close();
      ?>





      <!-- Notifications: style can be found in dropdown.less -->


      <!-- Tasks: style can be found in dropdown.less -->

      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

          <span class="hidden-xs">Role : <?php echo $_SESSION['role']; ?> </span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <p>
              User : <?php echo $_SESSION['username']; ?>
              <small>Member since <?php echo $_SESSION['created_date']; ?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#"></a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#"></a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#"></a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="detail_user.php" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="login.php" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>

</nav>