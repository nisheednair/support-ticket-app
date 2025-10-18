<?php
require 'process_connect.php'; // Your database connection file

if (isset($_POST['ticket_id'])) {
    $ticket_id = intval($_POST['ticket_id']);

    $sql = " 
       SELECT * 
    FROM tbl_ticket r
    LEFT JOIN tbl_responses u ON r.ticket_id = u.ticket_id
    LEFT JOIN tbl_user usr ON u.user_id = usr.user_id
    WHERE r.ticket_id = $ticket_id
    ";

    $result = mysqli_query($conn, $sql);

    $ticketInfo = null;
    $responses = [];

    while ($row = mysqli_fetch_assoc($result)) {
        if ($ticketInfo === null) {
            $ticketInfo = [
                'subject' => $row['title'],
                'description' => $row['problem_issue']
            ];
        }

        if (!empty($row['created_at'])) {
            $dateTime = new DateTime($row['created_at']);
            $profileImage = $row['profile_image'];
            $base64Image = $profileImage ? 'data:image/jpeg;base64,' . base64_encode($profileImage) : null;
            $responses[] = [
                'date' => $dateTime->format('d-m-Y'),
                'time' => $dateTime->format('H:i:s'),
                'action_by' => $row['email'],
                'profile_image' => $base64Image,
                'details' => $row['response_text'],
                'status' => $row['piority']

            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode([
        'ticket' => $ticketInfo,
        'timeline' => $responses
    ]);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No ticket ID provided']);
}
?>
