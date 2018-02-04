<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<!--    start                code for get id from postlist page-->
<?php

if (!isset($_GET['editid']) || $_GET['editid'] == NULL){
    echo "<script>window.location = 'postlist.php';</script>";
    //header("Location: catlist.php");
}else{
    $postid = $_GET['editid'];
}

?>
<!--    end                code for get id from postlist page-->
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Post</h2>

 <!--                php code for get data from input field-->

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $fm->validation($_POST['title']);
            //$body = $fm->validation($_POST['body']);
            $author = $fm->validation($_POST['author']);
            $tags = $fm->validation($_POST['tags']);
            $cat = $_POST['cat'];
            $userId = $_POST['userid'];

            $title = mysqli_real_escape_string($db->link, $title);
            $cat = mysqli_real_escape_string($db->link, $cat);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $author = mysqli_real_escape_string($db->link, $author);
            $tags = mysqli_real_escape_string($db->link, $tags);
            $userId = mysqli_real_escape_string($db->link, $userId);

//            code for upload image


            $permitted = array('jpg', 'jpeg', 'gif', 'png');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_name_image = substr(md5(time()), 0, 10) . '.' . $file_ext;

            $uploaded_image = "upload/" . $unique_name_image;
            if ($title==""||$cat==""||$body==""||$tags==""||$author=="") {
                echo "<span class='error' >Field Must Not Be Empty..!</span>";
            }else{

            if (!empty($file_name)){

                if ($file_size > 1048567) {
                    echo "<span class='error' >Image must be less than 1 Mb..!</span>";
                }
                elseif (in_array($file_ext, $permitted) === false) {
                    echo "<span class='error' >You can only upload:-" . implode(', ', $permitted) ." File". "</span>";
                }
                else {
                    $queryy = "SELECT * FROM tbl_post WHERE id = '$postid' ORDER BY id DESC ";
                    $getPosts = $db->select($queryy);
                    if ($getPosts) {

                        while ($postResults = $getPosts->fetch_assoc()) {

                            $del_img = $postResults['image'];
                            unlink($del_img);
                        }
                    }
                    move_uploaded_file($file_tmp, $uploaded_image);
                    $query = "UPDATE tbl_post
                    SET
                    cat = '$cat',
                    title = '$title',
                    body = '$body',
                    image = '$uploaded_image',
                    author = '$author',
                    tags = '$tags',
                    userid = '$userId'
                    WHERE id ='$postid'
                    ";
                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success' >Successfully Post Updated..!</span>";
                    }
                    else {
                        echo "<span class='failed' >Post Not Updated !! Problem Occurs..!</span>";
                    }

                }
            }else{
                $query = "UPDATE tbl_post
                    SET
                    cat = '$cat',
                    title = '$title',
                    body = '$body',
                    author = '$author',
                    tags = '$tags',
                    userid = '$userId'
                    WHERE id ='$postid'
                    ";
                $update_row = $db->update($query);
                if ($update_row) {
                    echo "<span class='success' >Successfully Post Updated..!</span>";
                }
                else {
                    echo "<span class='failed' >Post Not Updated !! Problem Occurs..!</span>";
                }
            }

            }


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
                            <input type="text" name="title" value="<?php echo $postResult['title']?>" class="medium" />
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
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $postResult['image']?>" height="40px" width="100px" alt=""><br>
                            <input type="file" name="image"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea name="body" class="tinymce">

                                <?php echo $postResult['body']?>

                            </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $postResult['author']?>" class="medium" />
                            <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $postResult['tags']?>" class="medium" />
                        </td>
                    </tr>



                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
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


