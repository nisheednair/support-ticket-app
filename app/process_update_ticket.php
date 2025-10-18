<?php
  include('check_session.php'); 
  $getUserName = $_SESSION['username'];
  $getUserId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> TICKET </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header"> 
    <!-- Header Navbar: style can be found in header.less -->
    <?php 
      include('navbar.php');
    ?> 
  
    </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <!-- Sidebar-->
      <?php 
        include('sidebar.php');
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Result Create Ticket
        <small>  </small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Result Create  </a></li>
        <li class="active"> Ticket </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Add row in content -->
      
            <!-- /Start .row -->
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Result Create Ticket </h3>
                  </div>
                  <!-- /.box-header -->
                  <?php
                       include('process_connect.php'); 

                        // Get values ​​from a form
                        $ticket_id = $_POST['ticket_id'];
                        $project = $_POST['project'];
                          $title = $_POST['title'];
                        $problem = $_POST['issue'];
                        $piority = $_POST['piority'];
                         $openby = $_POST['openby'];
                      $supported = $_POST['supported'];
                       
                        // Upload image file
                        $target_dir = "uploads/"; // Folder for storing photos
                        if (!file_exists($target_dir)) {
                            mkdir($target_dir, 0777, true); // Create a folder if it doesn't already exist.
                        }

                       
                        // Upload image file
                        if ($_FILES['profile_image']['name']) {
                            $image = file_get_contents($_FILES['profile_image']['tmp_name']);
                           // echo $image;
                        } else {
                            $image = null;
                        }

                        // Insert data to database 
                       // $sql = "INSERT INTO tbl_ticket (project, title, problem_issue, piority, open_by, task_by, user_id, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                       $sql = "UPDATE tbl_ticket 
                          SET project = ?, 
                           title = ?, 
                           problem_issue = ?, 
                           piority = ?, 
                           open_by = ?, 
                           task_by = ?, 
                           user_id = ?
                       WHERE ticket_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssssss", $project, $title, $problem, $piority, $openby, $supported, $getUserId,$ticket_id);

                        if ($stmt->execute()) {
                        echo "สำเร็จ!";
                        echo "SUCCESS";
                        echo "<script> window.location.href = 'view_ticket.php'; </script>";
                        } else {
                        echo "เกิดข้อผิดพลาด: " . $conn->error;
                        }




                          if ($conn->query($sql) === TRUE) {
                            echo "SUCCESS";
                           // echo "<script> window.location.href = 'view_ticket.php'; </script>";
                          } else {
                            echo "Error: " . $conn->error;
                          }

                          // close connection database
                          $stmt->close();
                          $conn->close();

    
                        ?>




                  
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
            <!-- /End .row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
 <?php
    include('footer.php'); 
    include('leftbar.php'); 
 ?> 
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
