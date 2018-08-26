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
        <h2>Promeni lozinku</h2>
    </div>
    <?php
    echo 'your user id is:'.@$_SESSION['UserID'];
    if(isset($_SESSION['ISAdmin'])){
if(($_SESSION['ISAdmin']==111)){
    echo' <form class="w3-container"  action="" method="post">
        

        <label class="w3-text-teal"><b>Promena lozinke admin:</b></label>
        <input class="w3-input w3-border w3-light-grey" name="auserpw" type="hidden" value="'.@$_SESSION['username'].'">
        </select>

        <label class="w3-text-teal"><b>Nova Lozinka</b></label>
        <input class="w3-input w3-border w3-light-grey" name="apass1" type="password">

        <label class="w3-text-teal"><b>Nova Lozinka - ponovo</b></label>
        <input class="w3-input w3-border w3-light-grey" name="apass2" type="password">

        <p> </p>
        <button class="w3-btn w3-blue-grey">Dodaj autobus!</button>
    </form>';}}else{
    echo' <form class="w3-container" action="" method="post">
        

        <label class="w3-text-teal"><b>Promena lozinke:</b></label>
        <input class="w3-input w3-border w3-light-grey" name="userpw" type="hidden" value="'.@$_SESSION['UserID'].'">
        </select>

        <label class="w3-text-teal"><b>Nova Lozinka</b></label>
        <input class="w3-input w3-border w3-light-grey" name="pass1" type="password">

        <label class="w3-text-teal"><b>Nova Lozinka - ponovo</b></label>
        <input class="w3-input w3-border w3-light-grey" name="pass2" type="password">

        <p> </p>
        <button class="w3-btn w3-blue-grey">Dodaj autobus!</button>
    </form>';

    }


    if (@isset($_REQUEST['pass1'])) {
        $userpw = stripslashes($_REQUEST['userpw']);
        $userpw = mysqli_real_escape_string($connection, $userpw);
        $pass1 = stripslashes($_REQUEST['pass1']);
        $pass2 = mysqli_real_escape_string($connection, $pass1);
        $pass2 = stripslashes($_REQUEST['pass2']);
        $pass2 = mysqli_real_escape_string($connection, $pass2);
        if ($pass1 == $pass2)
            $query = "UPDATE `drivers` SET Password='".md5($pass2)."' where ID_Driver=$userpw";
        @$result = mysqli_query($connection, $query);
        if (@$result) {
            echo "<div class='form'>
        <h3>Vaša lozinka je uspešno izmenjena!</h3>
        </div>";
        }
    }



    if (@isset($_REQUEST['apass1'])) {
        $auserpw = stripslashes($_REQUEST['auserpw']);
        $auserpw = mysqli_real_escape_string($connection, $auserpw);
        $apass1 = stripslashes($_REQUEST['apass1']);
        $apass1 = mysqli_real_escape_string($connection, $apass1);
        $apass2 = stripslashes($_REQUEST['apass2']);
        $apass2 = mysqli_real_escape_string($connection, $apass2);
        if ($apass1 == $apass2)
            $query = "UPDATE `admins` SET Password='".md5($apass2)."' where Username='$auserpw'";
        @$result = mysqli_query($connection, $query);
        if (@$result) {
            echo "<div class='form'>
        <h3>Vaša lozinka je uspešno izmenjena!</h3>
        </div>";
        }
    }
    ?>

</div>
</body>

</html>