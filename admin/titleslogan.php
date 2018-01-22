<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<style>
    .leftSide{
        float:left;
        width: 70%;
    }
    .rightSide{
        float: left;
        width: 20%;
    }
    .rightSide img{
        height: 160px;
        width: 170px;
    }
    .rightSide h4{
        text-align: center;
    }

</style>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>


                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $title = $fm->validation($_POST['title']);
                    $slogan = $fm->validation($_POST['slogan']);

                    $title = mysqli_real_escape_string($db->link, $title);
                    $slogan = mysqli_real_escape_string($db->link, $slogan);

//            code for upload image


                    $permitted = array('png');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_name_image = substr(md5(time()), 0, 10) . '.' . $file_ext;

                    $uploaded_image = "upload/" . $unique_name_image;
                    if ($title==""||$slogan=="") {
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
                                $queryy = "SELECT * FROM title_slogan WHERE id = '2' ";
                                $getPosts = $db->select($queryy);
                                if ($getPosts) {

                                    while ($postResults = $getPosts->fetch_assoc()) {

                                        $del_img = $postResults['image'];
                                        unlink($del_img);
                                    }
                                }
                                move_uploaded_file($file_tmp, $uploaded_image);
                                $query = "UPDATE title_slogan
                    SET
                    title = '$title',
                    slogan = '$slogan',
                    image = '$uploaded_image'
                    WHERE id ='2'
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
                            $query = "UPDATE title_slogan
                    SET
                    title = '$title',
                    slogan = '$slogan'
                    WHERE id ='2'
                    ";
                            $update_row = $db->update($query);
                            if ($update_row) {
                                echo "<span class='success' >Successfully  Updated..!</span>";
                            }
                            else {
                                echo "<span class='failed' >Not Updated !! Problem Occurs..!</span>";
                            }
                        }

                    }


                }
                ?>



                <?php

                $query  = "SELECT * FROM title_slogan WHERE id = '2'";
                $select = $db->select($query);
                if ($select){
                while ($result = $select->fetch_assoc()){


                ?>
                <div class="block sloginblock">

                 <div class="leftSide">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'] ?>" name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan'] ?>" name="slogan" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    </div>

                    <div class="rightSide">
                        <h4>Logo</h4><br>
                        <img src="<?php echo $result['image'] ?>" alt="l">

                    </div>

                </div>
                <?php  } } ?>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>
