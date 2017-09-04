<?php

/* 
 * Teachers Register 
 */

/* -------------------测试通过-------------------------- */

require_once "../database/connect_db.php";

global $conn;

mysqli_query($conn, "set names utf8");

$stmt = mysqli_prepare($conn, "insert into store_info(store_name, store_city, store_id, store_picture, store_address, store_zip_code, store_phone, store_contact_name, store_contact_mobile, store_intro, store_create_time) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())");

mysqli_stmt_bind_param($stmt, 'sssbssssss', $store_name, $store_city, $store_id, $store_picture, $store_address, $store_zip_code, $store_phone, $store_contact_name, $store_contact_mobile, $store_intro);

$store_name = $_POST['store_name'];
$store_city = $_POST['store_city'];
$store_id = $_POST['store_id'];
$store_picture = $_POST['store_picture'];
$store_address = $_POST['store_address'];
$store_zip_code = $_POST['store_zip_code'];
$store_phone = $_POST['store_phone'];
$store_contact_name = $_POST['store_contact_name'];
$store_contact_mobile = $_POST['store_contact_mobile'];
$store_intro = $_POST['store_intro'];

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: index.php");

/* ---------------------------测试通过end------------------------------ */

?>