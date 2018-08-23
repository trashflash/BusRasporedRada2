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

    <div class="w3-container w3-teal">text</div>



    <div class="w3-container w3-teal">
        <h2>Promeni lozinku vozača</h2>
    </div>

    <form class="w3-container">

        <label class="w3-text-teal"><b>Vozač</b></label>
        <select class="w3-select w3-border w3-light-gray" name="driver1">
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

        <label class="w3-text-teal"><b>Vozač - ponovo</b></label>
        <select class="w3-select w3-border w3-light-gray" name="driver2">
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

        <label class="w3-text-teal"><b>Nova Lozinka</b></label>
        <input class="w3-input w3-border w3-light-grey" name="pass1" type="password">

        <label class="w3-text-teal"><b>Nova Lozinka - ponovo</b></label>
        <input class="w3-input w3-border w3-light-grey" name="pass2" type="password">

        <p> </p>
        <button class="w3-btn w3-blue-grey">Dodaj autobus!</button>
    </form>

</div>
</body>

</html>