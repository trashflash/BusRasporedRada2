<body>
<?php
include_once ('sidebar.php');
include_once ('db_config.php');
?>
    <div style="padding-left:205px;">
    <?php
    if((@$_GET['action'] != 'edit') && !(isset($_GET['date']))) {
    echo ' <form class="w3-container" method="get" action="">
    <label class="w3-text-teal"><b>Odaberite datum plana koji želite pogledati:</b></label>
    <input type="hidden" name="action" value="edit"/>
    <select class="w3-select w3-border w3-light-gray" name="date">
        <option value="" disabled selected>Odaberite opciju.</option>';
        $sqldate="SELECT DISTINCT Date_Work from workplan ORDER BY Date_Work DESC";
        $result = mysqli_query($con, $sqldate);
        if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '      <option value="' . $record['Date_Work'] . '">' . $record['Date_Work'] . '</option>';}
        echo'
    </select>
    <input type="submit" value="submit"/>
</form>
    ';
    }
    }

    if((@$_GET['action'] == 'edit') && isset($_GET['date'])) {
        ?>


        <?php
        $dateshow = $_GET['date'];

        $sqlo = "SELECT OrderText from orders WHERE OrderDate='$dateshow'";
        $result = mysqli_query($con, $sqlo);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                echo ' <div class="w3-panel w3-red w3-card-4">
 <h4>Naređenja:</h4>
  <p> ' . $record['OrderText'].'</p>
</div>';


            }
        } else {
            echo ' <div class="w3-panel w3-red w3-card-4">
 <h4>Naređenja:</h4>
  <p>Nema.</p>
</div>';
        }

        ?>

        <?php
        $dateshow = $_GET['date'];
        $reasonb="BOLOVANJE";
        $reasong="GOD";
        echo' <div class="w3-bar w3-aqua">
 
 <div class="w3-bar-item">SLOBODNI:</div>';
        $sqlad = "SELECT  *
FROM    drivers
WHERE   NOT EXISTS
        (
        SELECT  NULL
        FROM    workplan w
        WHERE   w.ID_Driver = drivers.ID_Driver AND Date_Work='$dateshow'
        ) AND NOT EXISTS ( SELECT * from absences WHERE Reason LIKE 'GOD%' AND ToDate>'$dateshow' AND FromDate<='$dateshow' )
        AND NOT EXISTS ( SELECT * from absences WHERE Reason='$reasonb' AND ToDate>'$dateshow' AND FromDate<='$dateshow' )";
        $result = mysqli_query($con, $sqlad);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                echo '<div class="w3-bar-item">'. $record['ID_Driver'].'</div>
';

            }
            echo '</div> ';} else {
            echo '</div>';
        }


        echo' <div class="w3-bar w3-light-blue">
 <div class="w3-bar-item">GODIŠNJI:</div>';
        $sqlac = "SELECT * from absences WHERE Reason LIKE 'GOD%' AND ToDate>'$dateshow' AND FromDate<='$dateshow'";
        $result = mysqli_query($con, $sqlac);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                echo '<div class="w3-bar-item">'. $record['ID_Driver'].'</div>
';

            }
            echo '</div> ';} else {
            echo '</div>';
        }

        echo' <div class="w3-bar w3-cyan">
 <div class="w3-bar-item">BOLOVANJA:</div>';
        $sqlab = "SELECT * from absences WHERE Reason='$reasonb' AND ToDate>'$dateshow' AND FromDate<='$dateshow'";
        $result = mysqli_query($con, $sqlab);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                echo '<div class="w3-bar-item">'. $record['ID_Driver'].'</div>
';

            }
            echo '</div> ';} else {
            echo '</div>';
        }



        ?>



        <?php

        $sql = "SELECT DISTINCT(workplan.ID_Tour),tours.`Name` as Namea, workplan.Start_Time as starttime, workplan.End_Time as endtime, workplan.ID_Driver as driver, workplan.ID_Bus1 as bus, workplan.Total_Time as total from workplan JOIN tours on workplan.ID_Tour = tours.ID_Tour where workplan.Date_Work='$dateshow' ORDER BY tours.`Name`";
        $i = 0;
        $result = mysqli_query($con, $sql);

        echo '<table class="w3-table-all" style="font-size: 12px;"><tr>';

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $strName1 = $record['Namea'];
                $strName1 = substr($strName1, 0, strpos($strName1, '/'));
                if ($i != $strName1) {
                    echo '</tr><tr>';
                    $i = $strName1;
                }

                echo '<td>
<div class="ispis">TL:    ' . $record['Namea'] . '</div>
<div class="ispis">Vozač: ' . $record['driver'] . '</div>
<div class="ispis">Bus:   ' . $record['bus'] . '</div>
<div class="ispis">Početak:' . $record['starttime'] . '</div>
<div class="ispis">Kraj:   ' . $record['endtime'] . '</div>
<div class="ispis">Ukupno: ' . $record['endtime'] . '</div>
</td>';
            }

        }
    }
        echo '</tr></table></div>';
    ?></div></body>