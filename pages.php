<?php include 'inc/header.php';  ?>

<?php

if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
    echo "<script>window.location = '404.php';</script>";
    //header("Location: catlist.php");
}else{
    $pageid = $_GET['pageid'];
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