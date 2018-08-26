<?php

include_once('db_config.php');
$id = $_POST['id'];
$field = $_POST['field'];
$newVal = $_POST['newVal'];
$sql = mysqli_query($con,"UPDATE orders SET $field = '$newVal' WHERE OrderID = $id");
if($sql) echo 'success'; else echo '0';

?>