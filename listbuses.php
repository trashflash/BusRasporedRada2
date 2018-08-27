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

    <div class="w3-container w3-teal" onclick="hideit('searchbuss');">Pretraga</div>
    <div id="searchbuss" >
    <form name="registration" action="" method="post">
        <input type="text" name="SRNUM" placeholder="Garažni broj" style="width:500px;" />
        <select class="w3-select w3-light-gray" name="optiona">
            <option value="" disabled selected>Odaberite opciju.</option>
            <option value="GRADSKI SOLO">GRADSKI SOLO</option>
            <option value="GRADSKI ZGLOBNI">GRADSKI ZGLOBNI</option>
            <option value="PRIGRADSKI">PRIGRADSKI</option>
            <option value="MEĐUGRADSKI">MEĐUGRADSKI</option>
            <option value="GRADSKI MINIBUS">GRADSKI MINIBUS</option>
            <option value="MEĐUGRADSKI MINIBUS">MEĐUGRADSKI MINIBUS</option>
            <option value="TURISTIČKI">TURISTIČKI</option>
            <option value="%i%">SVE</option>
        </select>
        <input type="submit" name="submit" value="Pretraži autobuse!" />
    </form>
    </div>

    <div class="w3-container w3-teal" style="border:#3a3a3a 1px solid;" onclick="hideit('addbuss');"> <h3>Dodaj autobus</h3> </div>
    <div id="addbuss" style="display: none;">
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

    <div class="w3-container w3-teal" onclick="hideit('busess');"> <h4>Autobusi</h4> </div>
    <div id="busess">
    <table class="w3-table-all">
        <tr>
            <th>BROJ</th>
            <th>SLIKA</th>
            <th>PODRUČJE</th>
            <th>REG. TABL.</th>
            <th>U KVARU</th>
            <th>NE IZDAVATI</th>
            <th>IZMENE</th>
        </tr>
        <?php
        if (@$_REQUEST['SRNUM']!=null) {
            $gbrsearch=@$_REQUEST['SRNUM'];

            $sql = "SELECT * FROM buses WHERE ID_Bus LIKE '$gbrsearch'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($record['Broken'] == 1) $broken = 'Da'; else $broken = 'Ne';
                    if ($record['Reserved'] == 1) $res = 'Da'; else $res = 'Ne';
                    echo '<tr><td>' . $record['ID_Bus'] . '</td><td><img src="' . $record['Photo_Link_Bus'] . '" style="height:50px"></td>
            <td>' . $record['TypeBus'] . '</td><td>' . $record['Plates'] . '</td><td>' . $broken . '</td><td>' . $res . '</td>
            <td>Edit, <a href="EditDriver.php?delbus='.$record['ID_Bus'].'" onclick="return confirm(\'Da li ste sigurni?\');">Delete</a></td></tr>';
                }
            }

            } else if(@$_REQUEST['optiona']!=null){
            $gtypesearch=@$_REQUEST['optiona'];

            $sql = "SELECT * FROM buses WHERE `TypeBus` LIKE '$gtypesearch'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($record['Broken'] == 1) $broken = 'Da'; else $broken = 'Ne';
                    if ($record['Reserved'] == 1) $res = 'Da'; else $res = 'Ne';
                    echo '<tr><td>' . $record['ID_Bus'] . '</td><td><img src="' . $record['Photo_Link_Bus'] . '" style="height:50px"></td>
            <td>' . $record['TypeBus'] . '</td><td>' . $record['Plates'] . '</td><td>' . $broken . '</td><td>' . $res . '</td>
            <td>Edit, <a href="EditDriver.php?delbus='.$record['ID_Bus'].'" onclick="return confirm(\'Da li ste sigurni?\');">Delete</a></td></tr>';
                }
            }


        }else {
            $sql = "SELECT * FROM buses";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($record['Broken'] == 1) $broken = 'Da'; else $broken = 'Ne';
                    if ($record['Reserved'] == 1) $res = 'Da'; else $res = 'Ne';
                    echo '<tr><td>' . $record['ID_Bus'] . '</td><td><img src="' . $record['Photo_Link_Bus'] . '" style="height:50px"></td>
            <td>' . $record['TypeBus'] . '</td><td>' . $record['Plates'] . '</td><td>' . $broken . '</td><td>' . $res . '</td>
            <td>Edit, <a href="EditDriver.php?delbus='.$record['ID_Bus'].'" onclick="return confirm(\'Da li ste sigurni?\');">Delete</a></td></tr>';
                }
            }
        }?>
    </table>
    </div>
</div>
</body>

</html>