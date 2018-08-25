


<body>

<div>
<?php

include_once("db_config.php");
if((@$_GET['action'] == 'edit') && isset($_GET['id'])) {
$datum=@$_GET['id'];

    $sql="SELECT ID_Work, ID_Tour, ID_Driver, ID_Bus1, Date_Work, Start_Time, End_Time, Total_Time FROM workplan
WHERE Date_Work='$datum'";
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {



                echo '<form name="'. $record['ID_Work'] .'">
   <div onchange="changeit('. $record['ID_Work'] .', \'ID_Tour\', this)"> <input type="text" name="ID_Tour" value="'. $record['ID_Tour'] .'"> </div>
   <div onchange="changeit('. $record['ID_Work'] .', \'ID_Driver\', this)"> <input type="text" name="ID_Driver" value="'. $record['ID_Driver'] .'"> </div>
   <div onchange="changeit('. $record['ID_Work'] .', \'ID_Bus1\', this)"> <input type="text" name="ID_Bus1" value="'. $record['ID_Bus1'] .'"> </div>
   <div onchange="changeit('. $record['ID_Work'] .', \'Start_Time\', this)"> <input type="text" name="Start_Time" value="'. $record['Start_Time'] .'"> </div>
   <div onchange="changeit('. $record['ID_Work'] .', \'End_Time\', this)"> <input type="text" name="End_Time" value="'. $record['End_Time'] .'"> </div>
   <div onchange="changeit('. $record['ID_Work'] .', \'Total_Time\', this)"> <input type="text" name="Total_Time" value="'. $record['Total_Time'] .'"> </div>
</form><br/>';

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