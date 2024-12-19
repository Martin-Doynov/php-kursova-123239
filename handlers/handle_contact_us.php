<?php
require_once('../functions.php');
require_once('../db.php');

$message = $_POST['message'] ?? '';
$datetime = date('Y-m-d H:i:s');

if (isset($_SESSION['user_id'])) {
    $person_id = $_SESSION['user_id'];
    $email = $_SESSION['user_email'];
    $name = $_SESSION['user_name'];
} else {
    $person_id = null;
    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
}

// Validate inputs
if (empty(trim($message)) || 
    (!isset($_SESSION['user_id']) && (empty(trim($name)) || empty(trim($email))))) {
    $_SESSION['flash']['message']['type'] = 'error';
    $_SESSION['flash']['message']['text'] = "Моля попълнете всички полета!";
    header('Location: ../index.php?page=contacts');
    exit;
}

// Insert into database
$query = "INSERT INTO contact_us (person_id, email, datetime, text) VALUES (:person_id, :email, :datetime, :text)";
$stmt = $pdo->prepare($query);
$params = [
    ':person_id' => $person_id,
    ':email' => $email,
    ':datetime' => $datetime,
    ':text' => $message
];

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'success';
    $_SESSION['flash']['message']['text'] = "Съобщението беше изпратено успешно!";
    header('Location: ../index.php?page=contacts');
    exit;
} else {
    $_SESSION['flash']['message']['type'] = 'error';
    $_SESSION['flash']['message']['text'] = "Възникна грешка при изпращането на съобщението!";
    header('Location: ../index.php?page=contacts');
    exit;
}
?>