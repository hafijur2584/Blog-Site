<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<!--    start                code for get id from postlist page-->
<?php
$getid = mysqli_real_escape_string($db->link, $_GET['viewPost']);

if (!isset($getid) || $getid == NULL){
    echo "<script>window.location = 'postlist.php';</script>";
    //header("Location: catlist.php");
}else{
    $postid = $getid;
}

?>
<!--    end                code for get id from postlist page-->
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Post</h2>

        <!--                php code for get data from input field-->

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'postlist.php';</script>";

        }
        ?>

        <div class="block">
            <?php

            $query = "SELECT * FROM tbl_post WHERE id = '$postid' ORDER BY id DESC ";
            $getPost = $db->select($query);
            if ($getPost){

                while ($postResult = $getPost->fetch_assoc()){



                    ?>


                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input readonly type="text" value="<?php echo $postResult['title']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
                                        <option value="">Select Category</option>

                                        <!--          start                          php code for show category from category table-->

                                        <?php
                                        $query = "SELECT * FROM tbl_category";
                                        $category = $db->select($query);
                                        if ($category){
                                            $i =0;
                                            while ($result = $category->fetch_assoc()){
                                                $i++;
                                                ?>


                                                <option
                                                    <?php
                                                    if ($postResult['cat'] == $result['id']){ ?>

                                                        selected = "selected"

                                                    <?php   } ?>

                                                    value="<?php echo $result['id']?>"><?php echo $result['name']?></option>
                                            <?php } } ?>


                                        <!--    end                           php code for show category from category table-->
                                    </select>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label> Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $postResult['image']?>" height="40px" width="100px" alt=""><br>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                            <textarea readonly name="body" class="tinymce">

                                <?php echo $postResult['body']?>

                            </textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input readonly type="text" value="<?php echo $postResult['author']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input readonly type="text" value="<?php echo $postResult['tags']?>" class="medium" />
                                </td>
                            </tr>



                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="ok" />
                                </td>
                            </tr>
                        </table>
                    </form>

                <?php } } ?>
        </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include 'inc/footer.php'; ?>


