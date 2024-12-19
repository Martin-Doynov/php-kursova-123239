<?php
require_once('../db.php');

$response = [
    'success' => true,
    'data' => [],
    'error' => ''
];

$code = $_POST['code'] ?? '';

if (!empty($code)) {
    $query = "SELECT discount FROM promo_codes WHERE code = :code AND is_active = 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':code' => $code]);
    
    if ($promo = $stmt->fetch()) {
        $response['data']['discount'] = $promo['discount'];
    } else {
        $response['success'] = false;
        $response['error'] = 'Невалиден промо код.';
    }
}

echo json_encode($response);
exit;