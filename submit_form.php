<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $message = trim($_POST["message"] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        echo "Будь ласка, заповніть усі поля.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Некоректний формат email.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Форму успішно надіслано та збережено в базу даних.";
    } else {
        echo "Помилка при збереженні у базу даних.";
    }

    $stmt->close();
    $conn->close();
    exit;
}

echo "Неправильний запит.";
?>