<?php
include_once ('db_config.php');

@$delid=$_GET['drivers'];
if(isset($_REQUEST['driverID'])) {
    $id = stripslashes($_REQUEST['driverID']);
    $id = mysqli_real_escape_string($connection, $id);


    $fname = stripslashes($_REQUEST['driverFName']);
    $fname = mysqli_real_escape_string($connection, $fname);

    $lname = stripslashes($_REQUEST['driverLName']);
    $lname = mysqli_real_escape_string($connection, $lname);

    $pass = stripslashes($_REQUEST['password']);
    $pass = mysqli_real_escape_string($connection, $pass);

    $digit = stripslashes($_REQUEST['digitTach']);
    $digit = mysqli_real_escape_string($connection, $digit);

    $area = stripslashes($_REQUEST['area']);
    $area = mysqli_real_escape_string($connection, $area);

    $own = stripslashes($_REQUEST['ownBus']);
    $own = mysqli_real_escape_string($connection, $own);

    @$upload = $_POST['uploadedimage'];

    if (isset($_POST['uploadedimage'])) {
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
            $imagename = $id . "-" . date("d-m-Y") . "-" . time() . $ext;
            $target_path = "images/driver/" . $imagename;

        }
        if (move_uploaded_file($_FILES["uploadedimage"]["tmp_name"], $target_path)) {
            echo "The file " . basename($_FILES["uploadedimage"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
if (isset($delid)){
    $sql = "DELETE FROM drivers WHERE ID_Driver=$delid";

if (mysqli_query($connection, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}}
if($id&&$fname&&$lname){
$sql = "SELECT ID_Driver FROM drivers";
$result= mysqli_query($connection,$sql) or die(mysqli_error($connection));
if (mysqli_num_rows($result)>0) {
    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($record['ID_Driver']==$id){
            $iddrv=$id;
            break;
        }
    }
}
if(isset($iddrv)){
    $sql = "UPDATE drivers SET ID_Driver=$iddrv,First_Name='$fname',Last_Name='$lname',Password='".md5($pass)."',Digital_Tachograph=$digit,Area='$area',Bus_Own=$own,Photo_Link_Driver='$upload'
            WHERE ID_Driver=$iddrv";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}
else {
    $sql = "INSERT INTO drivers 
            VALUES ($id,'$fname','$lname','".md5($pass)."',$digit,'$area',$own,'$target_path')";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}}
?>