<?php
include('check_session.php');
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
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <?php include('loading.php'); ?>
</head>
<!-- fullCalendar -->
<link rel="stylesheet" href="../bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="../bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
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
          Ticket<small>Preview</small>
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
                <h3 class="box-title">Preview Calendar Ticket </h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <?php
              $servername = "127.0.0.1";
              $username = "mysql";
              $password = "Mysql$123";
              $dbname = "db_ticket";

              // create connection to database
              $conn = new mysqli($servername, $username, $password, $dbname);

              // check connection 
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT ticket_id, created_date,title FROM tbl_ticket WHERE piority not in ('closed')";
              $result = $conn->query($sql);

              $events = [];
              if ($result->num_rows > 0) {
                // data ticket for calendar
                while ($row = $result->fetch_assoc()) {
                  $events[] = [
                    'ticket_id' => $row['ticket_id'],
                    'title' => 'Ticket #' . $row['ticket_id'] . $row['title'],
                    'start' => $row['created_date'],
                    'backgroundColor' => '#0073b7', // background event
                    'borderColor' => '#0073b7', // color event
                  ];
                }
              }

              $conn->close();
              ?>
              <div class="box-body">

                <!-- Calendar -->
                <div id="calendar"></div>

                <!-- Form update ticket -->
                <div class="modal" id="eventModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Update Ticket Close</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="eventForm" method="post" action="process_update_ticket_closed.php">
                          <input type="hidden" id="eventId" name="eventId">
                          <div class="form-group">
                            <label for="eventTitle">Title</label>
                            <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
                          </div>
                          <div class="form-group">
                            <label for="eventEnd">End date </label>
                            <input type="datetime-local" class="form-control" id="eventEnd" name="end_date">
                          </div>
                          <div class="form-group">
                            <label for="eventBorderColor">Root case</label>
                            <textarea type="text" class="form-control" id="root_cause" name="root_cause" size="3"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="eventBorderColor">Solution</label>
                            <textarea type="text" class="form-control" id="solution" name="solution" size="3"></textarea>
                            <input type="hidden" class="form-control" id="ticket_id" name="ticket_id">
                          </div>
                          <div class="form-group">
                            <label for="piority"> select to closed </label>
                            <select class="form-control" id="piority" name="piority">
                              <option value="low">Low</option>
                              <option value="medium">Medium</option>
                              <option value="closed">Closed</option>
                              <option value="high">High</option>
                            </select>
                          </div>
                          <button type="submit" class="btn btn-primary">update to closed</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
            <!-- /.box-body -->


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
  <!-- jQuery 3 -->
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Slimscroll -->
  <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- fullCalendar -->
  <script src="../bower_components/moment/moment.js"></script>
  <script src="../bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
  <!-- Page specific script -->


  <script>
    $(function() {
      // fetch ticket number PHP Use for FullCalendar
      var events = <?php echo json_encode($events); ?>; // send data PHP to JavaScript

      // FullCalendar Initialization
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month'
        },
        buttonText: {
          today: 'today',
          month: 'month',
          week: 'week',
          day: 'day'
        },
        events: events,
        editable: true,
        droppable: true,
        // when click event
        eventClick: function(event) {
          // show detail to form
          $('#eventTitle').val(event.title);
          $('#eventStart').val(event.start.format('YYYY-MM-DD HH:mm:ss')); // time to calendar
          $('#eventEnd').val(event.end ? event.end.format('YYYY-MM-DD HH:mm:ss') : ''); // time to form
          $('#eventDescription').val(event.description || ''); // description to event
          // data event id hidden field
          $('#eventId').val(event.id);
          $('#ticket_id').val(event.ticket_id);

          // open modal
          $('#eventModal').modal('show');
        }
      });
    });
  </script>

  <script>
    $(window).on("load", function() {
      $("#loader").fadeOut("slow"); // Gently hide the loader
    });
  </script>
</body>

</html>