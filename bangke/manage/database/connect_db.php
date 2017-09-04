<?php

global $conn;

$conn = mysqli_connect('localhost', 'root', 'ppw(2875571)', 'testdb');

if (!$conn) {
	exit("connect failed");
}

?>
