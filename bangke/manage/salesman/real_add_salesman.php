<?php

/* 
 * Teachers Register 
 */

/* -------------------测试通过-------------------------- */

require_once "../database/connect_db.php";

global $conn;

mysqli_query($conn, "set names utf8");

$stmt = $conn->prepare("insert into salesman_info (salesman_card_id, salesman_name, salesman_salary, salesman_sex, salesman_score, salesman_store, salesman_mobile, salesman_qq, salesman_wechat, salesman_school) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param('ssdsdsssss', $salesman_card_id, $salesman_name, $salesman_salary, $salesman_sex, $salesman_score, $salesman_store, $salesman_mobile, $salesman_qq, $salesman_wechat, $salesman_school);

$salesman_card_id = $_POST['salesman_card_id'];
$salesman_name = $_POST['salesman_name'];
$salesman_salary = $_POST['salesman_salary'];
$salesman_sex = $_POST['salesman_sex'];
$salesman_score = $_POST['salesman_score'];
$salesman_store = $_POST['salesman_store'];
$salesman_mobile = $_POST['salesman_mobile'];
$salesman_qq = $_POST['salesman_qq'];
$salesman_wechat = $_POST['salesman_wechat'];
$salesman_school = $_POST['salesman_school'];

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php");

/* ---------------------------测试通过end------------------------------ */

?>