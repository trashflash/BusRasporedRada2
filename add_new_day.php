<?php
include_once "db_config.php";
include_once "sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dodaj</title>
</head>
<body>
<div style="padding-left: 205px">
<?php
if((isset($_GET['tour'])) && (isset($_GET['date']))) {

    $idtourquery=$_GET['tour'];
    $datequery=$_GET['date'];
    $query = "INSERT INTO workplan(ID_Tour,Date_Work,Start_Time,End_Time,Total_Time) SELECT ID_Tour, '$datequery', Start_Time, End_Time, Total_Time FROM tours 
WHERE ID_Tour=$idtourquery";
    $result = mysqli_query($con,$query);
    if($result){
        echo "success1";
    }
}
if((@$_GET['action'] == 'add') && (isset($_GET['date']))) {
    $datenew=$_GET['date'];
    echo 'Datum kojem se dodaje turažni list:'.$datenew;
    echo ' <form class="w3-container" method="get" action="">
    <label class="w3-text-teal"><b>Odaberite turažni list koji želite dodati:</b></label>
    <input type="hidden" name="action" value="add"/>
        <input type="hidden" name="addtl" value="yes"/>
        <input type="hidden" name="date" value="'.$datenew.'"/>
        <select class="w3-select w3-border w3-light-gray" name="tour">
            <option value="" disabled selected>Odaberite opciju.</option>';
    $sqldate = "SELECT * from tours ORDER BY `Name` DESC";
    $result = mysqli_query($con, $sqldate);
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '      <option value="' . $record['ID_Tour'] . '">' . $record['Name'] . ' Opis:' . $record['Description'] . ' Dan:' . $record['Type_Day'] . '</option>';
        }
        echo '
        </select>
        <input type="submit" value="submit"/>
        </form>
        ';

    }
}
else{

echo'

<form method="post" action="">
    <input type="date" name="datum"/>
    <div>
        <select name="selectday">
            <option value="15">Radni dan</option>
            <option value="6">Subota</option>
            <option value="7">Nedelja</option>
        </select>
    </div>
    <div>
        <select name="selecttour">
            <option value="1">Radni dan - Obično</option>
            <option value="2">Radni dan - B turažni</option>
            <option value="3">Radni dan - C turažni</option>
            <option value="4">Subota</option>
            <option value="5">Nedelja</option>
        </select>
        <input type="submit" value="submit"/>
    </div>
</form>
---------

<form method="post" action="">
    DATE TO:
    <input type="date" name="dateto" />
    DATE FROM:
    <input type="date" name="datefrom" />
        <input type="submit" value="submit"/>
</form>
--------

';

@$date=@$_REQUEST['datum'];
@$selectday=@$_REQUEST['selectday'];
@$selecttour=@$_REQUEST['selecttour'];
@$dateto=@$_REQUEST['dateto'];
@$datefrom=@$_REQUEST['datefrom'];




$thereis=0;
$thereisa=0;


if(isset($_REQUEST['selectday'])){
    $sql="SELECT * FROM tours WHERE Type_Day=$selectday and Type_Tour=$selecttour;";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


            echo 'TEXT' .  $record["ID_Tour"].'-- '.$record["Description"].' - ';
            $thereis=1;
        }
    } else {
        echo "---";
    };
    }
    if($thereis) {
        $query = "INSERT INTO workplan(ID_Tour,Date_Work,Start_Time,End_Time,Total_Time) SELECT ID_Tour, '$date', Start_Time, End_Time, Total_Time FROM tours 
WHERE Type_Tour=$selecttour and Type_Day=$selectday";
        $result = mysqli_query($con,$query);
    if($result){
        echo "success1";
    }
        $query = "INSERT INTO orders(OrderDate, OrderText, OrderImportance) VALUES '$date', '0', 0";
        $result = mysqli_query($con,$query);
        if($result){
            echo "success1";
        }
    }

?>

------

<?php

$isfrom=0;
$isto=1;
if(isset($_REQUEST['datefrom'])) {
    $sqlfrom="SELECT * FROM workplan WHERE Date_Work=$datefrom";
    $result = mysqli_query($con,$sqlfrom);
if (mysqli_num_rows($result) > 0) {
    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        $isfrom=1;
    }
}};
$nosuccess=64;
if(isset($_REQUEST['dateto'])) {
    $sqlto="SELECT * FROM workplan WHERE Date_Work=$datefrom";
    $result = mysqli_query($con,$sqlto);
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


            $isto=0;

        }
    };


if($isfrom==1){
    if($isto==0) {

        $sqldates = "INSERT INTO workplan(ID_Tour,ID_Driver,ID_Bus1,Date_Work,Start_Time,End_Time,Total_Time) SELECT ID_Tour, ID_Driver, ID_Bus1, '$dateto', Start_Time, End_Time, Total_Time FROM workplan
WHERE Date_Work='$datefrom'";
        $result = mysqli_query($con,$sqldates);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $nosuccess=64;
            }
            $query = "INSERT INTO orders(OrderDate, OrderText, OrderImportance) VALUES '$date', '0', 0";
            $result2 = mysqli_query($con,$query);
            if($result2){
                echo "success1";
            }
        }
        else {

}
}
}else{ $nosuccess=99;}
}
if(isset($_REQUEST['datefrom'])){
if(isset($_REQUEST['dateto'])){
if($nosuccess==99){
   echo "nije success kopiranje datuma";
}}}
}

?>
</div>
</body>
</html>