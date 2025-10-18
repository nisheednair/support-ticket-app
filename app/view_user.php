<?php
include('check_session.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ticket </title>
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
  <?php include('loading.php'); ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Loader -->
  <div id="loader"> <i class="fa fa-spinner fa-spin spinner"></i></div>

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
          VIEW USER

        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">view </a></li>
          <li class="active">User </li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Add row in content -->

        <!-- /Start .row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <!-- /.box-header -->

              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>USER ID</th>
                      <th>USERNAME</th>
                      <th>EMAIL</th>
                      <th>ROLE</th>
                      <th>PROFILE IMAGE</th>
                      <th>CREATED DATE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include('process_connect.php');
                    // ดึงข้อมูลจาก tbl_user
                    $sql = "SELECT * FROM tbl_user";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0):
                      while ($row = $result->fetch_assoc()):
                    ?>
                        <tr onclick="window.location.href='detail_user.php?user_id=<?= $row['user_id']; ?>'" style="cursor: pointer;">
                          <td><?= $row['user_id']; ?></td>
                          <td><?= $row['username']; ?></td>
                          <td><?= $row['email']; ?></td>
                          <td>
                            <?php if ($row['role'] == 'admin'): ?>
                              <span class="label label-danger">Admin</span>
                            <?php elseif ($row['role'] == 'manager'): ?>
                              <span class="label label-warning">Manager</span>
                            <?php else: ?>
                              <span class="label label-success">User</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if (!empty($row['profile_image'])): ?>
                              <img src="data:image/jpeg;base64,<?= base64_encode($row['profile_image']); ?>" alt="Profile" class="img-circle" width="40" height="40">
                            <?php else: ?>
                              <img src="../dist/img/default-profile.png" alt="Profile" class="img-circle" width="40" height="40">
                            <?php endif; ?>
                          </td>
                          <td><?php
                              $date = $row['created_at'];
                              $dateTime = new DateTime($date);
                              $formattedDate = $dateTime->format('d/m/Y H:i:s');
                              echo $formattedDate;
                              ?>
                          </td>
                        </tr>
                      <?php
                      endwhile;
                    else:
                      ?>
                      <tr>
                        <td colspan="6" class="text-center">No data available</td>
                      </tr>
                    <?php
                    endif;

                    $conn->close();
                    ?>
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


  <script>
    $(window).on("load", function() {
      $("#loader").fadeOut("slow"); // Gently hide the loader
    });
  </script>
</body>

</html>