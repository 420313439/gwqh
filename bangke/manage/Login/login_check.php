<?php

session_start();

include_once "../Database/connect_db.php";

global $conn;

$username = $_POST['username'];
$password = md5($_POST['password']);

$stmt = mysqli_prepare($conn, "select * from user where username = ? and password = ?");

mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_fetch($stmt)) {
	setcookie("username", $username, time() + 3600, "/");
	setcookie("password", md5($password), time() + 3600, "/");

	header('Location: ../Index/allFunction.php');
} else {
	header('Location: index.html');
}

exit(0);

?>