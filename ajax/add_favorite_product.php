<?php
require_once('../db.php');

$response = [
    'success' => true,
    'data' => [],
    'error' => ''
];

$ticket_id = intval($_POST['ticket_id'] ?? 0);
$promo_code = $_POST['promo_code'] ?? '';

if ($ticket_id <= 0) {
    $response['success'] = false;
    $response['error'] = 'Невалиден билет.';
} else {
    $user_id = $_SESSION['user_id'];
    
    // взема цена на билет
    $ticket_query = "SELECT price FROM tickets WHERE id = :ticket_id";
    $ticket_stmt = $pdo->prepare($ticket_query);
    $ticket_stmt->execute([':ticket_id' => $ticket_id]);
    $ticket = $ticket_stmt->fetch();
    
    $final_price = $ticket['price'];
    $promo_id = null;

    // прилага промо окд ако съществува
    if (!empty($promo_code)) {
        $promo_query = "SELECT id, discount FROM promo_codes WHERE code = :code";
        $promo_stmt = $pdo->prepare($promo_query);
        $promo_stmt->execute([':code' => $promo_code]);
        if ($promo = $promo_stmt->fetch()) {
            $final_price = $final_price * (1 - $promo['discount']/100);
            $promo_id = $promo['id'];
        }
    }

    $query = "INSERT INTO purchased_tickets (user_id, ticket_id, original_price, final_price, promo_code_id) 
              VALUES (:user_id, :ticket_id, :original_price, :final_price, :promo_id)";
    $stmt = $pdo->prepare($query);
    $params = [
        ':user_id' => $user_id,
        ':ticket_id' => $ticket_id,
        ':original_price' => $ticket['price'],
        ':final_price' => $final_price,
        ':promo_id' => $promo_id
    ];

    if (!$stmt->execute($params)) {
        $response['success'] = false;
        $response['error'] = 'Грешка при закупуване на билета.';
    }
}

echo json_encode($response);
exit;