<?php
session_start();
unset($_SESSION["email"]);
var_dump("ログアウトしました");
header('Location: /');
