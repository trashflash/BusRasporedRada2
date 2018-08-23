<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../tabela1.css" />

    <link rel="stylesheet" href="../cssa.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body>
<?php
require('../db_config.php');
include("../menuadmin.php");
include("../auth2.php");
//Proveravanje da li je korisnik loginovan kao admin.
$amIAdmin=0;
@$amIAdmin=@$_SESSION['isadmin'];
if(($amIAdmin==1)){
?>


    <?php
    //IZMENA FILMOVA
    if (isset($_REQUEST['filmedit1'])){
        // Brisanje karaktera koji mogu ugroziti bazu podataka.
        //$f... film name, description, actors,...
        @$fname = stripslashes($_REQUEST['FName']);
        //takodje.
        @$fname = mysqli_real_escape_string($con,$fname);
        @$fdescription = stripslashes($_REQUEST['FDescription']);
        @$fdescription = mysqli_real_escape_string($con,$fdescription);
        //ne koristi se:
        @$trn_date = date("Y-m-d H:i:s");

        @$factors = stripslashes($_REQUEST['FActors']);
        @$factors = mysqli_real_escape_string($con,$factors);

        @$fgenre = stripslashes($_REQUEST['FGenre']);
        @$fgenre = mysqli_real_escape_string($con,$fgenre);


        @$fyear = stripslashes($_REQUEST['FYear']);
        @$fyear = mysqli_real_escape_string($con,$fyear);

        @$f3d = stripslashes($_REQUEST['F3d']);
        @$f3d = mysqli_real_escape_string($con,$f3d);

        @$fimage = stripslashes($_REQUEST['FImage']);
        @$fimage = mysqli_real_escape_string($con,$fimage);

        $filmid=($_REQUEST['FilmID']);

        //pristup bazi podataka


        $query = "UPDATE `films` SET FName='$fname', FDescription='$fdescription', FActors='$factors', FGenre='$fgenre', F3D='$f3d' WHERE FilmID=$filmid";

        $result = mysqli_query($con,$query);
        //ispis ako je uspesno updateovanje filma u bazu podataka
        if($result){
            echo "<div class='form'>
        <h3>Uspešno ste uredili film! <a href='../index.php'>Povratak na glavnu stranicu.</a></h3>
        <br/> <a href='dodajfilm.php'>Kliknite ovde da dodate/menjate još filmova.</a></div>";
        }
        }

        //DODAVANJE FILMOVA
    // Ako je forma poslata, dodavanje u bazu podataka
    if (isset($_REQUEST['FName']) AND !(isset($_REQUEST['filmedit1'])) ){
        // Brisanje karaktera koji mogu ugroziti bazu podataka.
        //$f... film name, description, actors,...
        $fname = stripslashes($_REQUEST['FName']);
        //takodje.
        $fname = mysqli_real_escape_string($con,$fname);
        $fdescription = stripslashes($_REQUEST['FDescription']);
        $fdescription = mysqli_real_escape_string($con,$fdescription);
        //ne koristi se:
        $trn_date = date("Y-m-d H:i:s");

        $factors = stripslashes($_REQUEST['FActors']);
        $factors = mysqli_real_escape_string($con,$factors);

        $fgenre = stripslashes($_REQUEST['FGenre']);
        $fgenre = mysqli_real_escape_string($con,$fgenre);


        $fyear = stripslashes($_REQUEST['FYear']);
        $fyear = mysqli_real_escape_string($con,$fyear);

        $f3d = stripslashes($_REQUEST['F3d']);
        $f3d = mysqli_real_escape_string($con,$f3d);

        $fimage = stripslashes($_REQUEST['FImage']);
        $fimage = mysqli_real_escape_string($con,$fimage);

        //pristup bazi podataka
        $query = "INSERT into `films` (FName, FDescription, FActors, FGenre, FYear, F3D, FImage )
    VALUES ('$fname', '$fdescription', '$factors', '$fgenre', '$fyear', '$f3d', '$fimage')";

        $result = mysqli_query($con,$query);
        //ispis ako je uspešno dodavanje filma u bazu podataka
        if($result){
            echo "<div class='form'>
        <h3>Uspešno ste dodali film! <a href='index.php'>Povratak na glavnu stranicu.</a></h3>
        <br/> <a href='dodajfilm.php'>Kliknite ovde da dodate još filmova.</a></div>";
        }
    }else{
        // u suprotnom se forma ponovno pojavljuje.
        ?>
        <div class="form">
            <h1>Dodaj film</h1>
            <form name="registration" action="" method="post">
                <input type="text" name="FName" placeholder="Naziv filma" style="width:500px;" required />
                <input type="textarea" name="FDescription" placeholder="Opis" style="width:500px;height:300px;" required />
                <input type="text" name="FActors" placeholder="Glumci" style="width:500px;" required />
                <input type="text" name="FGenre" placeholder="Žanr" style="width:500px;" required />
                <input type="text" name="FYear" placeholder="Godina" style="width:500px;" required />
                <input type="text" name="F3D" placeholder="3D 0/1" style="width:500px;" required />
                <input type="text" name="FImage" placeholder="img link" style="width:500px;" required />
                <input type="submit" name="submit" value="Dodaj film!" />
            </form>
        </div>
        <?php
        echo '<h2>IZMENA FILMLOVA</h2>';
        if((@$_GET['action'] == 'edit') && isset($_GET['id'])) {
            // Ako se traži brisanje i postoji ID onda briše:
            @$idtoedit=$_GET['id'];
            $sql = "SELECT `FilmID`, `FName`, `FDescription`, `FActors`, `FGenre`, `FYear`, `F3D`, `FImage`, `AddedOn` FROM `films` WHERE FilmID=$idtoedit order by `AddedOn` desc limit 100";

            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row, dodaje stvari u formu za izmenu filma!
                while($row = $result->fetch_assoc()) {

                    echo '
            <form name="registration" action="" method="post">
                <input type="hidden" name="FilmID" value="'.$row["FilmID"].'">
                <input type="text" name="FName" value="'.$row["FName"].'" placeholder="Naziv filma" style="width:500px;" required />
                <input type="textarea" name="FDescription" value="'.$row["FDescription"].'" placeholder="Opis" style="width:500px;height:300px;" required />
                <input type="text" name="FActors" value="'.$row["FActors"].'" placeholder="Glumci" style="width:500px;" required />
                <input type="text" name="FGenre" value="'.$row["FGenre"].'" placeholder="Žanr" style="width:500px;" required />
                <input type="text" name="FYear" value="'.$row["FYear"].'" placeholder="Godina" style="width:500px;" required />
                <input type="text" name="F3D" value="'.$row["F3D"].'" placeholder="3D 0/1" style="width:500px;" required />
                <input type="text" name="FImage" value="'.$row["FImage"].'" placeholder="img link" style="width:500px;" required />
                <input type="hidden" name="filmedit1" value="edit" />
                <input type="submit" name="submit" value="Izmeni film!" />
            </form> ';
                }}
        }
        ?>
        <h1>BRISANJE FILMOVA </h1>

        <?php
        //BRISANJE FILMOVA
        // ODABIR FILMOVA
        $sql = "SELECT `FilmID`, `FName`, `FDescription`, `FActors`, `FGenre`, `FYear`, `F3D`, `FImage`, `AddedOn` FROM `films` order by `AddedOn` desc limit 100";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $IDFilmDel=$row["FilmID"];
                echo '<table class="tabelafilmova">
<tr><td rowspan="7" class="tabimg"><img src="../images/'.$row["FImage"].'" class="imgfilm" alt="Slikafilm"/></td>
<td class="naziv">'.$row["FName"].'</td></tr>
<tr><td class="zanr">'.$row["FGenre"].'</td></tr>
<tr><td class="godina">'.$row["FYear"].'</td></tr>
<tr><td class="opis">'.$row["FDescription"].'</td></tr>
<tr><td class="glumci">'.$row["FActors"].'</td></tr>
<tr><td class="delete"><a href="dodajfilm.php?action=delete&id='.$IDFilmDel.'">OBRIŠI FILM!!!</a>  <a href="dodajfilm.php?action=edit&id='.$IDFilmDel.'">IZMENI FILM!!!</a></td></tr>
</table>';
            }
        } else {
            echo "No films.";
        }

        if((@$_GET['action'] == 'delete') && isset($_GET['id'])) {
            // Ako se traži brisanje i postoji ID onda briše:

            @$idtodelete=$_GET['id'];
            $sqlaaa = "DELETE from `films` WHERE `FilmID`=$idtodelete";

            $result = mysqli_query($con,$sqlaaa);
            if($result){

                echo 'Film je obrisan!';

            }

        }
        ?>


    <?php } ;} else {
    //ukoliko nije administrator ovo se ispisuje
    echo "Nemate pristupa.";}?>



</body>
</html>