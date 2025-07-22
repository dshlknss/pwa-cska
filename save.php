<?php
require 'config.php';

// Получаем данные из формы
$name = $conn->real_escape_string($_POST['name']);
$message = $conn->real_escape_string($_POST['message']);

// Создаём таблицу, если её нет
$conn->query("CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Сохраняем отзыв
$conn->query("INSERT INTO feedback (name, message) VALUES ('$name', '$message')");

// Возвращаем на главную
header('Location: index.php');
?>