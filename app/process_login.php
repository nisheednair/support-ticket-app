<?php
// connect database 
$servername = "127.0.0.1";
$username_db = "db_tickets_user";
$password_db = "Mysql$123456789";
$dbname = "db_tickets";
//$port = 3307;
echo "check server " . $servername . "<br>";
echo "check user database " . $username_db;


$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

$user = isset($_POST["user"]) ? $_POST["user"] : "";
$pass = isset($_POST["password"]) ? $_POST["password"] : "";


// SQL for select data table (username)
$sql = "SELECT * FROM tbl_user WHERE username = '$user'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    //$hash = $row["password"];
    //$passcheck = hash('md5', $pass);
    //$passcheck1 = password_hash($pass, PASSWORD_DEFAULT);
    //$passcheck2 = password_hash($pass, PASSWORD_BCRYPT);
    // check password with password_verify()
    //echo (password_verify($pass, $row['password']));
    if (password_verify($pass, $row['password'])) {
        //if (password_verify($pass, $passcheck)) {
        // If the password is correct (Login successful)
        session_start();
        $_SESSION['user_id']  = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role']     = $row['role'];
        $_SESSION['email']    = $row['email'];
        $_SESSION['created_date'] = $row['created_at'];
        echo "<br>  log in  pass ";
        // redirect dashboard
        header("Location: view_dashboard.php");
        exit();
    } else {
        // if password not correct
        echo "Password Not Correct ";
        header("Location: login.php");
    }
} else {
    // if username not found in table
    echo "Not found user";
}

// closed connection
mysqli_close($conn);
