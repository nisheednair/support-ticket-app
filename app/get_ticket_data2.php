<?php
include('process_connect.php'); 

// Retrieve data based on desired conditions, such as counting the number of tickets separated by status.
$sql = "SELECT piority, COUNT(*) as total FROM tbl_ticket GROUP BY piority";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'label' => $row['piority'],
            'value' => $row['total']
        );
    }
}

$conn->close();

// Export data as JSON
echo json_encode($data);
