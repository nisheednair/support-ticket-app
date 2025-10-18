<?php
include('check_session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Ticket </title>
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

  <?php include('loading.php'); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Loader -->
  <div id="loader">
    <i class="fa fa-spinner fa-spin spinner"></i>
  </div>

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

        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Create </a></li>
          <li class="active">User</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Add row in content -->

        <!-- /Start .row -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">CREATE USER</h3>

              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="process_user.php" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="username"> UserName </label>
                        <input type="text" class="form-control" id="username" name="username" required>
                      </div>
                    </div>
                    <!-- Project -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="username"> FirstName </label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                      </div>
                    </div>
                    <!-- Project -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">LastName</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- Issue -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">email </label>
                        <input type="text" class="form-control" id="email" name="email" required>
                      </div>
                    </div>
                    <!-- status -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="role"> role </label>
                        <select class="form-control" id="role" name="role" required>
                          <option value="user"> User </option>
                          <option value="admin"> Admin </option>
                          <option value="moderator"> Moderator </option>
                        </select>

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <!-- open by -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="profile_image">Profile image</label>
                        <input type="file" name="profile_image" accept="image/*">
                      </div>
                    </div>
                    <!-- supported -->

                  </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary"> Create User</button>
                </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
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
      $("#loader").fadeOut("slow"); //Gently hide the loader
    });
  </script>

</body>

</html>