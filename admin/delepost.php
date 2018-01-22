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

if (!isset($_GET['delid']) || $_GET['delid'] == NULL){
    echo "<script>window.location = 'postlist.php';</script>";
    //header("Location: catlist.php");
}else{
    $delid = $_GET['delid'];

    $query = "SELECT * FROM tbl_post WHERE id = '$delid'";
    $getData  = $db->select($query);
    if ($getData){
        while ($del_img = $getData->fetch_assoc()){
            $img_link = $del_img['image'];
            unlink($img_link);
        }
    }
    $del_query = "DELETE FROM tbl_post where id = '$delid'";
    $delData = $db->delete($del_query);
    if ($delData){
        echo "<script>alert('Data Deleted Successfully.')</script>";
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        echo "<script>alert('Data Not Deleted.')</script>";
        echo "<script>window.location = 'postlist.php';</script>";
    }
}

?>
