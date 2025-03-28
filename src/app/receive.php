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
</div>
</body>
</html>

