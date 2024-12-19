<?php
require_once('../db.php');

$response = [
    'success' => true,
    'data' => [],
    'error' => ''
];

$ticket_id = intval($_POST['ticket_id'] ?? 0);

if ($ticket_id <= 0) {
    $response['success'] = false;
    $response['error'] = 'Невалиден билет.';
} else {
    $user_id = $_SESSION['user_id'];

    $query = "DELETE FROM purchased_tickets WHERE user_id = :user_id AND ticket_id = :ticket_id";
    $stmt = $pdo->prepare($query);
    $params = [
        ':user_id' => $user_id,
        ':ticket_id' => $ticket_id
    ];

    if (!$stmt->execute($params)) {
        $response['success'] = false;
        $response['error'] = 'Грешка при отказ от билета.';
    }
}

echo json_encode($response);
exit;