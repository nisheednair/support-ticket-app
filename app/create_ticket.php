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
  <?php include('loading.php'); ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
          <li class="active">Ticket</li>
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
                <h3 class="box-title">CREATE TICKET</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="process_ticket.php" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="project"> Project </label>
                        <input type="text" class="form-control" id="project" name="project" required>
                      </div>
                    </div>
                    <!-- Project -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <!-- Issue -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Problem / Issue </label>
                        <input type="text" class="form-control" id="issue" name="issue" required>
                      </div>
                    </div>
                    <!-- status -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="status"> piority </label>
                        <select class="form-control" id="piority" name="piority" required>
                          <option value="low"> low </option>
                          <option value="medium"> medium </option>
                          <option value="heigh"> heigh </option>
                          <option value="closed"> closed </option>
                        </select>

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <!-- open by -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="phone">open by</label>
                        <input type="text" class="form-control" id="openby" name="openby" required>
                      </div>
                    </div>
                    <!-- supported -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address">supported by</label>
                        <input type="text" class="form-control" id="supproted" name="supported" value="<?php echo $getUserName; ?>">
                        <!-- hidden and sent userId  input type="hidden" -->
                        <input type="hidden" name="userId" value="<?php $getUserId; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <!-- Upload File -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="attachment">Upload Attachment</label>
                        <input type="file" name="profile_image" accept="image/*">
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary"> Create ticket</button>
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