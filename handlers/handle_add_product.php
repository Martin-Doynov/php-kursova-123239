<?php
require_once('../functions.php');
require_once('../db.php');

if (!is_admin()) {
    $_SESSION['flash']['message']['type'] = 'warning';
    $_SESSION['flash']['message']['text'] = "Нямате достъп до тази страница!";
    header('Location: ../index.php?page=home');
    exit;
}

$start_destination = $_POST['start_destination'] ?? '';
$arrival_destination = $_POST['arrival_destination'] ?? '';
$start_time = $_POST['start_time'] ?? '';
$arrival_time = $_POST['arrival_time'] ?? '';
$price = floatval($_POST['price'] ?? 0);

if (empty($start_destination) || empty($arrival_destination) || 
    empty($start_time) || empty($arrival_time) || $price <= 0) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = "Моля попълнете всички полета!";
    header('Location: ../index.php?page=add_product');
    exit;
}

$query = "INSERT INTO tickets (start_destination, arrival_destination, start_time, arrival_time, price) 
          VALUES (:start_destination, :arrival_destination, :start_time, :arrival_time, :price)";
$stmt = $pdo->prepare($query);
$params = [
    ':start_destination' => $start_destination,
    ':arrival_destination' => $arrival_destination,
    ':start_time' => $start_time,
    ':arrival_time' => $arrival_time,
    ':price' => $price
];

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'success';
    $_SESSION['flash']['message']['text'] = "Полетът беше добавен успешно!";
    header('Location: ../index.php?page=products');
} else {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = "Възникна грешка при добавянето на полета!";
    header('Location: ../index.php?page=add_product');
}
exit;
?>