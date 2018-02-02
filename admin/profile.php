<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    $userId = Session::get('userId');
    $userRole = Session::get('userRole');
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User Profile</h2>

        <!--                php code for get data from input field-->

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name= $fm->validation($_POST['name']);
            $username= $fm->validation($_POST['username']);
            $email= $fm->validation($_POST['email']);
            $details= $fm->validation($_POST['details']);

            $name = mysqli_real_escape_string($db->link, $name);
            $username = mysqli_real_escape_string($db->link, $username);
            $details = mysqli_real_escape_string($db->link, $details);
            $email = mysqli_real_escape_string($db->link, $email);

                    $query = "UPDATE tbl_user
                    SET
                    name = '$name',
                    username = '$username',
                    email = '$email',
                    details = '$details'
                    WHERE id ='$userId'
                    ";
                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success' >Successfully Profile Updated..!</span>";
                    }
                    else {
                        echo "<span class='failed' >Profile Not Updated !! Problem Occurs..!</span>";
                    }



        }
        ?>

        <div class="block">
            <?php

            $query = "SELECT * FROM tbl_user WHERE id = '$userId' AND role = '$userRole'";
            $getUser = $db->select($query);
            if ($getUser){

                while ($result = $getUser->fetch_assoc()){



                    ?>


                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>userName</label>
                                </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $result['username']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea name="details" class="tinymce">

                                        <?php echo $result['details']?>

                                    </textarea>
                                </td>
                            </tr>



                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                    <a style="padding: 6px 26px;background: lightgrey;margin-left: 7px;" href="index.php">Ok</a>
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


