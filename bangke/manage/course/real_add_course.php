<?php

/* --------------------------测试通过---------------------------  */

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

require_once "../database/connect_db.php";

global $conn;

$c_type = $_POST['c_type'];
$c_code = $_POST['c_code'];
$c_name = $_POST['c_name'];
$c_style = $_POST['c_style'];
$c_num = $_POST['c_num'];
$c_pay = $_POST['c_pay'];
$c_sign_num = $_POST['c_sign_num'];

if ($conn) {
	/* UTF8编码测试通过 */	
	mysqli_query($conn, "SET NAMES utf8");	// set charset
	/* ---测试通过end--- */



	$stmt = mysqli_prepare($conn, "insert into courses values (?, ?, ?, ?, ?, ?, ?)");

	mysqli_stmt_bind_param($stmt, "ssssddd", $c_type, $c_code, $c_name, $c_style, $c_num, $c_pay, $c_sign_num);

	if (!mysqli_stmt_execute($stmt)) {
		exit(-1);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

	header('Location: index.php');
}

/* ---------------测试通过end-------------- */

?>