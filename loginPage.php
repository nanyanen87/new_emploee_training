<?php
//session管理
//バリデーション
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <Header />
    <h3>ログイン</h3>
    <div>
        <form action="/controllers/login.php" method="get">
            <div>
                <label for="name">名前</label>
                <input type="text" id="name" name="name" value="hanaoka">
            </div>
            <div>
                <label for="message">e-mail</label>
                <input type="text" id="e-mail" name="e-mail" value="nan.hanaoka@gmail.com">
            </div>
            <input type="submit" name="send">
        </form>
    </div>
    <h3>サインイン</h3>
    <div>
        <form action="/controllers/signin.php" method="post">
            <div>
                <label for="name">名前</label>
                <input type="text" id="name" name="name" value="hanaoka">
            </div>
            <div>
                <label for="message">e-mail</label>
                <input type="text" id="e-mail" name="e-mail" value="nan.hanaoka@gmail.com">
            </div>
            <input type="submit" name="send">
        </form>
    </div>
</div>
</body>
</html>
