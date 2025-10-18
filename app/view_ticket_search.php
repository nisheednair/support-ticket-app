<?php
  include('check_session.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Result Search</title>
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
        VIEW TICKET
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">view </a></li>
        <li class="active">Ticket</li>
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
                    <h3 class="box-title">RESULT SEARCH </h3>
                    <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>TICKET NUMBER</th>
                          <th>PROJECT </th>
                          <th>TITLE </th>
                          <th>PROBLEM / ISSUE </th>
                          <th>OPEN BY </th>
                          <th>TSE </th>
                          <th>CREATED DATE</th>
                          <th>STATUS </th>
                          <th> </th>        
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          include('process_connect.php'); 
                          // receive on search 
                          $search = isset($_POST['ticket_search']) ? trim($_POST['ticket_search']) : '';
                          $sql = "SELECT * FROM tbl_ticket WHERE title LIKE '%$search%' OR problem_issue LIKE '%$search%'";
                          $result = mysqli_query($conn, $sql);
                        ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                          <tr onclick="window.location.href='detail_ticket.php?ticket_id=<?= $row['ticket_id']; ?>'" style="cursor: pointer;">
                            <td><?= $row['ticket_id']; ?></td>
                            <td><?= $row['project']  ?></td>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['problem_issue']; ?></td>
                            <td><?= $row['open_by']; ?></td>
                            <td><?= $row['task_by']; ?></td>
                            <td>
                              <?php 
                                $date =$row['created_date']; 
                                $dateTime = new DateTime($date);
                                $formattedDate = $dateTime->format('d/m/Y H:i:s');
                                echo $formattedDate;
                            ?>
                            </td>
                            <td>
                              <?php if ($row['piority'] == 'low'): ?>
                                <span class="label label-success">Low</span>
                              <?php elseif ($row['piority'] == 'medium'): ?>
                                <span class="label label-warning">Medium</span>
                              <?php elseif ($row['piority'] == 'closed'): ?>
                                <span class="label label-success">closed</span>
                              <?php else: ?>
                                <span class="label label-danger">Heigh</span>
                              <?php endif; ?>
                            </td>      
                             <!-- Checkbox -->
                            <td>
                              <form method="POST" action="delete_ticket.php" onsubmit="return confirm('You want to delete ticket?')">
                                    <input type="hidden" name="ticket_id" value="<?= $row['ticket_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>
                            </td>
                          </tr>
                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
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
