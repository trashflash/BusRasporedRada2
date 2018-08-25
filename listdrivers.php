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
        <h3>Dodaj vozača</h3>
        <button class="w3-btn w3-blue-grey" style="float: right" value="_" onclick="hideit('adddriver');">
    </div>
    <div id="adddriver" style="display: none;">
        <form class="w3-container" method="post" action="EditDriver.php" >
            <label class="w3-text-teal"><b>Službeni broj:</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="driverID">

            <label class="w3-text-teal"><b>Ime</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="driverFName">

            <label class="w3-text-teal"><b>Prezime</b></label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="driverLName">

            <label class="w3-text-teal"><b>Lozinka</b></label>
            <input class="w3-input w3-border w3-light-grey" type="password" name="password">

            <label class="w3-text-teal"><b>Područje rada</b></label>
            <select class="w3-select w3-light-gray" name="area">
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

    <div class="w3-container w3-teal" onclick="hideit('ddrivers');"> <h4>Vozači</h4> </div>
    <div id="ddrivers">
    <table class="w3-table-all">
        <tr>
            <th>BROJ</th>
            <th>SLIKA</th>
            <th>IME, PREZIME</th>
            <th>PODRUČJE</th>
            <th>BUS</th>
            <th>DIG. TAH.</th>
            <th>IZMENE</th>
        </tr>
        <?php
        $sql = "SELECT * FROM drivers";
        $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

        if (mysqli_num_rows($result)>0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if ($record['Digital_Tachograph']=1) $dig='IMA'; else $dig='NEMA';
                if ($record['Area']=1) $area='GRADSKI SOLO'; elseif ($record['Area']=2) $area='GRADSKI ZGLOBNI';
                elseif ($record['Area']=3) $area='PRIGRADSKI'; elseif ($record['Area']=4) $area='MEĐUGRADSKI';
                elseif ($record['Area']=5) $area='GRADSKI MINIBUS'; elseif ($record['Area']=6) $area='MEĐUGRADSKI MINIBUS';
                else $area='TURISTIČKI';

                echo '<tr><td>' . $record['ID_Driver'] . '</td>
                        <td><img src="' . $record['Photo_Link_Driver'] . '" style="height:50px"></td>
                        <td>' . $record['First_Name'] . ', ' . $record['Last_Name'] . '</td>
                        <td>' . $area . '</td>
                        <td>' . $record['Bus_Own'] . '</td>
                        <td>' . $dig . '</td>
                        <td>MENJAJ / <a href="EditDriver.php?drivers='.$record['ID_Driver'].'" onclick="return confirm(\'Da li ste sigurni?\');">BRIŠI</a></td></tr>';
            }
        }
        ?>
    </table>
    </div>

</div>
</body>

</html>