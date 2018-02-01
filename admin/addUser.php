<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New User</h2>
            <div class="block copyblock">

                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $fm->validation($_POST['username']);
                    $password = $fm->validation(md5($_POST['password']));
                    $role = $fm->validation($_POST['role']);

                    $username = mysqli_real_escape_string($db->link, $username);
                    $password = mysqli_real_escape_string($db->link, $password);
                    $role = mysqli_real_escape_string($db->link, $role);

                    if (empty($username)||empty($password)||empty($role)){
                        echo "<span class='error' >Field must not be empty..!!</span>";
                    }else{
                        $query = "INSERT INTO  tbl_user(username,password,email,details,role) VALUES ('$username','$password','','','$role')";
                        $userInsert = $db->insert($query);

                        if ($userInsert){
                            echo "<span class='success' >User Insert Successfully..!!</span>";
                        }else{
                            echo "<span class='error' >User Not Inserted..!!</span>";
                        }

                    }
                }

                ?>

                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label for="username">User Name</label>

                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password</label>

                            </td>
                            <td>
                                <input type="password" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">User Role</label>
                            </td>
                            <td>
                                <select name="role" id="select">
                                    <option>Select User Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Author</option>
                                    <option value="3">Editor</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>