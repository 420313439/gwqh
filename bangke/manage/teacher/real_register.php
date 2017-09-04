<?php

/* 
 * Teachers Register 
 */

/* -------------------测试通过-------------------------- */

require_once "../database/connect_db.php";

global $conn;

mysqli_query($conn, "set names utf8");

$stmt = $conn->prepare("insert into tea_info(tea_card_id, tea_name, tea_style, tea_sex, tea_score, tea_qq, tea_mobile, tea_wechat, tea_salary, tea_store) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param('ssssdsssds', $tea_card_id, $tea_name, $tea_style, $tea_sex, $tea_score, $tea_qq, $tea_mobile, $tea_wechat, $tea_salary, $tea_store);

$tea_card_id = $_POST['tea_card_id'];
$tea_name = $_POST['tea_name'];
$tea_style = $_POST['tea_style'];
$tea_sex = $_POST['tea_sex'];
$tea_score = $_POST['tea_score'];
$tea_qq = $_POST['tea_qq'];
$tea_mobile = $_POST['tea_mobile'];
$tea_wechat = $_POST['tea_wechat'];
$tea_salary = $_POST['tea_salary'];
$tea_store = $_POST['tea_store'];

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php");

/* ---------------------------测试通过end------------------------------ */

?>