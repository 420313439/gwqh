<?php

/*  测试通过  */

session_start();

if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
    header('Location: /bangke/manage/admin/login.php');
    exit(-1);
}

/* admin session */
if ($_COOKIE['PHPSESSID'] != session_id()) {
    header('Location: /bangke/manage/admin/login.php');
    exit(-1);
}

/* ---测试通过end--- */

/* ----------测试通过---------- */
require_once "../database/connect_db.php";

global $conn;

mysqli_query($conn, "set names utf8");

$stmt = mysqli_prepare($conn, "insert into classroom (cr_code, cr_name, cr_style, cr_store, cr_create_time, cr_remark) values (?, ?, ?, ?, now(), ?)");

mysqli_stmt_bind_param($stmt, "sssss", $cr_code, $cr_name, $cr_style, $cr_store, $cr_remark);


$cr_code = $_POST['cr_code'];
$cr_name = $_POST['cr_name'];
$cr_style = $_POST['cr_style'];	
$cr_store = $_POST['cr_store'];
$cr_remark = $_POST['cr_remark'];

$success = mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

/* --------测试通过end--------- */

if ($success) {
	header("Location: index.php");
	exit(0);
} else {
	header("Location: add_classroom.php");
	exit(0);
}
?>


