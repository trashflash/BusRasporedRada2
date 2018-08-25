<?php
include_once ('db_config.php');
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3css.css">
    <script src="Fun.js"></script>
</head>
<body>
<?php include 'sidebar.php';?>

<div style="margin-left:200px">

    <div class="w3-container w3-teal" onclick="hideit('todayw');"> <h4>Plan rada</h4> </div>
    <div id="todayw">
        <table class="w3-table-all">
            <tr>
                <th>TURAŽNI LIST</th>
                <th>OPIS</th>
                <th>DATUM</th>
                <th>BUS</th>
                <th>POČETAK</th>
                <th>KRAJ</th>
                <th>UKUPNO VREME</th>
            </tr>
            <?php
            $sql = "SELECT *, t.name as name,t.description as descr FROM workplan w join tours t on w.id_tour=t.id_tour join drivers d on w.id_driver=d.id_driver where w.ID_Driver=0 and w.Date_Work>=current_date()";
            $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result)>0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                    echo '<tr><td>' . $record['name'] . '</td><td>' . $record['descr'] . '</td>
                        <td>' . $record['Date_Work'] . '</td><td>' . $record['ID_Bus1'] . '</td>
                        <td>' . $record['Start_Time'] . '</td><td>' . $record['End_Time'] . '</td>
                        <td>' . $record['Total_Time'] . '</td></tr>';
                }
            }
            ?>
        </table>
    </div>
    <div class="w3-container w3-teal" onclick="hideit('allwork');" > <h4>Plan rada</h4> </div>
    <div id="allwork" style="display: none">
        <table class="w3-table-all">
            <tr>
                <th>TURAŽNI LIST</th>
                <th>OPIS</th>
                <th>DATUM</th>
                <th>BUS</th>
                <th>POČETAK</th>
                <th>KRAJ</th>
                <th>UKUPNO VREME</th>
            </tr>
            <?php
            $sql = "SELECT *, t.name as name,t.description as descr FROM workplan w join tours t on w.id_tour=t.id_tour join drivers d on w.id_driver=d.id_driver where w.ID_Driver=0";
            $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result)>0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                    echo '<tr><td>' . $record['name'] . '</td><td>' . $record['descr'] . '</td>
                        <td>' . $record['Date_Work'] . '</td><td>' . $record['ID_Bus1'] . '</td>
                        <td>' . $record['Start_Time'] . '</td><td>' . $record['End_Time'] . '</td>
                        <td>' . $record['Total_Time'] . '</td></tr>';
                }
            }
            ?>
        </table>
    </div>

</div>
</body>

</html>