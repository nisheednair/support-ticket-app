<?php
include('check_session.php');
?>
<?php
// Connect to the database (use MySQLi or PDO as you prefer).
$servername = "localhost";
$username = "db_tickets_user";
$password = "Mysql$123456789";
$dbname = "db_tickets";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve ticket number data by date
$sql = "SELECT ticket_id, created_date,title FROM tbl_ticket";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
  // Ticket information for display in the calendar
  while ($row = $result->fetch_assoc()) {
    $events[] = [
      'title' => 'Ticket #' . $row['ticket_id'] . $row['title'],
      'start' => $row['created_date'],
      'backgroundColor' => '#0073b7', // Event background color
      'borderColor' => '#0073b7', // Event border color
    ];
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> ticket </title>
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

  <!-- Morris charts -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php include('loading.php'); ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <!-- FullCalendar CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet">


  <!-- Moment.js (FullCalendar dependency) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <!-- FullCalendar JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    .timeline-user-image {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
      position: absolute;
      left: 10px;
      /* ✅ Move the image to the right, increasing from-20px */
      top: 0;
      animation: sway 2s ease-in-out infinite;
      z-index: 10;
      border: 2px solid white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }
  </style>



</head>

<body class="hold-transition skin-blue sidebar-mini">

  <!-- Add Loader -->
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
          TICKET
          <small> Yanbu National Hospital </small>
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






        <div class="row">


          <div class="col-md-6">

            <!-- BAR CHART -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">YNH TICKET</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body chart-responsive">
                <div class="chart" id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- /.box -->

          </div>
          <!-- /.col (LEFT) -->





          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title"> YNH ISSUE </h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body chart-responsive">
                <div class="chart" id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->



          </div>
          <!-- /.col (RIGHT) -->
        </div>











        <!-- /Start .row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>TICKET NUMER</th>
                      <th>PROJECT </th>
                      <th>TITLE </th>
                      <th>PROBLEM / ISSUE </th>
                      <th>OPEN BY </th>
                      <th>TSE </th>
                      <th>CREATED DATE</th>
                      <th>STATUS </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    include('process_connect.php');
                    $sql = "SELECT * FROM tbl_ticket WHERE piority NOT IN('closed')
                          ORDER BY FIELD(piority, 'heigh', 'medium', 'low');
                          ";
                    $result = mysqli_query($conn, $sql);
                    ?>


                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                      <!-- <tr onclick="window.location.href='detail_ticket.php?ticket_id=<?= $row['ticket_id']; ?>'" style="cursor: pointer;"> -->
                      <tr class="open-modal" data-ticket-id="<?= $row['ticket_id']; ?>">
                        <td>
                          <div class="timeline-item"><?= $row['ticket_id']; ?></div>
                        </td>
                        <td><?= $row['project']  ?></td>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['problem_issue']; ?></td>
                        <td><?= $row['open_by']; ?></td>
                        <td><?= $row['task_by']; ?></td>
                        <td>
                          <?php
                          $date = $row['created_date'];
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


        <!-- Display location -->
        <!-- Bootstrap Modal -->
        <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ticketModalLabel">Details - Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h4 id="ticketTitle"></h4>
                <p id="ticketDesc"></p>
                <ul class="timeline" id="ticketTimeline"></ul>
              </div>
            </div>
          </div>
        </div>













        <!-- DONUT CHART -->
        <!-- 
            <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"> YNH PENDING ISSUE</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
            </div>
            
          </div>
                              -->




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
  <!-- Morris.js charts -->
  <script src="../bower_components/raphael/raphael.min.js"></script>
  <script src="../bower_components/morris.js/morris.min.js"></script>
  <!-- FastClick -->
  <script src="../bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>

  <script>
    /*
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 19000},
        {y: '2011 Q2', item1: 2778},
        {y: '2011 Q3', item1: 4912},
        {y: '2011 Q4', item1: 3767},
        {y: '2012 Q1', item1: 6810},
        {y: '2012 Q2', item1: 5670},
        {y: '2012 Q3', item1: 4820},
        {y: '2012 Q4', item1: 15073},
        {y: '2013 Q1', item1: 10687},
        {y: '2013 Q2', item1: 8432}
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
    */
    //DONUT CHART
    /*
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a"],
      data: [
        {label: "Download Sales", value: 12},
        {label: "In-Store Sales", value: 30},
        {label: "Mail-Order Sales", value: 20}
      ],
      hideHover: 'auto'
    });
    */
    //BAR CHART
    /*
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: '2006', a: 100, b: 90},
        {y: '2007', a: 75, b: 65},
        {y: '2008', a: 50, b: 40},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });
    
    // });*/
  </script>

  <script>
    $(document).ready(function() {
      $.ajax({
        url: 'get_ticket_data.php', // Call a PHP file to fetch data
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          console.log(data); // Check the information in the console.
          new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: data,
            xkey: 'y', // Date column
            ykeys: ['item1'], // Number of tickets per month
            labels: ['Number of Tickets'], // Label name in the graph
            lineColors: ['#3c8dbc'], // Color of graph lines
            hideHover: 'auto'
          });
        },
        error: function(xhr, status, error) {
          console.error("Error loading data: ", error);
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      // Extract data from PHP
      $.ajax({
        url: 'get_ticket_data2.php', // PHP file for fetching data
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          // Display data in a Donut Chart
          new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: ["#3c8dbc", "#f56954", "#00a65a", "#f39c12", "#00c0ef"],
            data: data,
            hideHover: 'auto'
          });
        },
        error: function(xhr, status, error) {
          console.log("Error: " + error);
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $.ajax({
        url: 'get_ticket_data3.php', // Call PHP that fetches data
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          console.log(data);
          new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: data,
            barColors: ['#00a65a', '#f56954'],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Open', 'Closed'],
            hideHover: 'auto'
          });
        },
        error: function(error) {
          console.log("Error fetching data:", error);
        }
      });
    });
  </script>

  <script>
    $(window).on("load", function() {
      $("#loader").fadeOut("slow"); // Gently hide the loader
    });
  </script>




  <script>
    $(document).ready(function() {
      $('.open-modal').on('click', function() {
        var ticketId = $(this).data('ticket-id');
        console.log("print ticketid: " + ticketId);

        // Clear the original timeline first.
        $('#ticketTimeline').html(
          '<li><i class="fa fa-spinner fa-spin bg-blue"></i>' +
          '<div class="timeline-item"><h3 class="timeline-header">Loading...</h3></div></li>'
        );

        $.ajax({
          url: 'get_ticket_timeline.php',
          method: 'POST',
          data: {
            ticket_id: ticketId
          },
          dataType: 'json',
          success: function(response) {
            let timelineHTML = '';

            // Show ticket title and details
            $('#ticketTitle').text(response.ticket.subject);
            $('#ticketDesc').text(response.ticket.description);

            if (response.timeline.length > 0) {
              let currentDate = '';
              response.timeline.forEach(function(item) {
                if (item.date !== currentDate) {
                  currentDate = item.date;
                  timelineHTML += '<li class="time-label"><span class="bg-blue">' + item.date + '</span></li>';
                }

                timelineHTML += '<li>' +
                  '<img src="' + (item.profile_image || 'path/to/default/image.jpg') + '" alt="Profile Image" class="timeline-user-image">' +
                  '<div class="timeline-item">' +
                  '<span class="time"><i class="fa fa-clock-o"></i> ' + item.time + '</span>' +
                  '<h3 class="timeline-header">' + item.action_by + '</h3>' +
                  '<div class="timeline-body">' + item.details + '</div>' +
                  '<div class="timeline-footer">status: ' + item.status + '</div>' +
                  '</div>' +
                  '</li>';


              });

              timelineHTML += '<li><i class="fa fa-clock-o bg-gray"></i></li>';
            } else {
              timelineHTML = '<li><i class="fa fa-info bg-yellow"></i>' +
                '<div class="timeline-item"><h3 class="timeline-header">No information found yet - response</h3></div></li>';
            }

            $('#ticketTimeline').html(timelineHTML);
            $('#ticketModal').modal('show');
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.log("Response Text:", xhr.responseText);
            alert('An error occurred.: ' + error);
          }
        });
      });
    });
  </script>





</body>

</html>