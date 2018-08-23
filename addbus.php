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
        <h2>Dodaj autobus</h2>
    </div>

    <form class="w3-container" action="saveimage.php" method="POST" enctype="multipart/form-data">
        <label class="w3-text-teal"><b>Garažni broj:</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="gbr">

        <label class="w3-text-teal"><b>Vrsta</b></label>
        <select class="w3-select w3-light-gray" name="option">
            <option value="" disabled selected>Odaberite opciju.</option>
            <option value="GRADSKI SOLO">GRADSKI SOLO</option>
            <option value="GRADSKI ZGLOBNI">GRADSKI ZGLOBNI</option>
            <option value="PRIGRADSKI">PRIGRADSKI</option>
            <option value="MEĐUGRADSKI">MEĐUGRADSKI</option>
            <option value="GRADSKI MINIBUS">GRADSKI MINIBUS</option>
            <option value="MEĐUGRADSKI MINIBUS">MEĐUGRADSKI MINIBUS</option>
            <option value="TURISTIČKI">TURISTIČKI</option>
        </select>

        <label class="w3-text-teal"><b>Opis</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="opis">

        <label class="w3-text-teal"><b>Registarske tablice</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="reg">

        <label class="w3-text-teal"><b>Slika</b></label>
        <input class="w3-input w3-border w3-light-grey" type="file" name="uploadedimage">

        <p> </p>
        <button class="w3-btn w3-blue-grey" type="submit">Dodaj autobus!</button>
    </form>

</div>
</body>

</html>