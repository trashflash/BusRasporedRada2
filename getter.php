<?php

include_once('db_config.php');
$id = $_POST['id'];
$field = $_POST['field'];
$newVal = $_POST['newVal'];
$sql = mysqli_query($con,"UPDATE workplan SET $field = '$newVal' WHERE ID_Work = $id");
if($sql) echo 'success'; else echo '0';

?>