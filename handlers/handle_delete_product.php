<?php
require_once('../functions.php');
require_once('../db.php');

if (!is_admin()) {
    $_SESSION['flash']['message']['type'] = 'warning';
    $_SESSION['flash']['message']['text'] = "Нямате достъп до тази страница!";
    header('Location: ../index.php?page=home');
    exit;
}

$id = intval($_POST['id'] ?? 0);

try {
    $pdo->beginTransaction();

    // First delete purchased tickets
    $delete_purchases = "DELETE FROM purchased_tickets WHERE ticket_id = :ticket_id";
    $stmt = $pdo->prepare($delete_purchases);
    $stmt->execute([':ticket_id' => $id]);

    // Then delete the ticket
    $delete_ticket = "DELETE FROM tickets WHERE id = :id";
    $stmt = $pdo->prepare($delete_ticket);
    $stmt->execute([':id' => $id]);

    $pdo->commit();

    $_SESSION['flash']['message']['type'] = 'success';
    $_SESSION['flash']['message']['text'] = "Полетът беше изтрит успешно!";
} catch (PDOException $e) {
    $pdo->rollBack();
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = "Грешка при изтриване на полета!";
}

header('Location: ../index.php?page=products');
exit;