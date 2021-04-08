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
$rows = [];
if ($result = $mysqli->query($sql_get)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}
//session
//$_SESSION["EMAIL"]がなければログインサインインボタン表示。バリデーションに”ログインしてくださいを追加”
//$_SESSION["EMAIL"]があればボタン非表示
//DBに挿入
//validationチェック
if (!empty($_POST["send"])) {
    //入力チェック関数
    $user_name = htmlspecialchars($_POST["name"],ENT_QUOTES,"UTF-8");
    $comment = htmlspecialchars($_POST["message"],ENT_QUOTES,"UTF-8");
    $validate_errors = form_validation($_POST["name"],$_POST["message"]);
    //↓いらない説
    if (empty ($validate_errors)) {
        $is_validate_error = false;
    } else {
        $is_validate_error = true;
    }
    if (!$is_validate_error) {
        $stmt = $mysqli->prepare("insert into test_bord (user_name, comment, created, modified)"
            ." values( ?,?,now(), now())");
        $stmt->bind_param("ss",$user_name,$comment);
        $res = $stmt->execute();
        $stmt->close();

        header('Location: /');
    }

}

function form_validation($name,$message)
{
    $validate_errors = [];
    if (empty($name)) {
        $validate_errors[] = "「氏名」は必ず入力してください。";
    }
    if (mb_strlen($name) > 10) {
        $validate_errors[] = "名前は10字以内で入力してください。";
    }
    if (empty($message)) {
        $validate_errors[] = "内容を入れてください。";
    }
    if (mb_strlen($message) > 30) {
        $validate_errors[] = "内容は３０字以内で入れてください。";
    }
    //$_SESSION["EMAIL"]あるかどうか追加
    return $validate_errors;
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>testbord</title>
</head>
<body>
    <?php if ($is_validate_error): ?>
    <ul>
        <?php foreach ($validate_errors as $value): ?>
            <li>
                <?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
<div>
    <?php if ($_SESSION["email"]):?>
    <button name="logout" id="logout">ログアウト</button>
    <?php  else:?>
    <button name="login" id="login">ログイン</button>
    <?php endif;?>
</div>
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
<script type="text/javascript">
    document.getElementById("login").onclick = function () {
        window.location.href = '/login.php';
    }

    document.getElementById("logout").onclick = function () {
        window.location.href = '/controllers/logout.php';
        console.log("ok");
    }
</script>
</body>
<style>
    ul > li {
        color:red;
    }
</style>
</html>