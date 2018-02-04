<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Post</h2>

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
            if ($title==""||$cat==""||$body==""||$tags==""||$author==""||$file_name=="") {
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
                $query = "INSERT INTO tbl_post(cat,title,body,image,author,tags,userid) VALUES ('$cat','$title','$body',
                  '$uploaded_image','$author','$tags','$userId')";
                $insert = $db->insert($query);
                if ($insert) {
                    echo "<span class='success' >Successfully Post Uploaded..!</span>";
                }
                else {
                    echo "<span class='failed' >Post Not Uploaded !! Problem Occurs..!</span>";
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
                                    <option value="<?php echo $result['id']?>"><?php echo $result['name']?></option>
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
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get('username'); ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Tags Here.." class="medium" />
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


