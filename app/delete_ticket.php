<?php
include('process_connect.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ticket_id'])) {
        $ticket_id = intval($_POST['ticket_id']);

        $sql = "DELETE FROM tbl_ticket WHERE ticket_id = $ticket_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Delete Sucess'); window.location.href='view_ticket.php';</script>";
        } else {
            echo "<script>alert('Error can't delete ticket'); window.location.href='view_ticket.php';</script>";
        }
    }
}

$conn->close();

?>