<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>

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
            if ($title==""||$linkSlider==""||$file_name=="") {
                echo "<span class='error' >Field Must Not Be Empty..!</span>";
            }
            elseif ($file_size > 1048567) {
                echo "<span class='error' >Image must be less than 1 Mb..!</span>";
            }
            elseif (in_array($file_ext, $permitted) === false) {
                echo "<span class='error' >You can only upload:-" . implode(', ', $permitted) ." File". "</span>";
            }
            else {

                move_uploaded_file($file_tmp, $uploaded_image);
                $query = "INSERT INTO tbl_slider(link,image,title) VALUES ('$linkSlider','$uploaded_image','$title')";
                $insert = $db->insert($query);
                if ($insert) {
                    echo "<span class='success' >Successfully Slider Uploaded..!</span>";
                }
                else {
                    echo "<span class='failed' >Slider Not Uploaded !! Problem Occurs..!</span>";
                }

            }


        }
        ?>

        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label>Upload Slider Image</label>
                        </td>
                        <td>
                            <input type="file" name="image"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Link</label>
                        </td>
                        <td>
                            <input type="text" name="link"  class="medium" />
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


