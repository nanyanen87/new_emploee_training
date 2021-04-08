<?php
if (isset($_POST["name"])) {
    $user_name = htmlspecialchars($_GET["name"]);
    var_dump("ログインしました");
    session_start();
    $_SESSION["email"] = "nan.hanaoka@gmail.com";
    header('Location: /');
}