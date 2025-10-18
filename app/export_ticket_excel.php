<?php

$host = "127.0.0.1";
$username = "db_tickets_user";
$password = "Mysql$123456789";
$database = "db_tickets";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}


$filename = "ticket_export_" . date("Ymd_His") . ".xls";


header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");


$sql = "SELECT 
    t.*, 
    u.username AS username
FROM tbl_ticket t
LEFT JOIN tbl_user u ON t.user_id = u.user_id
";
$result = $conn->query($sql);


echo "<table border='1'>";
echo "<tr>
    <th>ticket_id</th>
    <th>piority</th>
    <th>project</th>
    <th>activity</th>
    <th>type</th>
    <th>status</th>
    <th>task_by</th>
    <th>open_by</th>
    <th>root_cause</th>
    <th>title</th>
    <th>solution</th>
    <th>created_date</th>
    <th>problem_issue</th>
    <th>user</th>
    <th>images</th>
    <th>closed_date</th>
</tr>";


while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['ticket_id'] . "</td>";
    echo "<td>" . $row['piority'] . "</td>";
    echo "<td>" . $row['project'] . "</td>";
    echo "<td>" . $row['activity'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>" . $row['task_by'] . "</td>";
    echo "<td>" . $row['open_by'] . "</td>";
    echo "<td>" . htmlspecialchars($row['root_cause']) . "</td>";
    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
    echo "<td>" . htmlspecialchars($row['solution']) . "</td>";
    echo "<td>" . $row['created_date'] . "</td>";
    echo "<td>" . htmlspecialchars($row['problem_issue']) . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['images'] . "</td>";
    echo "<td>" . $row['closed_date'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
