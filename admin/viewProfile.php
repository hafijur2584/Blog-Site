<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$getid = mysqli_real_escape_string($db->link, $_GET['viewid']);

if (!isset($getid) || $getid == NULL){
    echo "<script>window.location = 'userList.php';</script>";
    //header("Location: catlist.php");
}else{
    $viewId = $getid;
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>View User Profile</h2>

        <!--                php code for get data from input field-->



        <div class="block">
            <?php

            $query = "SELECT * FROM tbl_user WHERE id = '$viewId'";
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
                                    <input type="text" readonly name="name" value="<?php echo $result['name']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>userName</label>
                                </td>
                                <td>
                                    <input type="text" readonly name="username" value="<?php echo $result['username']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" readonly name="email" value="<?php echo $result['email']?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea readonly name="details" class="tinymce">

                                        <?php echo $result['details']?>

                                    </textarea>
                                </td>
                            </tr>



                            <tr>
                                <td></td>
                                <td>

                                    <a style="padding: 6px 26px;background: lightgrey;margin-left: 7px;" href="userList.php">Ok</a>
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


