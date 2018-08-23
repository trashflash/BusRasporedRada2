<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3css.css">
</head>
<body>
<?php include_once 'db_config.php';?>

<?php include 'sidebar.php';?>

<div style="margin-left:200px">

    <div class="w3-container w3-teal">
        <h2>Dodaj vozača</h2>
    </div>

    <form class="w3-container">
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

        <div id="ownBus">Own bus
            <select>
                <?php
                echo '<option value="null">Nema</option>';
                $sql = "SELECT ID_Bus FROM buses";
                $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

                if (mysqli_num_rows($result)>0) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo '<option value="' . $record['ID_Bus'] . '">' . $record['ID_Bus'] . '</option>';
                    }
                } ?>
            </select></div>

        Digitalni tahograf
        <input type="radio" name="digitTach" value="1">DA
        <input type="radio" name="digitTach" value="0">NE<br/>

        <p> </p>
        <button class="w3-btn w3-blue-grey">Dodaj vozača!</button>
    </form>

</div>
</body>

</html>