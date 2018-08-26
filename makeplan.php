<?php

include_once("sidebar.php");?>


<body>

<div style="padding-left: 205px;">
<?php

include_once("db_config.php");

if((@$_GET['action'] != 'edit') && !(isset($_GET['date']))) {
 echo ' <form class="w3-container" method="get" action="">
    <label class="w3-text-teal"><b>Odaberite datum plana koji želite urediti:</b></label>
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
$datum=@$_GET['date'];
 echo'<label class="w3-text-teal"><b>Uređivanje plana za datum: '.$datum.'</b></label><br/>

<a href="add_new_day.php">Kliknite ovde za dodavanje vanrednih turažnih listova za ovaj dan.</a>';
        $sql = "SELECT DISTINCT ID_Work, workplan.ID_Tour, `Name`, `ID_Driver`, ID_Bus1, Date_Work, 
workplan.Start_Time, workplan.End_Time, workplan.Total_Time 
FROM workplan JOIN tours ON workplan.ID_Tour = tours.ID_Tour WHERE Date_Work='$datum' ORDER BY `Name` ASC";

        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                echo '<form name="' . $record['ID_Work'] . '">
    <input type="text" name="Name" disabled="disabled" onchange="changeit(' . $record['ID_Work'] . ', \'Name\', this)" value="' . $record['Name'] . '">
    ';

                echo '<select name="ID_Driver" onchange="changeit(' . $record['ID_Work'] . ', \'ID_Driver\', this)" >
                <option value="' . $record['ID_Driver'] . '">' . $record['ID_Driver'] . '</option>';
                $sql23="SELECT ID_Driver, First_Name, Last_Name from drivers;";
                $result23 = mysqli_query($con,$sql23);
                if (mysqli_num_rows($result23) > 0) {
                    while ($record23 = mysqli_fetch_array($result23, MYSQLI_ASSOC)) {
                        echo ' <option value="' . $record23['ID_Driver'] . '">' . $record23['ID_Driver'] .' - '.  $record23['First_Name'] .' ' .  $record23['Last_Name'] . '</option>';
                    }
                }
                echo '
    </select>
                
                
                <select name="ID_Bus1" onchange="changeit(' . $record['ID_Work'] . ', \'ID_Bus1\', this)" >
                <option value="' . $record['ID_Bus1'] . '">' . $record['ID_Bus1'] . '</option>';
                $sql22="SELECT ID_Bus from buses;";
                $result22 = mysqli_query($con,$sql22);
                if (mysqli_num_rows($result22) > 0) {
                    while ($record22 = mysqli_fetch_array($result22, MYSQLI_ASSOC)) {
                        echo ' <option value="' . $record22['ID_Bus'] . '">' . $record22['ID_Bus'] . '</option>';
                    }
                }
                echo '
    </select>
   
    <input type="text" name="Start_Time" onchange="changeit(' . $record['ID_Work'] . ', \'Start_Time\', this)" value="' . $record['Start_Time'] . '">
    <input type="text" name="End_Time" onchange="changeit(' . $record['ID_Work'] . ', \'End_Time\', this)" value="' . $record['End_Time'] . '">
    <input type="text" name="Total_Time" onchange="changeit(' . $record['ID_Work'] . ', \'Total_Time\', this)" value="' . $record['Total_Time'] . '">
</form>';

            }
        }

}
?>
</div>

test
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>