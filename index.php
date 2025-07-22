<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>ЦСКА - Отзывы</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        textarea { width: 100%; height: 100px; padding: 10px; }
        input { padding: 10px; width: 300px; }
        button { background: #1a3b8b; color: white; border: none; padding: 10px 20px; }
        .feedback-item { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>ХК ЦСКА Москва - Отзывы болельщиков</h1>
    
    <div class="feedback-form">
        <h2>Оставить отзыв</h2>
        <form action="save.php" method="POST">
            <div class="form-group">
                <input type="text" name="name" placeholder="Ваше имя" required>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Ваш отзыв..." required></textarea>
            </div>
            <button type="submit">Отправить отзыв</button>
        </form>
    </div>

    <div class="feedback-list">
        <h2>Последние отзывы</h2>
        <?php
        $result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
        while ($row = $result->fetch_assoc()):
        ?>
        <div class="feedback-item">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            <small><?= $row['created_at'] ?></small>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>