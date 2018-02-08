<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    $userId = Session::get('userId');
    $userRole = Session::get('userRole');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Password</h2>
                <div class="block">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $oldPass = $fm->validation($_POST['oldPass']);
                            $oldPass = md5($oldPass);
                            $newPass = $fm->validation($_POST['newPass']);
                            $newPass = md5($newPass);

                            $oldPass = mysqli_real_escape_string($db->link,$oldPass);
                            $newPass = mysqli_real_escape_string($db->link,$newPass);

                            $changePass = "SELECT * FROM tbl_user WHERE id = '$userId' LIMIT 1";
                            $passCheck = $db->select($changePass);
                            if($passCheck != false){
                                while ($value = $passCheck->fetch_assoc()){
                                    $userid = $value['id'];
                                    $username = $value['username'];
                                    $oldPassword = $value['password'];
                                    if ($oldPassword != $oldPass){
                                        echo "<span class='error' >Password Not Match..!!</span>";
                                    }else{
                                        $query = "UPDATE tbl_user
                                                  SET
                                                  password = '$newPass'
                                                  WHERE id = '$userid'";
                                        $update_row = $db->update($query);
                                        if ($update_row){
                                            echo "<span class='success' >Password Change Successfully... </span>";
                                        }else{
                                            echo "<span class='error' >Password not change..!!</span>";
                                        }
                                    }
                                }

                            }
                        }
                    ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Old Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter Old Password..."  name="oldPass" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>New Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter New Password..." name="newPass" class="medium" />
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
            </div>
        </div>
<?php include 'inc/footer.php'; ?>