<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レシピ一覧</title>
    <link rel="stylesheet" href="list.css">
</head>
<body>
    <h1>レシピ一覧</h1>

<?php
$user = 'root';
$pass = 'example';
try {
    $dbh = new PDO('mysql:host=db;dbname=recipe_db;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM recipes';
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<table>' . PHP_EOL;
    echo '<tr>' . PHP_EOL;
    echo '<th>料理名</th><th>予算</th><th>難易度</th>' . PHP_EOL;
    echo '</tr>' . PHP_EOL;
    foreach ($result as $row) {
        echo '<tr>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['recipe_name'], ENT_QUOTES) . '</td>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['budget'], ENT_QUOTES) . '</td>' . PHP_EOL;
        echo '<td>' .
        match ($row['difficulty']) {
            1 => '簡単',
            2 => '普通',
            3 => '難しい',
        } . '</td>' . PHP_EOL;
        echo '</tr>' . PHP_EOL;
    }
    echo '</table>' . PHP_EOL;
    $dbh = null;
 } catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
 }
 

?>
