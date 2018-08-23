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

    <form class="w3-container">
        <label class="w3-text-teal"><b>Garažni broj:</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text">

        <label class="w3-text-teal"><b>Vrsta</b></label>
        <select class="w3-select w3-light-gray" name="option">
            <option value="" disabled selected>Odaberite opciju.</option>
            <option value="1">GRADSKI SOLO</option>
            <option value="2">GRADSKI ZGLOBNI</option>
            <option value="3">PRIGRADSKI</option>
            <option value="4">MEĐUGRADSKI</option>
            <option value="5">GRADSKI MINIBUS</option>
            <option value="6">MEĐUGRADSKI MINIBUS</option>
            <option value="7">TURISTIČKI</option>
        </select>

        <label class="w3-text-teal"><b>Opis</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text">

        <label class="w3-text-teal"><b>Registarske tablice</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text">

        <label class="w3-text-teal"><b>Slika</b></label>
        <input class="w3-input w3-border w3-light-grey" type="file">

        <p> </p>
        <button class="w3-btn w3-blue-grey">Dodaj autobus!</button>
    </form>

</div>
</body>

</html>