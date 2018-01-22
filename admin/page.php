<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php

if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
    echo "<script>window.location = 'addpage.php';</script>";
    //header("Location: catlist.php");
}else{
    $pageid = $_GET['pageid'];
}

?>

<style>
    .delete_page{
        padding: 6px;
        background-color: #DDDDDD;
    }
    style="padding: 5px;background-color: grey;"
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Page</h2>

        <!--                php code for get data from input field-->

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $fm->validation($_POST['name']);
            //$body = $fm->validation($_POST['body']);

            $name = mysqli_real_escape_string($db->link, $name);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);


            if ($name==""||$body=="") {
                echo "<span class='error' >Field Must Not Be Empty..!</span>";
            }
            else {

                $query = "UPDATE tbl_page
                    SET 
                    name = '$name',
                    body = '$body'
                    WHERE id = '$pageid' ";
                $update = $db->update($query);
                if ($update) {
                    echo "<span class='success' >Page Updated Successfully..!</span>";
                }
                else {
                    echo "<span class='failed' >Page Not Updated !! Problem Occurs..!</span>";
                }

            }


        }
        ?>

        <div class="block">
            <?php

            $query  = "SELECT * FROM tbl_page WHERE id = '$pageid'";
            $select_page = $db->select($query);
            if ($select_page){
            while ($result = $select_page->fetch_assoc()){


            ?>
            <form action="" method="post">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea name="body" class="tinymce">
                                <?php echo $result['body']; ?>

                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                            <a class="delete_page" onclick="return confirm('Are to sure to delete Page!!');" href="delpage.php?delid=<?php echo $result['id']; ?>" name="delete">Delete Page</a>
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


