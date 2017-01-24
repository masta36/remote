<?php
include_once('mysql/db.php');
echo "test";
$mydb = new DB_MySQL('localhost','myclock','root','root');
$min = $_GET['min'];
$device = $_GET['device'];

$sql = "INSERT INTO myclock_listener (`device` ,`down`) VALUES ('" . $device . "', DATE_ADD(NOW(), INTERVAL " . $min . " MINUTE)) ";
echo "<br>" . $sql;
$mydb->query($sql);

$mydb->disconnect();

?>
