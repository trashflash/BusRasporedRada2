<?php
include_once ('db_config.php');
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3css.css">
    <script src="Fun.js"></script>
</head>
<body>
<?php include 'sidebar.php';

$sessionuserid=$_SESSION['UserID'];

if(@$_SESSION['ISAdmin']==111){
    $sessionuserid=0;
};?>

<div style="margin-left:200px">
    <?php

    $sql = "SELECT * FROM drivers where ID_Driver=$sessionuserid";
    $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result)>0) {
    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($record['Digital_Tachograph'] = 1) $dig = 'IMA'; else $dig = 'NEMA';
        if ($record['Area'] = 1) $area = 'GRADSKI SOLO'; elseif ($record['Area'] = 2) $area = 'GRADSKI ZGLOBNI';
        elseif ($record['Area'] = 3) $area = 'PRIGRADSKI';
        elseif ($record['Area'] = 4) $area = 'MEĐUGRADSKI';
        elseif ($record['Area'] = 5) $area = 'GRADSKI MINIBUS';
        elseif ($record['Area'] = 6) $area = 'MEĐUGRADSKI MINIBUS';
        else $area = 'TURISTIČKI';
        $sqll = "SELECT count(distinct w.Date_Work) as datte,SEC_TO_TIME( SUM( TIME_TO_SEC(w.Total_Time) ) ) as summ FROM drivers d join workplan w on d.ID_Driver=w.ID_Driver where w.ID_Driver=$sessionuserid and month(Date_Work)=month(now())";
        $resultl = mysqli_query($connection, $sqll) or die(mysqli_error($connection));
        if (mysqli_num_rows($resultl) > 0) {
            while ($recordl = mysqli_fetch_array($resultl, MYSQLI_ASSOC)) {
            if($recordl['summ']>0){
                $sumofhours=$recordl['summ'];}
                else{
                $sumofhours="00:00:00";
                }
                echo '<div class="w3-container">

        <div class="w3-card-4" style="width:100%">
            <header class="w3-container w3-light-grey">
                <img src="' . $record['Photo_Link_Driver'] . '" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px"> <h3>' . $record['First_Name'] . ' ' . $record['Last_Name'] . '</h3>
            </header>
            <div class="w3-container">


                <p>Dobrodošli na Vaš profil!</p>
                <hr>
                <p>Ovaj mesec ste radili: ' . $sumofhours . ' sati.
                </p><br>
            </div>
        </div>
    </div>';
            }
        }

    }}

    ?>



    <div class="w3-container w3-teal" onclick="hideit('todayw');"> <h4>Plan rada za danas i buduće dane:</h4> </div>
    <div id="todayw">
        <table class="w3-table-all">
            <tr>
                <th>TURAŽNI LIST</th>
                <th>OPIS</th>
                <th>DATUM</th>
                <th>BUS</th>
                <th>POČETAK</th>
                <th>KRAJ</th>
                <th>UKUPNO VREME</th>
            </tr>
            <?php
            $sql = "SELECT *, t.name as name,t.description as descr FROM workplan w join tours t on w.id_tour=t.id_tour join drivers d on w.id_driver=d.id_driver where w.ID_Driver=$sessionuserid and w.Date_Work>=current_date()";
            $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result)>0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                    echo '<tr><td>' . $record['name'] . '</td><td>' . $record['descr'] . '</td>
                        <td>' . $record['Date_Work'] . '</td><td>' . $record['ID_Bus1'] . '</td>
                        <td>' . $record['Start_Time'] . '</td><td>' . $record['End_Time'] . '</td>
                        <td>' . $record['Total_Time'] . '</td></tr>';
                }
            }
            ?>
        </table>
    </div>
    <div class="w3-container w3-teal" onclick="hideit('allwork');" > <h4>Plan rada za sve dane za korisnika:</h4> </div>
    <div id="allwork" style="display: none">
        <table class="w3-table-all">
            <tr>
                <th>TURAŽNI LIST</th>
                <th>OPIS</th>
                <th>DATUM</th>
                <th>BUS</th>
                <th>POČETAK</th>
                <th>KRAJ</th>
                <th>UKUPNO VREME</th>
            </tr>
            <?php
            $sql = "SELECT *, t.name as name,t.description as descr FROM workplan w join tours t on w.id_tour=t.id_tour join drivers d on w.id_driver=d.id_driver where w.ID_Driver=$sessionuserid";
            $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result)>0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                    echo '<tr><td>' . $record['name'] . '</td><td>' . $record['descr'] . '</td>
                        <td>' . $record['Date_Work'] . '</td><td>' . $record['ID_Bus1'] . '</td>
                        <td>' . $record['Start_Time'] . '</td><td>' . $record['End_Time'] . '</td>
                        <td>' . $record['Total_Time'] . '</td></tr>';
                }
            }
            ?>
        </table>
    </div>

</div>
</body>

</html>