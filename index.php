<?php
//var_dump($_POST['name']);
if (empty($_POST["name"])) {
    echo "名前を入力してください";
} else {
    include "bord.php";
    $your_name = htmlspecialchars($_POST['name']);
    $now_time = date("Y/m/d H:i:s");
}
?>
<html>
<head>
    <title>PHP Test</title>
</head>
<body>
<?= '<h1>Hello World</h1>'; ?>
<form action="index.php" method="post">
    <p>Your name: <input type="text" name="name" /></p>
    <p><input type="submit" /></p>
</form>
Hi <?= $your_name?>.
Now <?= $now_time?>
</body>
<style>
    h1 {
        color:red;
    }
</style>
</html>