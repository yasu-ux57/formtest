<!--
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>出力結果</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
    // ユーザーの入力データをセキュアに表示
    echo htmlspecialchars($_POST['recipe_name'], ENT_QUOTES);
    echo '<br>';
    
// match式を使ったカテゴリーの判定
echo match ($_POST['category']) {
    '1' => '和食',
    '2' => '中華',
    '3' => '洋食',
    default => '不明',
} . '<br>';

// match式を使った難易度の判定
echo match ($_POST['difficulty']) {
    '1' => '簡単',
    '2' => '普通',
    '3' => '難しい',
} . '<br>'; 
if (is_numeric($_POST['budget'])) {
    echo number_format($_POST['budget']);
} else {
    echo 'エラー: 数字を入力してください';
}
echo '<br>';
echo nl2br(htmlspecialchars($_POST['howto'], ENT_QUOTES));
echo '<br>';

?>
</body>
</html>
-->
<?php
// DB接続用（ユーザー名・パスワードは適宜調整）
$user = 'root';
$pass = 'example';

try {
    $dbh = new PDO('mysql:host=db;dbname=recipe_db;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームから受け取る
    $recipe_name = $_POST['recipe_name'];
    $category = $_POST['category'];
    $difficulty = $_POST['difficulty'];
    $budget = is_numeric($_POST['budget']) ? $_POST['budget'] : null;
    $howto = $_POST['howto'];

    // SQL実行（INSERT）
    $sql = "INSERT INTO recipes (recipe_name, category, difficulty, budget, howto)
            VALUES (:recipe_name, :category, :difficulty, :budget, :howto)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':recipe_name', $recipe_name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':budget', $budget);
    $stmt->bindParam(':howto', $howto);
    $stmt->execute();

} catch (PDOException $e) {
    echo 'エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>出力結果</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="recipe-details">
    <h2 class="dish-name">
        <?= htmlspecialchars($_POST['recipe_name'], ENT_QUOTES) ?>
    </h2>

    <div class="info-items">
        <div class="category">
            カテゴリ：<?= match ($_POST['category']) {
                '1' => '和食',
                '2' => '中華',
                '3' => '洋食',
                default => '不明',
            } ?>
        </div>

        <div class="difficulty">
            難易度：<?= match ($_POST['difficulty']) {
                '1' => '簡単',
                '2' => '普通',
                '3' => '難しい',
            } ?>
        </div>

        <div class="budget<?= is_numeric($_POST['budget']) ? '' : ' error' ?>">
            予算：<?= is_numeric($_POST['budget']) ? number_format($_POST['budget']) . '円' : 'エラー: 数字を入力してください' ?>
        </div>
    </div>

    <div class="method">
        <h3>作り方</h3>
        <p><?= nl2br(htmlspecialchars($_POST['howto'], ENT_QUOTES)) ?></p>
    </div>
    <p><a href="list.php">▶ レシピ一覧へ</a></p>
</div>
</body>
</html>