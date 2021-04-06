<?php
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