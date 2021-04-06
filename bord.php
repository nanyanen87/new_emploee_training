<?php

    $mysqli = new mysqli('localhost', 'sudo_user', 'dadadada', 'test_db');
    if ($mysqli->connect_error) {
        echo $mysqli->connect_error;
        exit();
    } else {
        $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM test_bord";
    if ($result = $mysqli->query($sql)) {
        // 連想配列を取得
        while ($row = $result->fetch_assoc()) {
            echo $row["user_name"] . $row["comment"] . "<br>";
        }
        // 結果セットを閉じる
        $result->close();
    }




    $name = $_POST["name"];
    $message = $_POST["message"];
    $row = [
            "user_name" => $name,
            "content"   => $message,
    ];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>testbord</title>
</head>
<body>
<form action="bord.php" method="post">
    <div>
        <label for="name">名前</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="message">内容</label>
        <input type="text" id="message" name="message">
    </div>
    <input type="submit" name="send" value="送信する">
</form>
<h2>表示欄</h2>
<div>
    <tr>
        <td><?= $row["content"] ?></td>
        <td><?= $row["user_name"] ?></td>
    </tr>
</div>
</body>
</html>