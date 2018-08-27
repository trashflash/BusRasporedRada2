<?php
include_once ('db_config.php');
include_once ('auth.php');
if(!isset($_SESSION["ISAdmin"])){
    header("Location: index.php");
    exit();
} ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3css.css">
    <script src="Fun.js"></script>
</head>
<body>
<?php include 'sidebar.php';?>

<div style="margin-left:200px">
    <div class="w3-container w3-teal" onclick="hideit('adddriver');">
        <h3>Dodaj turažni list</h3>
        <button class="w3-btn w3-blue-grey" style="float: right" value="_" onclick="hideit('adddriver');">
    </div>
    <div id="adddriver" style="display: none;">
        <form class="w3-container" method="post"  enctype="multipart/form-data" action="EditTours.php">
            <label class="w3-text-teal"><b>ID Turažnog lista:</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="tourID">

            <label class="w3-text-teal"><b>Ime</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="Name">

            <label class="w3-text-teal"><b>Opis</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="Desc">

            <label class="w3-text-teal"><b>Početno vreme</b></label>
            <input class="w3-input w3-border w3-light-grey" type="time" name="Start">

            <label class="w3-text-teal"><b>Krajnje vreme</b></label>
            <input class="w3-input w3-border w3-light-grey" type="time" name="End">

            <label class="w3-text-teal"><b>Ukupno vreme</b></label>
            <input class="w3-input w3-border w3-light-grey" type="time" name="Total">

            <label class="w3-text-teal"><b>Tip turažnih listova - hidden</b></label>
            <input class="w3-input w3-border w3-light-grey" type="number" hidden="hidden" value="3" name="TypeT">

            <label class="w3-text-teal"><b>Tip dana</b></label>
            <select class="w3-select w3-light-gray" name="TypeD">
                <option value="" disabled selected>Odaberite opciju.</option>
                <option value="15">Radni dan</option>
                <option value="6">Subota</option>
                <option value="7">Nedelja</option>
            </select>

            <label class="w3-text-teal"><b>Slika</b></label>
            <input class="w3-input w3-border w3-light-grey" type="file" name="uploadedimage">
            <p> </p>
            <button class="w3-btn w3-blue-grey">Dodaj turažni list!</button><br/><p></p>
        </form>
    </div>

    <div class="w3-container w3-teal" onclick="hideit('ddrivers');"> <h4>Turažni listovi</h4> </div>
    <div id="ddrivers">
        <table class="w3-table-all">
            <tr>
                <th>BROJ</th>
                <th>PDF</th>
                <th>IME</th>
                <th>OPIS</th>
                <th>DAN</th>
                <th>POČETAK</th>
                <th>KRAJ</th>
                <th>UKUPNO VREME</th>
                <th>IZMENE</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tours ORDER BY `Name` ASC";
            $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result)>0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                    if( $record['Photo_Link_Tour']!=null){
                        if($record['Photo_Link_Tour']=='null'){
                        $photorec="#";
                        }
                    else $photorec=$record['Photo_Link_Tour'];}
                    else{
                        $photorec="#";
                        }


                    echo '<tr><td>' . $record['ID_Tour'] . '</td>
                        <td><a href="' . $photorec . '">PDF</td>
                        <td>' . $record['Name'] . '</td><td>' . $record['Description'] . '</td><td>' . $record['Type_Day'] . '</td>
                        <td>' . $record['Start_Time'] . '</td><td>' . $record['End_Time'] . '</td>
                        <td>' . $record['Total_Time'] . '</td>
                        <td>MENJAJ / <a href="EditTours.php?tours='.$record['ID_Tour'].'" onclick="return confirm(\'Da li ste sigurni?\');">BRIŠI</a></td></tr>';
                }
            }
            ?>
        </table>
    </div>

</div>
</body>

</html>