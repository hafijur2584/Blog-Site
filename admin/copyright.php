<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $copy = $fm->validation($_POST['copyright']);

            $copy = mysqli_real_escape_string($db->link, $copy);


            if ($copy=="") {
                echo "<span class='error' >Field Must Not Be Empty..!</span>";
            }
            else{
                $queryUpdate = "UPDATE tbl_footer
                    SET
                    note = '$copy'
                    WHERE id ='1'
                    ";
                $update_row = $db->update($queryUpdate);
                if ($update_row) {
                    echo "<span class='success' >Successfully  Updated..!</span>";
                }
                else {
                    echo "<span class='failed' >Not Updated !! Problem Occurs..!</span>";
                }
            }

        }

        ?>
                <div class="block copyblock">
                  <?php
                        $query = "SELECT * FROM tbl_footer WHERE id ='1'";
                        $select = $db->select($query);
                        if ($select){
                            while ($result = $select->fetch_assoc()){

                  ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>
