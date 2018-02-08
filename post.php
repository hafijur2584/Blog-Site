<?php include 'inc/header.php';  ?>

<?php
$getid = mysqli_real_escape_string($db->link, $_GET['id']);
    if (!isset($getid) || $getid == NULL){
        header("Location : 404.php");
    }else{
        $id = $getid;
    }
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

                <?php
                    $query ="SELECT * FROM tbl_post WHERE  id = $id";
                    $post = $db->select($query);
                    if ($post){
                    while ($result = $post->fetch_assoc()){
                ?>

				<h2><?php echo $result['title']?></h2>
				<h4><?php echo $fm->formatDate($result['date']);  ?> By <a href="#"><?php echo $result['author']; ?></a></h4>
                <img src="admin/<?php echo $result['image']?>" alt="post image"/>
				<p><?php echo $result['body'] ?></p>



				<div class="relatedpost clear">
					<h2>Related articles</h2>

                    <?php
                        $catid = $result['cat'];
                        $queryrelated ="SELECT * FROM tbl_post WHERE  cat = '$catid' ORDER BY rand() LIMIT 6";
                        $related_post = $db->select($queryrelated);
                        if ($related_post){
                        while ($relResult = $related_post->fetch_assoc()){
                    ?>

					<a href="post.php?id=<?php echo $relResult['id']; ?>"><img src="admin/<?php echo $relResult['image']?>" alt="post image"/></a>
					<?php
                        } }else{
                            echo "No Related Post Available.";
                        } ?>
				</div>

                    <?php
                    } } else{
                        header("Location: 404.php");
                    } ?>
	</div>

		</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>