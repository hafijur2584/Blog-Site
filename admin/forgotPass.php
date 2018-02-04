<?php

include '../lib/Session.php';
session::checkLogin();


?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php
$db = new Database();
$fm = new Format();

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
    <section id="content">

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $fm->validation($_POST['email']) ;

            $email = mysqli_real_escape_string($db->link,$email);
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                echo "<span class='error' >Invalid Email..!!</span>";
            }else{
                $mailQuery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
                $mailCheck = $db->select($mailQuery);

                if($mailCheck != false){
                    while ($value = $mailCheck->fetch_assoc()){
                        $userid = $value['id'];
                        $username = $value['username'];
                    }
                    $text = substr($email,0,3);
                    $rand = rand(10000,99999);
                    $newPass = "$text$rand";
                    $password = md5($newPass);
                    $query = "UPDATE tbl_user
                            SET
                            password = '$password'
                            WHERE id = '$userid'";
                    $update_row = $db->update($query);
                    $to = "$email";
                    $from = "Hafijur2584@gmail.com";
                    $headers = "From:$from\n";
                    $headers .= 'MIME-Version: 1.0'."\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1'. "\r\n";
                    $subject = "Your Password";
                    $message = "Your username id ".$username." Your Password is ".$newPass." Please visit website to login.";
                    $sendMail = mail($to, $subject, $message, $headers);
                    if ($sendMail){
                        echo "<span class='success' >Mail sent. Please check your email for new password... </span>";
                    }else{
                        echo "<span class='error' >Email not send..!!</span>";
                    }
                }else{
                    echo "<span class='error' >Email Not Found..!!</span>";
                }
            }


        }
        ?>

        <form action="" method="POST">
            <h1>Password Recovery</h1>
            <div>
                <input type="text" placeholder=" Enter email here..." required="" name="email"/>
            </div>

            <div>
                <input type="submit" value="Send Mail" />
            </div>
        </form><!-- form -->
        <div class="button">
            <a href="login.php">Login</a>
        </div>
        <div class="button">
            <a href="#">Training with live project</a>
        </div><!-- button -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>