<?php
// Простейшая защита
if ($_GET['pass'] !== 'cska2025') die('Доступ запрещён!');

require 'config.php';

// Удаление отзыва
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM feedback WHERE id = $id");
    echo "Отзыв удалён!<br><br>";
}

// Выводим все отзывы
$result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
while ($row = $result->fetch_assoc()):
?>
<div style="border:1px solid #ccc; padding:10px; margin:10px;">
    <strong><?= $row['name'] ?></strong><br>
    <?= nl2br($row['message']) ?><br>
    <small><?= $row['created_at'] ?></small><br>
    <a href="moderate.php?delete=<?= $row['id'] ?>&pass=cska2023" 
       style="color:red;" 
       onclick="return confirm('Удалить отзыв?')">Удалить</a>
</div>
<?php endwhile; ?>