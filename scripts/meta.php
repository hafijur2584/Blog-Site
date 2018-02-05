<?php
if (isset($_GET['pageid'])){
    $pageTitleId = $_GET['pageid'];
    $query  = "SELECT * FROM tbl_page WHERE id = '$pageTitleId'";
    $select_page = $db->select($query);
    if ($select_page){
        while ($result = $select_page->fetch_assoc()) { ?>

            <title><?php echo $result['name']; ?> - <?php echo TITLE; ?></title>

        <?php    } }


}
elseif (isset($_GET['id'])){
    $postTitleId = $_GET['id'];
    $query  = "SELECT * FROM tbl_post WHERE id = '$postTitleId'";
    $select_post = $db->select($query);
    if ($select_post){
        while ($result = $select_post->fetch_assoc()) { ?>

            <title><?php echo $result['title']; ?> - <?php echo TITLE; ?></title>

        <?php    } }


}
else{ ?>
    <title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>
    <?php

} ?>


<meta name="language" content="English">
<meta name="description" content="It is a website about education">
<?php
if(isset($_GET['id'])){
    $keywordId = $_GET['id'];
    $query  = "SELECT * FROM tbl_post WHERE id = '$keywordId'";
    $keywords = $db->select($query);
    if ($keywords){
        while ($result=$keywords->fetch_assoc()){ ?>
            <meta name="keywords" content="<?php echo $result['tags']; ?>">
        <?php          } } }else{ ?>
    <meta name="keywords" content="<?php echo KEYWORDS; ?>">
    <?php
}

?>
<meta name="author" content="Hafijur">