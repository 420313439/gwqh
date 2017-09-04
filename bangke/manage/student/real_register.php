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




require_once "../database/connect_db.php";

global $conn;

/* extremely important */
$stmt = $conn->prepare("set names utf8");		
mysqli_stmt_execute($stmt);


$stmt = $conn->prepare("insert into stu_info(stu_name, stu_mobile, stu_create_time, stu_parent_name, stu_parent_mobile, stu_card_id, stu_sex, stu_birthday, stu_school, stu_type, s_picture, stu_address, stu_email, stu_qq, stu_wechat, stu_group, stu_remark, stu_tag) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param('ssssssssssbsssssss', $stu_name, $stu_mobile, $stu_create_time, $stu_parent_name, $stu_parent_mobile, $stu_card_id, $stu_sex, $stu_birthday, $stu_school, $stu_type, $s_picture, $stu_address, $stu_email, $stu_qq, $stu_wechat, $stu_group, $stu_remark, $stu_tag);

$stu_name = $_POST['stu_name'];								/* 必填 */
$stu_mobile = $_POST['stu_mobile'];/* 必填 */
$stu_create_time = $_POST['stu_create_time'];/* 必填 */
$stu_parent_name = $_POST['stu_parent_name'];/* 必填 */
$stu_parent_mobile = $_POST['stu_parent_mobile'];/* 必填 */
$stu_card_id = $_POST['stu_card_id'];
$stu_sex = $_POST['stu_sex'];/* 必填 */
$stu_birthday = $_POST['stu_birthday'];/* 必填 */
$stu_school = $_POST['stu_school'];
$stu_type = $_POST['stu_type']; /* 必填 */
$s_picture = $_POST['s_picture'];
$stu_address = $_POST['stu_address'];
$stu_email = $_POST['stu_email'];/* 必填 */
$stu_qq = $_POST['stu_qq'];/* 必填 */
$stu_wechat = $_POST['stu_wechat'];/* 必填 */
$stu_group = $_POST['stu_group'];
$stu_remark = $_POST['stu_remark'];
$stu_tag = $_POST['stu_tag'];

try {
	$stmt->execute();
} catch (Execption $e) {
	echo $e->getMessage();
	exit(-1);
}

$stmt->close();


echo "<script>alert('insert sucessfully');</script>";

/*
if (!(isset($stu_name) && isset($stu_mobile) && isset($stu_create_time) && isset($stu_parent_name) && isset($stu_parent_mobile) && isset($stu_sex) && isset($stu_birthday) && isset($stu_email) && isset($stu_qq) && isset($stu_wechat))) {
		echo "<script>alert('请填写必填项');</script>";
		header("location: ./register.php");
		exit(0);
}
*/

header("Location: index.php");
// ---测试通过end---

?>