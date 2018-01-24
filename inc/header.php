<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>
<?php
$db = new Database();
$fm = new Format();

?>

<?php
//set headers to NOT cache a page
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// Date in the past
//or, if you DO want a file to cache, use:
header("Cache-Control: max-age=2592000");
//30days (60sec * 60min * 24hours * 30days)
?>

<!DOCTYPE html>
<html>
<head>
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
    <meta name="keywords" content="blog,cms blog">
    <meta name="author" content="Delowar">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                effect:'random',
                slices:10,
                animSpeed:500,
                pauseTime:5000,
                startSlide:0, //Set starting Slide (0 index)
                directionNav:false,
                directionNavHide:false, //Only show on hover
                controlNav:false, //1,2,3...
                controlNavThumbs:false, //Use thumbnails for Control Nav
                pauseOnHover:true, //Stop animation while hovering
                manualAdvance:false, //Force manual transitions
                captionOpacity:0.8, //Universal caption opacity
                beforeChange: function(){},
                afterChange: function(){},
                slideshowEnd: function(){} //Triggers after all slides have been shown
            });
        });
    </script>
</head>

<body>
<div class="headersection templete clear">

    <a href="index.php">

        <div class="logo">
            <?php
            $query = "SELECT * FROM title_slogan WHERE id ='2'";
            $select = $db->select($query);
            if ($select){
            while ($result = $select->fetch_assoc()){


            ?>
            <img src="admin/<?php echo $result['image']; ?>" alt="Logo"/>
            <h2><?php echo $result['title']; ?></h2>
            <p><?php echo $result['slogan']; ?></p>

            <?php } } ?>
        </div>

    </a>

    <div class="social clear">

     <?php
        $querySocial = "SELECT * FROM tbl_social WHERE id = '1'";
        $socialSelect = $db->select($querySocial);
        if ($socialSelect){
            while ($socialResult = $socialSelect->fetch_assoc()){


     ?>
        <div class="icon clear">
            <a href="<?php echo $socialResult['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="<?php echo $socialResult['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="<?php echo $socialResult['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="<?php echo $socialResult['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
        </div>
        <?php  } } ?>

        <div class="searchbtn clear">
            <form action="search.php" method="get">
                <input type="text" name="search" placeholder="Search keyword..."/>
                <input type="submit" name="submit" value="Search"/>
            </form>
        </div>
    </div>
</div>
<div class="navsection templete">
    <ul>
        <li><a id="active" href="index.php">Home</a></li>
        <?php

        $query  = "SELECT * FROM tbl_page";
        $select_page = $db->select($query);
        if ($select_page){
            while ($result = $select_page->fetch_assoc()){


                ?>
                <li><a href="pages.php?pageid=<?php echo $result['id']?>"><?php echo $result['name']?></a> </li>
            <?php  } } ?>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</div>