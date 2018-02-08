<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<!--    start                code for get id from postlist page-->
<?php
$getid = mysqli_real_escape_string($db->link, $_GET['editid']);

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
        <h2>Edit Slider</h2>

        <!--                php code for get data from input field-->

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $fm->validation($_POST['title']);
            $linkSlider = $fm->validation($_POST['link']);

            $title = mysqli_real_escape_string($db->link, $title);
            $linkSlider = mysqli_real_escape_string($db->link, $linkSlider);



//            code for upload image


            $permitted = array('jpg', 'jpeg', 'gif', 'png');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_name_image = substr(md5(time()), 0, 10) . '.' . $file_ext;

            $uploaded_image = "upload/slider/" . $unique_name_image;
            if ($title==""||$linkSlider=="") {
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
                        $queryy = "SELECT * FROM tbl_slider WHERE id = '$postid' ORDER BY id DESC ";
                        $getPosts = $db->select($queryy);
                        if ($getPosts) {

                            while ($postResults = $getPosts->fetch_assoc()) {

                                $del_img = $postResults['image'];
                                unlink($del_img);
                            }
                        }
                        move_uploaded_file($file_tmp, $uploaded_image);
                        $query = "UPDATE tbl_slider
                    SET
                    link = '$linkSlider',
                    title = '$title',
                    image = '$uploaded_image'
                    WHERE id ='$postid'
                    ";
                        $update_row = $db->update($query);
                        if ($update_row) {
                            echo "<span class='success' >Successfully Slider Updated..!</span>";
                        }
                        else {
                            echo "<span class='failed' >Slider Not Updated !! Problem Occurs..!</span>";
                        }

                    }
                }else{
                    $query = "UPDATE tbl_slider
                    SET
                    link = '$linkSlider',
                    title = '$title'
                    WHERE id ='$postid'
                    ";
                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success' >Successfully Slider Updated..!</span>";
                    }
                    else {
                        echo "<span class='failed' >Slider Not Updated !! Problem Occurs..!</span>";
                    }
                }

            }


        }
        ?>

        <div class="block">
            <?php

            $query = "SELECT * FROM tbl_slider WHERE id = '$postid' ORDER BY id DESC ";
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
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $postResult['image']?>" height="40px" width="100px" alt=""><br>
                                    <input type="file" name="image"/>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Link</label>
                                </td>
                                <td>
                                    <input type="text" name="link" value="<?php echo $postResult['link']?>" class="medium" />
                                </td>
                            </tr>



                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="update" />
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


