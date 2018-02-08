<?php

include '../lib/Session.php';
Session::checkSession();


?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php
$db = new Database();

?>
<?php
$getid = mysqli_real_escape_string($db->link, $_GET['delid']);

if (!isset($getid) || $getid == NULL){
    echo "<script>window.location = 'index.php';</script>";
    //header("Location: catlist.php");
}else{
    $delid = $getid;

    $del_query = "DELETE FROM tbl_page where id = '$delid'";
    $delData = $db->delete($del_query);
    if ($delData){
        echo "<script>alert('Page Deleted Successfully.')</script>";
        echo "<script>window.location = 'index.php';</script>";
    }else{
        echo "<script>alert('Page Not Deleted.')</script>";
        echo "<script>window.location = 'page.php';</script>";
    }
}

?>
