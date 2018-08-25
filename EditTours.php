<?php
include_once ('db_config.php');

@$delid=$_GET['tours'];
@$id=$_POST['tourID'];
@$name=$_POST['Name'];
@$desc=$_POST['Desc'];
@$start=$_POST['Start'];
@$end=$_POST['End'];
@$total=$_POST['Total'];
@$typet=$_POST['TypeT'];
@$typed=$_POST['TypeD'];
@$upload=$_POST['upload'];

if (isset($delid)){
    $sql = "DELETE FROM tours WHERE ID_Tour=$delid";

    if (mysqli_query($connection, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }}
if(isset($name)){
    $sql = "SELECT ID_Tour FROM tours";
    $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));
    if (mysqli_num_rows($result)>0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if ($record['ID_Tour']==$id){
                $idt=$id;
                break;
            }
        }
    }
    if(isset($idt)){
        $sql = "UPDATE tours SET ID_Tour=$idt,`Name`='$name',Description='$desc',Start_Time='$start',End_Time='$end',Total_Time='$total',Type_Tour=$typet,Type_Day=$typed,Photo_Link_Tour='$upload'
            WHERE ID_Tour=$idt";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }
    else {
        $sql = "INSERT INTO tours 
            VALUES ($id,'$name','$desc','$start','$end','$total',$typet,$typed,'$upload')";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }}
header("Location: http://localhost/busrasporedrada2/listtour");
exit();