<?php
include_once ('db_config.php'); ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3css.css">
</head>
<body>
<?php include 'sidebar.php';?>

<div style="margin-left:200px">

    <div class="w3-container w3-teal">
        <h2>Dodaj odsustvo</h2>
    </div>

    <form class="w3-container"  method="POST" enctype="multipart/form-data">

        <label class="w3-text-teal"><b>Vozač</b></label>
        <select class="w3-select w3-light-gray" name="driver">
            <option value="" disabled selected>Odaberite vozača.</option>
            <?php
            $sql = "SELECT * FROM drivers";
            $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result)>0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '<option value="' . $record['ID_Driver'] . '">' . $record['ID_Driver'] . ' - ' . $record['First_Name'] . ', ' . $record['Last_Name'] . '</option>';
                }
            } ?>
        </select>

        <label class="w3-text-teal"><b>Odsutan od:</b></label>
        <input class="w3-input w3-border w3-light-grey" type="date" name="oddate">

        <label class="w3-text-teal"><b>Odsutan do:</b></label>
        <input class="w3-input w3-border w3-light-grey" type="date" name="dodate">

        <label class="w3-text-teal"><b>Razlog odsustva:</b></label>
        <select class="w3-select w3-light-gray" name="reason">
            <option value="" disabled selected>Odaberite razlog odsustva.</option>
            <option value="GODIŠNJI ODMOR"">GODIŠNJI ODMOR</option>
            <option value="BOLOVANJE">BOLOVANJE</option>
            <option value="BOLOVANJE">DRUGO</option>
        </select>
        <p> </p>
        <button class="w3-btn w3-blue-grey" type="submit">Dodaj odsustvo!</button>
    </form>
    <?php
    if (null !==@$_REQUEST['driver'])  {


    $adriver = stripslashes($_REQUEST['driver']);
    $adriver = mysqli_real_escape_string($connection, $adriver);

    $aoddate = stripslashes($_REQUEST['oddate']);
    $aoddate = mysqli_real_escape_string($connection, $aoddate);

    $adodate = stripslashes($_REQUEST['dodate']);
    $adodate = mysqli_real_escape_string($connection, $adodate);

    $areason = stripslashes($_REQUEST['reason']);
    $areason = mysqli_real_escape_string($connection, $areason);

        $query = "INSERT into `absences` (`ID_Driver`, `FromDate`, `ToDate`, `Reason`) 
VALUES ('$adriver', '$aoddate', '$adodate', '$areason')";

        $result = mysqli_query($connection, $query);

        //ispis ako je uspešno dodavanje autobusa u bazu podataka
        if ($result) {
            echo "<div class='form'>
        <h3>Uspešno ste dodali odsustvo!</h3>
        </div>";
        } else {

            echo mysqli_error($connection);
            echo "Greška!!";
        }
    }
    ?>

    <form name="registration" action="" method="post">
        <input type="text" name="DRNUM" placeholder="Službeni broj" style="width:500px;" />
        <select class="w3-select w3-light-gray" name="option">
            <option value="" disabled selected>Odaberite opciju.</option>
            <option value="BOLOVANJE">GRADSKI SOLO</option>
            <option value="GODIŠNJI ODMOR">GRADSKI ZGLOBNI</option>
            <option value="DRUGO">PRIGRADSKI</option>
        </select>
        <input type="submit" name="submit" value="Pretraži odsustva!" />
    </form>


    <table class="w3-table-all">
        <tr>
            <th>BR. VOZAČA</th>
            <th>IME</th>
            <th>PREZIME</th>
            <th>DATUM OD</th>
            <th>DATUM DO</th>
            <th>RAZLOG</th>
            <th>IZMENE</th>
        </tr>
        <?php
        if (isset($_REQUEST['DRNUM'])) {
            $drsearch=@$_REQUEST['DRNUM'];
            $optionsearch=@$_REQUEST['option'];
            $sql = "SELECT * FROM absences JOIN drivers where absences.ID_Driver = drivers.ID_Driver and (absences.ID_Driver=$drsearch) or (absences.Reason='$optionsearch')";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '<tr><td>' . $record['ID_Driver'] . '</td><td>' . $record['First_Name'] . '</td>
            <td>' . $record['Last_Name'] . '</td><td>' . $record['FromDate'] . '</td><td>' . $record['ToDate'] . '</td><td>' . $record['Reason'] . '</td>
            <td>Edit, Delete</td></tr>';
                }
            }

        } else {
            $sql = "SELECT * FROM absences JOIN drivers where absences.ID_Driver = drivers.ID_Driver and absences.ToDate>now()";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '<tr><td>' . $record['ID_Driver'] . '</td><td>' . $record['First_Name'] . '</td>
            <td>' . $record['Last_Name'] . '</td><td>' . $record['FromDate'] . '</td><td>' . $record['ToDate'] . '</td><td>' . $record['Reason'] . '</td>
            <td>Edit, Delete</td></tr>';
                }
            }
        }?>
    </table>

</div>


</body>

</html>