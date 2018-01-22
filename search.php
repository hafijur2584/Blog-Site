<?php include 'inc/header.php';  ?>

<?php

if (!isset($_GET['search']) || $_GET['search'] == NULL){
    echo "<script>window.location = '404.php';</script>";
    //header("Location: 404.php");
}else{
    $search = $_GET['search'];
}

?>


    <div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php
        $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body Like '%$search%'";
        $post = $db->select($query);

        if ($post){
            while ($result = $post->fetch_assoc()){


                ?>


                <div class="samepost clear">
                    <h2><a href="post.php?id=<?php echo $result['id']; ?>"> <?php echo $result['title']; ?> </a></h2>
                    <h4><?php echo $fm->formatDate($result['date']);  ?> By <a href="#"><?php echo $result['author']; ?></a></h4>
                    <a href="#"><img src="admin/<?php echo $result['image']?>" alt="post image"/></a>
                    <?php echo $fm->textShortlen($result['body']); ?>

                    <div class="readmore clear">
                        <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>

            <?php  } }else{ ?>

            <p> Search Data Not Found....!! </p>


       <?php  } ?>


    </div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>