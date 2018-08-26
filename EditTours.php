<?php
include_once ('db_config.php');


if (isset($_REQUEST['tourID']) ) {

    $id = stripslashes($_REQUEST['tourID']);
    $id = mysqli_real_escape_string($connection, $id);


    $name = stripslashes($_REQUEST['Name']);
    $name = mysqli_real_escape_string($connection, $name);


    $desc = stripslashes($_REQUEST['Desc']);
    $desc = mysqli_real_escape_string($connection, $desc);

    $start = stripslashes($_REQUEST['Start']);
    $start = mysqli_real_escape_string($connection, $start);

    $end = stripslashes($_REQUEST['End']);
    $end = mysqli_real_escape_string($connection, $end);

    $total = stripslashes($_REQUEST['Total']);
    $total = mysqli_real_escape_string($connection, $total);

    $typet = stripslashes($_REQUEST['TypeT']);
    $typet = mysqli_real_escape_string($connection, $typet);

    $typed = stripslashes($_REQUEST['TypeD']);
    $typed = mysqli_real_escape_string($connection, $typed);

}

@$delid=$_GET['tours'];

@$upload=$_POST['uploadedimage'];


    function GetImageExtension($imagetype)
    {
        if (empty($imagetype)) return false;

        switch ($imagetype) {

            case 'image/bmp':
                return '.bmp';
            case 'text/pdf':
                return '.pdf';
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
        $target_path = "images/tl/".$imagename;

    }
    if (move_uploaded_file(@$_FILES["uploadedimage"]["tmp_name"], @$target_path)) {
        echo "The file " . basename(@$_FILES["uploadedimage"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }



if (isset($delid)){
    $sql = "DELETE FROM tours WHERE ID_Tour=$delid";

    if (mysqli_query($connection, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }}
if(isset($name)){
    $sql = "SELECT ID_Tour FROM tours";
    $result= mysqli_query($connection,$sql) or die(mysqli_error($connection));
    if (mysqli_num_rows($result)>0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if ($record['ID_Tour']==$id){
                $idt=$id;
                break;
            }
        }
    }
    if(isset($idt)){
        $sql = "UPDATE tours SET ID_Tour=$idt,`Name`='$name',Description='$desc',Start_Time='$start',End_Time='$end',Total_Time='$total',Type_Tour=$typet,Type_Day=$typed,
            WHERE ID_Tour=$idt";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }
    else {
        $sql = "INSERT INTO tours 
            VALUES ($id,'$name','$desc','$start','$end','$total',$typet,$typed,'$target_path')";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }}

//exit();