<table>
<?php
//include_once("sidebar.php");
include_once("db_config.php");
if((@$_GET['action'] == 'edit') && isset($_GET['id'])) {
$datum=@$_GET['id'];

    $sql="SELECT ID_Work, ID_Tour, ID_Driver, ID_Bus1, Date_Work, Start_Time, End_Time, Total_Time FROM workplan
WHERE Date_Work='$datum'";
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {



               echo '<form name="'. $record['ID_Work'] .'">
    <input type="text" name="ID_Tour" value="'. $record['ID_Tour'] .'">
    <input type="text" name="ID_Driver" value="'. $record['ID_Driver'] .'">
    <input type="text" name="ID_Bus1" value="'. $record['ID_Bus1'] .'">
    <input type="text" name="Start_Time" value="'. $record['Start_Time'] .'">
    <input type="text" name="End_Time" value="'. $record['End_Time'] .'">
    <input type="text" name="Total_Time" value="'. $record['Total_Time'] .'">
</form><br/w>';


            }
        }
    }
?>
</table>

