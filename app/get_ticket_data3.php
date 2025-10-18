<?php
include('process_connect.php');

// Pull data from a table
$sql = "
SELECT DATE_FORMAT(created_date, '%m/%Y') AS month_year, 
       COUNT(CASE WHEN piority IN ('medium','low','heigh') THEN 1 END) AS open_count,
       COUNT(CASE WHEN piority = 'closed' THEN 1 END) AS closed_count
FROM tbl_ticket
GROUP BY DATE_FORMAT(created_date, '%m/%Y');
";
//ORDER BY DATE_FORMAT(created_date, '%Y-%m');
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'y' => $row['month_year'],
            'a' => (int) $row['open_count'], // Example for status = Open
            'b' => (int) $row['closed_count'] // Example for status = Closed
        ];
    }
}

$conn->close();

// Export data as JSON
header('Content-Type: application/json');
echo json_encode($data);
