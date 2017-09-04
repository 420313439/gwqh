<?php

session_start();

require_once "../database/connect_db.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$stmt = mysqli_prepare($conn, "select * from user where username = ? and password = ?");

mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_fetch($stmt)) {
	setcookie("username", $username, time() + 3600, "/");
	setcookie("password", md5($password), time() + 3600, "/");
	/* $_COOKIE['PHPSESSID'] has been set automatically by session_start() */

	header('Location: /bangke/manage/index/allFunction.php');
} else {
	header('Location: login.php');
}

?>