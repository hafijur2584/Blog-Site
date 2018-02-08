<?php include 'inc/header.php';  ?>

<?php
$getid = mysqli_real_escape_string($db->link, $_GET['pageid']);

if (!isset($getid) || $getid == NULL){
    echo "<script>window.location = '404.php';</script>";
    //header("Location: catlist.php");
}else{
    $pageid = $getid;
}

?>

<?php

$query  = "SELECT * FROM tbl_page WHERE id = '$pageid'";
$select_page = $db->select($query);
if ($select_page){
    while ($result = $select_page->fetch_assoc()){


        ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['name']; ?></h2>

                <p><?php echo $result['body']; ?></p>


		</div>

</div>
    <?php } }else{
    header("Location: 404.php");
} ?>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>