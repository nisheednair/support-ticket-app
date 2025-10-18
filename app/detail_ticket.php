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

  <!-- CK Editor -->
  <script src="../bower_components/ckeditor/ckeditor.js"></script>

  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


</head>

<style>
  .gallery img {
    width: 150px;
    height: 150px;
    border-radius: 15px;
    border: 2px solid #ccc;
    cursor: pointer;
  }
</style>

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

      <?php
      include('process_connect.php');
      // Get ticket_id from URL
      $ticket_id = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;

      if ($ticket_id > 0) {
        $sql = "SELECT * FROM tbl_ticket t
                          INNER JOIN tbl_user u 
                          ON t.user_id = u.user_id
                          WHERE ticket_id = $ticket_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
          $ticket_id = $row['ticket_id'];
          $project = $row['project'];
          $title   = $row['title'];
          $problem_issue = $row['problem_issue'];
          $piority = $row['piority'];
          $open_by = $row['open_by'];
          $task_by = $row['task_by'];
          $created_date = $row['created_date'];
          $username_tse = $row['username'];
          if ($row['profile_image'] !== null) {
            $profile_img = base64_encode($row['profile_image']);
          } else {
            $profile_img = '';
          }
          $issue_image =  base64_encode($row['image']);
        } else {
          $notfound = "not found Ticket ID ";
        }
      } else {
        $notfound_return = "not return Ticket ID ";
      }

      $conn->close();
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
          VIEW DETAIL TICKET
          <small> </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">view detail</a></li>
          <li class="active">Ticket</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Add row in content -->

        <!-- /Start .row -->
        <div class="row">
          <div class="col-md-9">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">

                      <img class="img-circle img-bordered-sm" src="data:image/jpeg;base64,<?= $profile_img; ?>" alt="user image">

                      <span class="username">
                        <a href="#">
                          Issue Title : <?php echo $title; ?>
                          <br>
                          TSE by : <?php echo $username_tse;  ?></a>
                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                      </span>
                      <span class="description">created date - <?php echo $created_date; ?> </span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      <?php
                      echo $problem_issue;
                      ?>
                    </p>
                    <p>
                      <!-- Clickable images-->
                      <img src="data:image/jpeg;base64,<?= $issue_image; ?>" alt="issue" class="img-rounded" width="150" height="150" style="border-radius: 15px; border: 2px solid #ccc;" data-lightbox="image-gallery">

                      <!-- Modal for displaying enlarged images -->
                    <div id="imageModal" style="display:none; position: fixed; top: 0; left: 0; width: 90%; height: 90%; background-color: rgba(0, 0, 0, 0.8); text-align: center; padding-top: 50px;">
                      <div style="position: relative; display: inline-block;">
                        <img id="expandedImage" src="" style="max-width: 90%; max-height: 90%;" onclick="closeModal()">
                        <div style="position: absolute; top: 10px; left: 10px; background-color: rgba(0, 0, 0, 0.6); color: white; padding: 5px 10px; font-size: 16px; border-radius: 5px;">
                          Zoom
                        </div>
                      </div>
                    </div>

                    </p>
                    <ul class="list-inline">
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                      </li>
                      <li class="pull-right">


                      </li>
                    </ul>
                  </div>
                  <!-- /.post -->
                  <!-- post -->
                  <?php
                  // connect database 
                  $servername = "127.0.0.1";
                  $username_db = "db_tickets_user";
                  $password_db = "Mysql$123456789";
                  $dbname = "db_tickets";
                  $conn = new mysqli($servername, $username_db, $password_db, $dbname);
                  if ($conn->connect_error) {
                    die("Connection Error: " . $conn->connect_error);
                  }

                  $ticket_id = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;
                  ?>
                  <?php

                  $sql_responses = "
                            select  * from tbl_responses r 
                            left join tbl_user u 
                            on 
                            r.user_id = u.user_id 
                            where 
                            r.ticket_id = $ticket_id 
                            order by r.id asc
                          ";
                  $result_responses = mysqli_query($conn, $sql_responses);

                  if (mysqli_num_rows($result_responses) > 0) {
                    while ($response = mysqli_fetch_assoc($result_responses)) {
                      $response_text  = $response['response_text'];
                      $created_at     = $response['created_at'];
                      $res_name       = $response['username'];
                      $res_img        = $response['profile_image'];
                      $img_data       = $response['img_data'];
                      $base64Image = base64_encode($img_data);

                  ?>

                      <!-- Post Responses -->
                      <div class="post">
                        <div class="user-block">
                          <img src="data:image/jpeg;base64,<?= base64_encode($res_img); ?>" alt="Profile" class="img-circle" width="40" height="40">
                          <span class="username">
                            <a href="#">Response by : <?php echo $res_name; ?> </a>
                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                          </span>
                          <span class="description">Created at :: <?php echo $created_at; ?> </span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          <?php echo $response_text; ?>
                        </p>
                        <p>
                          <a href="data:image/jpeg;base64,<?= $base64Image; ?>" data-fancybox="gallery" data-title="ภาพ 3">
                            <img src="data:image/jpeg;base64,<?= $base64Image; ?>" alt="issue" class="img-rounded" width="150" height="150" style="border-radius: 15px; border: 2px solid #ccc;">
                          </a>
                        </p>
                        <ul class="list-inline">
                          <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                          <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
                        </ul>
                      </div>
                      <!-- /.post -->

                  <?php
                    }
                  }

                  $conn->close();
                  ?>



                  <!-- post -->



                  <!-- Post -->

                  <div class="post clearfix">
                    <div class="user-block">
                      <img src="data:image/jpeg;base64,<?= base64_encode($img); ?>" alt="Profile" class="img-circle" width="40" height="40">
                      <span class="username">
                        <a href="#">Reply by :<?php echo $getUserName; ?></a>
                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                      </span>
                      <span class="description"><?php echo $created_date; ?></span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      Reply ticket
                    </p>

                    <form class="form-horizontal" method="POST" action="process_response.php" enctype="multipart/form-data">
                      <div class="form-group margin-bottom-none">
                        <div class="col-sm-12">
                          <textarea class="form-control input-sm" id="response" name="response" placeholder="Response"></textarea>
                        </div>
                        <div class="col-sm-3">
                          <br>
                          <input type="hidden" name="ticket_id" value="<?= $ticket_id; ?>">
                          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                          <label for="imageInput">add image:</label>
                          <input type="file" id="imageInput" name="image" class="form-control" accept="image/*" required />
                          <br>
                          <button type="submit" class="btn btn-primary pull-right btn-block btn-sm">Reply Issue</button>
                        </div>
                      </div>
                    </form>
                  </div>


                  <script>
                    CKEDITOR.replace('response', {
                      height: 150,
                      toolbar: [{
                          name: 'document',
                          items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print']
                        },
                        {
                          name: 'clipboard',
                          items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo']
                        },
                        {
                          name: 'basicstyles',
                          items: ['Bold', 'Italic', 'Underline', 'Strike']
                        },
                        {
                          name: 'paragraph',
                          items: ['NumberedList', 'BulletedList', '-', 'Blockquote']
                        },
                        {
                          name: 'insert',
                          items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
                        },
                        {
                          name: 'styles',
                          items: ['Format', 'Font', 'FontSize']
                        },
                        {
                          name: 'colors',
                          items: ['TextColor', 'BGColor']
                        },
                        {
                          name: 'tools',
                          items: ['Maximize', 'ShowBlocks']
                        }
                      ],

                      removePlugins: 'image',

                    });
                  </script>
                  <!-- /.post -->

                  <!-- Post -->

                  <!-- /.post -->
                </div>
                <!-- /.tab-pane -->

                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
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
    function expandImage(img) {
      var modal = document.getElementById("imageModal");
      var expandedImg = document.getElementById("expandedImage");
      expandedImg.src = img.src;
      modal.style.display = "block";
    }

    function closeModal() {
      document.getElementById("imageModal").style.display = "none";
    }
  </script>


  <script>
    $(window).on("load", function() {
      $("#loader").fadeOut("slow"); // Gently hide the loader
    });
  </script>

  <script src="ckeditor/ckeditor.js"></script>

  <script>
    $(document).ready(function() {
      $("[data-fancybox]").fancybox();
    });
  </script>

</body>

</html>