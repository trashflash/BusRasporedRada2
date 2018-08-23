<?php
include("db_config.php");

?>
<?php
if (isset($_REQUEST['gbr']) ) {


    $bgnum = stripslashes($_REQUEST['gbr']);
    $bgnum = mysqli_real_escape_string($connection, $bgnum);

    $btype = stripslashes($_REQUEST['option']);
    $btype = mysqli_real_escape_string($connection, $btype);

    $bdescription = stripslashes($_REQUEST['opis']);
    $bdescription = mysqli_real_escape_string($connection, $bdescription);

    $breg = stripslashes($_REQUEST['reg']);
    $breg = mysqli_real_escape_string($connection, $breg);

    $bphoto = stripslashes($_REQUEST['uploadedimage']);
    $bphoto = mysqli_real_escape_string($connection, $bphoto);

    function GetImageExtension($imagetype)
    {
        if (empty($imagetype)) return false;

        switch ($imagetype) {

            case 'image/bmp':
                return '.bmp';
            case 'image/gif':
                return '.gif';
            case 'image/jpeg':
                return '.jpg';
            case 'image/png':
                return '.png';
            default:
                return false;
        }
    }


    if (!empty($_FILES["uploadedimage"]["name"])) {

        $file_name = $_FILES["uploadedimage"]["name"];
        $temp_name = $_FILES["uploadedimage"]["tmp_name"];
        $imgtype = $_FILES["uploadedimage"]["type"];
        $ext = GetImageExtension($imgtype);
        $imagename = date("d-m-Y") . "-" . time() . $ext;
        $target_path = "images/bus/".$imagename;

    }
    if (move_uploaded_file($_FILES["uploadedimage"]["tmp_name"], $target_path)) {
        echo "The file " . basename($_FILES["uploadedimage"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $query = "INSERT into `buses` (`ID_Bus`, `TypeBus`, `Description`, `Plates`, `Photo_Link_Bus`) 
VALUES ('$bgnum', '$btype', '$bdescription', '$breg', '$target_path')";

    $result = mysqli_query($connection, $query);

    //ispis ako je uspešno dodavanje autobusa u bazu podataka
    if ($result) {
        echo "<div class='form'>
        <h3>Uspešno ste dodali autobus!</h3>
        </div>";
    } else {

        echo mysqli_error($connection);
        echo "Greška!!";
    }
}


?>