<?php
session_start();
if(!isset($_SESSION["sess_sid"]))
{
 header("Location: Home.php");
}
else {
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Changing Password</title>
        <link rel="stylesheet" href="Student.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
        <script>
            function confirmLogout()
            {
                var result = confirm("Are you sure you want to log out?");
                if(result)
                {
                    window.location.href = "Logout.php";
                }
            }
        </script>
    </head>

    <body>
        <?php
        function input_data($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cos209';
        $table_name = 'student';
        $table_name1 = 'application';

        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

        $query = "SELECT * FROM $table_name INNER JOIN $table_name1 ON $table_name.Aid = $table_name1.Aid
                  WHERE $table_name.Sid = '$_SESSION[sess_sid]'";

        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_close($conn);

        $current_error = $new_error = $confirm_error = "";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $confirm = "";

            if(empty($_POST['current_password']))
            {
                $current_error = "Enter your current password!";
            }

            if(empty($_POST['new_password']))
            {
                $new_error = "Enter a new password!";
            }

            if(empty($_POST['confirm_password']))
            {
                $confirm_error = "Confirm your new password again!";
            }

            if($current_error == "" && $new_error == "" && $confirm_error == "")
            {
                if($_POST['new_password'] != $_POST['confirm_password'])
                {
                    $confirm_error = "Confirmed password does not match!";
                }
                else
                {   
                    if($_POST['current_password'] == $_POST['confirm_password'])
                    {
                        $confirm_error = "New password cannot be same as the old one!";
                    }
                    else if(strlen($_POST['confirm_password']) < 8)
                    {
                        $confirm_error = "Your password should be at least 8 letters long!";
                    }
                    else
                    {
                        $confirm = input_data($_POST['confirm_password']);

                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                    
                        $query = "SELECT * FROM $table_name WHERE Sid='$_SESSION[sess_sid]' AND Password='$_POST[current_password]'";
                        mysqli_select_db($conn, $database);
                        $result = mysqli_query($conn, $query);
                        $myrow1 = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        if(!$myrow1)
                        {
                            $current_error = "Incorrect password!";
                        }
                        else
                        {
                            $query1 = "UPDATE $table_name SET Password='$confirm' WHERE Sid='$_SESSION[sess_sid]'";
                            mysqli_query($conn, $query1);
                            ?><script>alert("Successfully set a new password!");</script><?php
                        }
                        mysqli_close($conn);
                    }
                }
            }
        }
        ?>

        <div class="wrapper">
            <div class="sidebar">
                <center><img src="<?php echo $myrow['Apicture']; ?>" width="120px"></center>
                <br>
                <h3><?php echo $myrow['Aname'] ?></h3>
                <h3>Student ID - <?php echo $myrow['Sid'] ?></h3>
                <br>
                <ul>
                    <li><a href="Student.php">Profile</a></li>
                    <li><a href="StdEdit.php" class="small-list">Edit Profile Information</a></li>
                    <li><a href="#" class="small-list">Change Password</a></li>
                    <li><a href="StdForum.php">Forum</a></li>
                    <li><a href="StdClass.php">Classes</a></li>
                    <li><a href="Finance.php">Finance</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul> 
            </div>

            <div class="main_content">
                <div class="upper">
                    Set New Password
                </div>

                <center>
                    <div class="lower">
                        <div class="window">
                            <form name="PasswordForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <h3>Current Password</h3>
                                <input type="text" name="current_password">
                                <?php
                                if(!empty($current_error))
                                {
                                    ?><div class="error">
                                        <p><?php echo $current_error?></p>
                                    </div><?php
                                }
                                ?>

                                <h3>New Password</h3>
                                <input type="text" name="new_password">
                                <?php
                                if(!empty($new_error))
                                {
                                    ?><div class="error">
                                        <p><?php echo $new_error?></p>
                                    </div><?php
                                }
                                ?>

                                <h3>Confirm New Password</h3>
                                <input type="text" name="confirm_password">
                                <?php
                                if(!empty($confirm_error))
                                {
                                    ?><div class="error">
                                        <p><?php echo $confirm_error?></p>
                                    </div><?php
                                }
                                ?>

                                <button type="submit" class="change-form-submit-button">Confirm</button>
                            </form>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>
<?php
}
?>