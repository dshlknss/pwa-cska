<?php
// Параметры подключения для OpenServer
$host = '127.0.0.1'; // Используем IP вместо localhost
$user = 'root';     // Стандартный пользователь
$pass = '';         // Пустой пароль в OpenServer
$db   = 'cska_db';  // Название базы данных

// Подключение с обработкой ошибок
try {
    // Сначала подключаемся без выбора базы
    $conn = new mysqli($host, $user, $pass);
    
    // Проверяем соединение
    if ($conn->connect_error) {
        throw new Exception("Ошибка подключения к серверу MySQL: " . $conn->connect_error);
    }
    
    // Создаем базу данных, если её нет
    $conn->query("CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    
    // Теперь подключаемся к конкретной базе
    $conn->select_db($db);
    
    // Создаём таблицу, если её нет
    $conn->query("CREATE TABLE IF NOT EXISTS feedback (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    
    // Для проверки (можно удалить после тестирования)
    echo "<!-- База данных и таблица успешно созданы -->";
    
} catch (Exception $e) {
    die("Ошибка: " . $e->getMessage());
}
?>