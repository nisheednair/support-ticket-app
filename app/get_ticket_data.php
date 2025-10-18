<?php
include('process_connect.php');

// Pull data from the tbl_ticket table.
$sql = "SELECT DATE_FORMAT(created_date, '%Y-%m-%d') AS y
       , COUNT(ticket_id) AS item1 
        FROM tbl_ticket 
        GROUP BY DATE_FORMAT(created_date, '%Y-%m-%d')
        ORDER BY DATE_FORMAT(created_date, '%Y-%m-%d') ASC";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Export data as JSON
header('Content-Type: application/json');
echo json_encode($data);
