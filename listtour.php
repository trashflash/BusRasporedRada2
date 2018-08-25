<?php
include_once ('db_config.php'); ?>

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
        <form class="w3-container" method="post" action="EditTours.php">
            <label class="w3-text-teal"><b>Službeni broj:</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="tourID">

            <label class="w3-text-teal"><b>Ime</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="Name">

            <label class="w3-text-teal"><b>Opis</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="Desc">

            <label class="w3-text-teal"><b>Početno vreme</b></label>
            <input class="w3-input w3-border w3-light-grey" type="time" name="Start">
            <label class="w3-text-teal"><b>Početno vreme</b></label>

            <label class="w3-text-teal"><b>Krajnje vreme</b></label>
            <input class="w3-input w3-border w3-light-grey" type="time" name="End">
            <label class="w3-text-teal"><b>Početno vreme</b></label>

            <label class="w3-text-teal"><b>Ukupno vreme</b></label>
            <input class="w3-input w3-border w3-light-grey" type="time" name="Total">
            <label class="w3-text-teal"><b>Početno vreme</b></label>

            <label class="w3-text-teal"><b>Tip turažne linije</b></label>
            <select class="w3-select w3-light-gray" name="TypeT">
                <option value="" disabled selected>Odaberite opciju.</option>
                <option value="1">GRADSKI</option>
                <option value="2">PRIGRADSKI</option>
                <option value="3">MEĐUGRADSKI</option>
                <option value="4">MEŠOVITO</option>
                <option value="5">TURISTIČKI</option>
            </select>

            <label class="w3-text-teal"><b>Slika</b></label>
            <input class="w3-input w3-border w3-light-grey" type="file" name="upload">

            <label class="w3-text-teal"><b>Broj autobusa</b></label>
            <select class="w3-select w3-light-gray" name="ownBus">
                <?php
                echo '<option value="null">Nema</option>';
                $sql = "SELECT ID_Bus FROM buses";
                $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

                if (mysqli_num_rows($result)>0) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo '<option value="' . $record['ID_Bus'] . '">' . $record['ID_Bus'] . '</option>';
                    }
                } ?>
            </select>

            <label class="w3-text-teal"><b>Digitalni tahograf</b></label>
            <input type="radio" name="digitTach" value="1">IMA
            <input type="radio" name="digitTach" value="0">NEMA<br/>
            <p> </p>
            <button class="w3-btn w3-blue-grey">Dodaj vozača!</button><br/><p></p>
        </form>
    </div>

    <div class="w3-container w3-teal" onclick="hideit('ddrivers');"> <h4>Turažni listovi</h4> </div>
    <div id="ddrivers">
        <table class="w3-table-all">
            <tr>
                <th>BROJ</th>
                <th>SLIKA</th>
                <th>IME</th>
                <th>OPIS</th>
                <th>POČETAK</th>
                <th>KRAJ</th>
                <th>UKUPNO VREME</th>
                <th>IZMENE</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tours";
            $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result)>0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($record['Digital_Tachograph']=1) $dig='IMA'; else $dig='NEMA';
                    if ($record['Area']=1) $area='GRADSKI SOLO'; elseif ($record['Area']=2) $area='GRADSKI ZGLOBNI';
                    elseif ($record['Area']=3) $area='PRIGRADSKI'; elseif ($record['Area']=4) $area='MEĐUGRADSKI';
                    elseif ($record['Area']=5) $area='GRADSKI MINIBUS'; elseif ($record['Area']=6) $area='MEĐUGRADSKI MINIBUS';
                    else $area='TURISTIČKI';

                    echo '<tr><td>' . $record['ID_Tour'] . '</td>
                        <td><img src="' . $record['Photo_Link_Tour'] . '" style="height:50px"></td>
                        <td>' . $record['Name'] . '</td><td>' . $record['Description'] . '</td>
                        <td>' . $record['Start_Time'] . '</td><td>' . $record['End_Time'] . '</td>
                        <td>' . $record['Total_Time'] . '</td>
                        <td>MENJAJ / <a href="EditDriver.php?driveri='.$record['ID_Tour'].'" onclick="return confirm(\'Da li ste sigurni?\');">BRIŠI</a></td></tr>';
                }
            }
            ?>
        </table>
    </div>

</div>
</body>

</html>