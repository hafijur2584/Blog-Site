<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$getid = mysqli_real_escape_string($db->link, $_GET['msgId']);

if (!isset($getid) || $getid == NULL){
    echo "<script>window.location = 'inbox.php';</script>";

}else{
    $id = $getid;
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $to = $fm->validation($_POST['toEmail']);
            $from = $fm->validation($_POST['fromEmail']);
            $subject = $fm->validation($_POST['subject']);

            $to = mysqli_real_escape_string($db->link, $to);
            $from = mysqli_real_escape_string($db->link, $from);
            $subject = mysqli_real_escape_string($db->link, $subject);
            $message = mysqli_real_escape_string($db->link,$_POST['message']);
            $send = mail($to,$subject,$message,$from);
            if ($send){
                echo "<span class='success' >Successfully Mail Send..!</span>";
            }else{
                echo "<span class='error' >Mail Not Send. Problem Occured!</span>";
            }
        }
        ?>




        <div class="block">
            <form action="" method="post">
                <?php
                $query = "SELECT * FROM tbl_contact WHERE id = '$id'";
                $select = $db->select($query);
                if ($select){
                    while ($result = $select->fetch_assoc()){


                        ?>

                        <table class="form">

                            <tr>
                                <td>
                                    <label>To</label>
                                </td>
                                <td>
                                    <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>From</label>
                                </td>
                                <td>
                                    <input type="text" name="fromEmail" placeholder="Enter your email" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Subject</label>
                                </td>
                                <td>
                                    <input type="text" name="subject" placeholder="Enter your subject" class="medium" />
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>Message</label>
                                </td>
                                <td>
                            <textarea name="message" readonly class="tinymce">

                            </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Send" />
                                </td>
                            </tr>
                        </table>
                    <?php } } ?>
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


