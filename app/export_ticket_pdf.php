<?php
require_once('lib/tcpdf.php');


$pdf = new TCPDF();
$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();

// Connect to database
$conn = new mysqli("127.0.0.1", "db_tickets_user", "Mysql$123456789", "db_tickets");
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// Retrieve ticket information
$sql = "SELECT * FROM tbl_ticket";
$result = $conn->query($sql);

// Create HTML for PDF
$html = '<h2 style="text-align:center;">YNH Ticket</h2>';
$html .= '<table border="1" cellpadding="5">
<tr>
    <th width="10%">ID</th>
    <th width="20%">Project</th>
    <th width="30%">Title</th>
    <th width="20%">Piority</th>
    <th width="20%">Created Date</th>
</tr>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
        <td>' . $row['ticket_id'] . '</td>
        <td>' . $row['project'] . '</td>
        <td>' . htmlspecialchars($row['title']) . '</td>
        <td>' . $row['piority'] . '</td>
        <td>' . formatDateTimeDMY($row['created_date']) . '</td>

    </tr>';
}
$html .= '</table>';

// Insert HTML into PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Export to PDF
$pdf->Output('ticket_list.pdf', 'I'); // 'I' = Open in browser, 'D' = Download

$conn->close();
?>


<?php
function formatDateTimeDMY($dateStr)
{
    return date("d/m/Y H:i", strtotime($dateStr));
}
?>
