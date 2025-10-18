<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ticket</title>
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
        ระบบเพิ่มข้อมูลรถ
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">กรุณากรอกข้อมูลรถ</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="process-car.php">
              <div class="box-body">
                  <div class="row">
                      <!-- Car seller code -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="user">Car seller code</label>
                              <input type="text" class="form-control" id="seller_id" name="seller_id" required>
                          </div>
                      </div>
                      <!-- Car brand -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="password">Car brand</label>
                              <input type="text" class="form-control" id="brand" name="brand" required>
                          </div>
                      </div>
                      
                  </div>
          
                  <div class="row">
                      <!-- Car model-->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="name">Car model</label>
                              <input type="text" class="form-control" id="model" name="model" required>
                          </div>
                      </div>
                      <!-- Year of manufacture-->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="email">Year of manufacture</label>
                              <input type="text" class="form-control" id="year" name="year" required>
                          </div>
                      </div>
                  </div>
          
                  <div class="row">
                      <!-- ราคา -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="phone">price</label>
                              <input type="text" class="form-control" id="price" name="price" required>
                          </div>
                      </div>
                      <!-- Mileage used -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="address">Mileage used</label>
                              <input type="text" class="form-control" id="mileleage" name="mileage" required>
                          </div>
                      </div>
                  </div>
          
                  <div class="row">
                      <!-- Vehicle fuel type -->
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="fuel_type">Vehicle fuel type</label>
                            <select class="form-control" id="fuel_type" name="fuel_type" required>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Electric">Electric</option>
                            </select>
                          </div>
                      </div>
                      <!-- Car gear system -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="gear">Car gear system</label>
                              <select class="form-control" id="transmisson" name="transmisson" required>
                                <option value="Manual">Manual</option>
                                <option value="Automatic">Automatic</option>
                            </select>
                          </div>
                      </div>
                  </div>
          
                  <div class="row">
                      <!-- Engine size-->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="engine">Engine size</label>
                              <input type="text" class="form-control" id="engine_size" name="engine_size" required>
                          </div>
                      </div>
                      <!-- Color of the car -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="color">Color of the car</label>
                              <input type="text" class="form-control" id="color" name="color" required>
                          </div>
                      </div>
                  </div>
          
                  <div class="row">
                      <!-- Vehicle details -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="description">Vehicle details</label>
                              <input type="text" class="form-control" id="description" name="description" required>
                          </div>
                      </div>
                      <!-- Vehicle status -->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="status">Vehicle status</label>
                              <select class="form-control" id="status" name="status" required>
                                <option value="available">available</option>
                                <option value="sold">sold</option>
                            </select>
                          </div>
                      </div>
                  </div>
              
             
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add vehicle information</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
          <!-- Form Element sizes -->
          <!-- /.box -->
          <!-- /.box -->
          <!-- Input addon -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
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
