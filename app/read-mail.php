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
                <h3 class="box-title">Read Mail</h3>
              </div>





              <?php
              function decodeMimeStr($string, $charset = 'UTF-8')
              {
                $elements = imap_mime_header_decode($string);
                $decoded = '';
                foreach ($elements as $element) {
                  $fromCharset = $element->charset;
                  $text = $element->text;
                  if ($fromCharset != 'default') {
                    $decoded .= iconv($fromCharset, $charset, $text);
                  } else {
                    $decoded .= $text;
                  }
                }
                return $decoded;
              }

              //Use recursive function for multipart
              function getPart($imap, $uid, $part, $partNum)
              {
                $charset = 'UTF-8';
                $encoding = $part->encoding;
                $body = imap_fetchbody($imap, $uid, $partNum);

                // Find the charset value if it exists.
                if (isset($part->parameters)) {
                  foreach ($part->parameters as $param) {
                    if (strtolower($param->attribute) === 'charset') {
                      $charset = $param->value;
                    }
                  }
                }

                // Decode by encoding
                switch ($encoding) {
                  case 3: // BASE64
                    $body = base64_decode($body);
                    break;
                  case 4: // QUOTED-PRINTABLE
                    $body = quoted_printable_decode($body);
                    break;
                }

                // Convert charset
                if (strtolower($charset) !== 'utf-8') {
                  $body = @iconv($charset, 'UTF-8//IGNORE', $body);
                }

                return $body;
              }

              function getMessageBody($imap, $uid)
              {
                $structure = imap_fetchstructure($imap, $uid);

                if (!$structure) return '';

                if (!isset($structure->parts)) {
                  // ไม่ใช่ multipart
                  return getPart($imap, $uid, $structure, 1);
                }

                // If it's multipart, look for both plain and html.
                $message = '';
                foreach ($structure->parts as $index => $part) {
                  $partNum = $index + 1;
                  $mimeType = $part->subtype ?? '';

                  if (strtolower($mimeType) == 'plain') {
                    $message = getPart($imap, $uid, $part, $partNum);
                    break; // If you encounter plain text first, use this.
                  } elseif (strtolower($mimeType) == 'html') {
                    $message = getPart($imap, $uid, $part, $partNum);
                    // Not yet broken, waiting to check if there is no plain first.
                  }
                }

                return $message;
              }

              // --------Start reading emails --------
              $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

              if (!$id) {
                die('❌ กรุณาระบุ ID ของอีเมล เช่น mail.php?id=59');
              }


              include('process_connect.php');
              $checkUser = $_SESSION['user_id'];
              $sql = "SELECT * FROM tbl_email WHERE user_id ='$checkUser' "; // or WHERE username = '...' as appropriate
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $mailbox = $row['mailbox'];
                $username = $row['username'];
                $password = $row['password'];
              }



              $inbox = imap_open($mailbox, $username, $password) or die('❌ Unable to connect to Mail Server: ' . imap_last_error());

              $check = imap_fetch_overview($inbox, $id, 0);
              if (!$check) {
                die("❌ This email ID was not found.");
              }

              $overview = $check[0];
              $subject = decodeMimeStr($overview->subject);
              $from = decodeMimeStr($overview->from);
              $date = $overview->date;

              // ✅ Extract content (either plain or html)
              $message = getMessageBody($inbox, $id);

              // -------- แสดงผล --------
              echo "<strong>subject:</strong> " . htmlspecialchars($subject) . "<br>";
              echo "<strong>from:</strong> " . htmlspecialchars($from) . "<br>";
              echo "<strong>date:</strong> " . htmlspecialchars($date) . "<br>";
              echo "<hr><strong>content:</strong><br>";

              // If you want to be safe, use htmlspecialchars.
              // echo "<pre>" . htmlspecialchars($message) . "</pre>";

              // Or show real html
              echo $message;

              imap_close($inbox);
              ?>





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