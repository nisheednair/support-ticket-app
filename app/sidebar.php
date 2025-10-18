  
 <!-- Sidebar user panel -->
 <?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  //$_SESSION can be used normally.
?>
 <div class="user-panel">
        <div class="pull-left image">
        <?php
              // Connect to database
              include('process_connect.php'); 
              $user_id =  $_SESSION['user_id']; // Example username
              // Plain SQL commands (not recommended if the input comes directly from the user, as they are vulnerable to SQL Injection)
              $sql = "SELECT * FROM tbl_user WHERE user_id = '$user_id'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  // Retrieve data in associative array format
                  while ($row = $result->fetch_assoc()) {
                     // echo "User ID: " . $row["user_id"] . "<br>";
                     // echo "Username: " . $row["username"] . "<br>";
                     // echo "Email: " . $row["email"] . "<br>";
                     $img = $row['profile_image']; 
                     $role_db = $row['role']; 
                  }
              } else {
                  //echo "No data found";
              }
              // Close connection
              $conn->close();
         ?>

        <img src="data:image/jpeg;base64,<?= base64_encode($img); ?>" alt="Profile" class="img-circle" width="40" height="40">
       
        </div>
        <div class="pull-left info">
          <?php  $getUserName = $_SESSION['username']; ?>
          <p>Login : <?php echo $getUserName;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
        <!-- search form -->
        <form method="post" class="sidebar-form" action="view_ticket_search.php">
        <div class="input-group">
          <input type="text" name="ticket_search" class="form-control" placeholder="Search ticket...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="view_dashboard.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
           
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Ticket</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="create_ticket.php"><i class="fa fa-circle-o"></i> Create New Ticket</a></li>
            <li><a href="view_ticket_in_progress.php"><i class="fa fa-circle-o"></i> View Ticket in Progress</a></li>
            <li><a href="manage_ticket.php" onclick="return checkRole();"><i class="fa fa-circle-o"></i> Manage Ticket</a></li>
            <li><a href="view_calendar.php" onclick="return checkRole();"><i class="fa fa-circle-o"></i> Change to Closed Ticket</a></li>
          </ul>
        </li>


       
        
        <?php if (!isset($_SESSION['role']) || $_SESSION['role'] == 'admin') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Manage User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="view_user.php"><i class="fa fa-circle-o"></i> View User</a></li>
              <li><a href="create_user.php"><i class="fa fa-circle-o"></i> Create User</a></li>
            </ul>
          </li>
          <li class="treeview">
          <a href="#">
            <i class="fa  fa-file-text"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="view_ticket_closed.php"><i class="fa fa-circle-o"></i> Ticket Close</a></li>
            <li><a href="export_ticket_excel.php"><i class="fa fa-circle-o"></i> Export excel </a></li>
            <li><a href="export_ticket_pdf.php"><i class="fa fa-circle-o"></i> Export pdf </a></li>
          </ul>
        </li>
        
        <?php } ?>
      
      </ul>

      <script>
      function checkRole() {
        var role = "<?php echo $_SESSION['role']; ?>"; // Must have echo
        console.log("check role: " + role);
        if (role !== "admin") {
            alert("Allow only Role Admin");
            return false; // Prevent linking
        }
        return true;
      }
    </script>

