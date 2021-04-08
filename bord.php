<?php

//DB接続
$mysqli = new mysqli('localhost', 'sudo_user', 'dadadada', 'test_db');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
//データ取得
$sql_get = "SELECT * FROM test_bord";
$rows=array();
if ($result = $mysqli->query($sql_get)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}
//DBに挿入
//validationチェック
if (!empty($_POST["send"])) {
    //入力チェック関数
    $user_name = htmlspecialchars($_POST["name"]);
    $comment = htmlspecialchars($_POST["message"]);
    $validateErrors = form_validation($_POST["name"],$_POST["message"]);
    //↓いらない説
    if (empty ($validateErrors)) {
        $isValidateError = false;
    } else {
        $isValidateError = true;
    }
    if (!$isValidateError) {
        var_dump("送信できましたよ");
        $stmt = $mysqli->prepare("insert into test_bord (user_name, comment, created, modified)"
            ." values( ?,?,now(), now())");
        $stmt->bind_param("ss",$user_name,$comment);
        $res = $stmt->execute();
        var_dump($res);
        $stmt->close();

        header('Location: /');
    } else {

    }

}

function form_validation($name,$message)
{
    $validateErrors = array();
    if (empty($name)) {
        $validateErrors[] = "「氏名」は必ず入力してください。";
    }
    if (strlen($name) > 30) {
        $validateErrors[] = "名前は10字以内で入力してください。";
    }
    if (empty($message)) {
        $validateErrors[] = "内容を入れてください。";
    }
    if (strlen($message) > 90) {
        $validateErrors[] = "内容は３０字以内で入れてください。";
    }
    return $validateErrors;
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>testbord</title>
</head>
<body>
<?php if ($isValidateError): ?>
    <ul>
        <?php foreach ($validateErrors as $value): ?>
            <li>
                <?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form action="bord.php" method="post">
    <div>
        <label for="name">名前</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="message">内容</label>
        <input type="text" id="message" name="message">
    </div>
    <input type="submit" name="send">

</form>
<h2>表示欄</h2>
<div>
    <tr>
        <?php foreach ($rows as $row) { ?>
        <td><?= $row["user_name"] ."<br>" ?></td>
        <td><?= $row["comment"] ."<br>"?></td>
        <td><?= $row["created"] ."<br>"?></td>
        <?php } ?>
    </tr>
</div>
</body>
<style>
    ul > li {
        color:red;
    }
</style>
</html>