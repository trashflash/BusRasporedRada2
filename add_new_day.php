<?php
include_once "db_config.php";
include_once "sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dodaj</title>
    <link rel="stylesheet" href="w3css.css">
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
    
   <div class="w3-row-padding">
  
        <input type="hidden" class="w3-input w3-border" name="addtl" value="yes"/>
        
        <input type="hidden" class="w3-input w3-border" name="date" value="'.$datenew.'"/>
        <div class="w3-twothird">
        <select class="w3-select w3-border w3-light-gray" name="tour">
            <option value="" disabled selected>Odaberite opciju.</option>';
    $sqldate = "SELECT * from tours ORDER BY `Name` DESC";
    $result = mysqli_query($con, $sqldate);
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '      <option value="' . $record['ID_Tour'] . '">' . $record['Name'] . ' Opis:' . $record['Description'] . ' Dan:' . $record['Type_Day'] . '</option>';
        }
        echo '
        </select></div>
        <div class="w3-third"><input type="submit" class="w3-button w3-border-blue w3-cyan"value="Dodaj"/></div></div>
        </form>
        ';

    }
}
else{

echo'

<form method="post" action="">

<div class="w3-quarter">Datum</div><div class="w3-quarter">Tip Dana</div>
<div class="w3-quarter">Tip Turažnih listova</div>
<div class="w3-quarter">.</div>

    <input class="w3-input w3-quarter w3-border" type="date" name="datum"/>
    <div>
        <select class="w3-input w3-quarter w3-border" name="selectday">
            <option value="15">Radni dan</option>
            <option value="6">Subota</option>
            <option value="7">Nedelja</option>
        </select>
    </div>
    <div>
        <select class="w3-input w3-quarter w3-border" name="selecttour">
            <option value="1">Radni dan - Obično</option>
            <option value="2">Radni dan - B turažni</option>
            <option value="3">Radni dan - C turažni</option>
            <option value="4">Subota</option>
            <option value="5">Nedelja</option>
        </select>
        <input class="w3-button w3-cyan w3-quarter w3-border" type="submit" value="Dodaj"/>
    </div>
</form>
<p></p><br/>
<div class="w3-third">Datum koji se pravi</div><div class="w3-third">Datum koji se kopira</div>
<div class="w3-third">.</div>
<form method="post" action="">
    <input class="w3-input w3-third w3-border" type="date" name="dateto" />
    <input class="w3-input w3-third w3-border" type="date" name="datefrom" />
        <input class="w3-button w3-aqua w3-third w3-border" type="submit" value="Prekopiraj"/>
</form>


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