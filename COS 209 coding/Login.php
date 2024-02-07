<?php
session_start();
session_destroy();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Signing In</title>
        <link rel="stylesheet" type="text/css" href="Login.css"/>
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <a href="Home.php"><h1 id="back_btn">x</h1></a>
        <div class="center">
            <center><img src="Images/logo_org.jpg" width="300px"></center>
            <form name="Login Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="txt_field">
                    <input type="text" name="id" required>
                    <span></span>
                    <label>ID</label>
                </div>

                <div class="txt_field">
                    <input type="password" name="password" required>
                    <span></span>
                    <label>Password</label>
                </div>

                <div class="forgot">Forgot Password?</div>
                
                <center><button name="login_btn" type="submit">LOGIN</button></center>
                <div class="check">
                    Check your application result <a href="#" class="popup_btn">Here</a>
                </div>
            </form>
        </div>

        <div class="popup">
            <div class="popup-content">
                <h2>Check your result</h2>
                <form name="Check Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="text" name="a_id" placeholder="Application ID">
                    <input type="text" name="NRC_no" placeholder="NRC Number">
                    <button name="ok_btn" type="submit">OKAY</button>
                    <button name="cancel_btn" type="submit">CANCEL</button>
                </form>
            </div>
        </div>

        <script>
            document.querySelector(".popup_btn").addEventListener("click", function()
            {
                document.querySelector(".popup").style.display="flex";
            });
        </script>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'cos209';

            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

            if(isset($_POST["login_btn"]))
            {
                if(ctype_alpha(substr($_POST['id'], 0, 1)))
                {
                    $table_name = 'admin';
                    $query = "SELECT * FROM $table_name WHERE AdminID='$_POST[id]' AND Password='$_POST[password]'";
                    mysqli_select_db($conn, $database);
                    $result = mysqli_query($conn, $query);
                    $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    if(!$myrow)
                    {
                        ?>
                        <script>
                        window.alert('Incorret user ID or password!');
                        </script>
                        <?php
                    }
                    else
                    {
                        mysqli_close($conn);
                        session_start();
                        $_SESSION['sess_aid'] = $_POST['id'];
                        header("Location: Admin.php");
                        exit();
                    }
                }
                else if(ctype_digit(substr($_POST['id'], 0, 1)))
                { 
                    $table_name = 'student';
                    $query = "SELECT * FROM $table_name WHERE Sid='$_POST[id]' AND Password='$_POST[password]'";
                    mysqli_select_db($conn, $database);
                    $result = mysqli_query($conn, $query);
                    $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if(!$myrow)
                    {
                        ?>
                        <script>
                        window.alert('Incorrect user ID or password!');
                        </script>
                        <?php
                    }
                    else
                    {
                        mysqli_close($conn);
                        session_start();
                        $_SESSION['sess_sid'] = $_POST['id'];
                        header("Location: Student.php");
                        exit();
                    }
                }
            }

            else if(isset($_POST["cancel_btn"]))
            {
                ?>
                <script>
                        history.back();
                        document.querySelector(".popup").style.display="none";
                </script>
                <?php
            }

            else if(isset($_POST["ok_btn"]))
            {
                $table_name = 'application';

                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                $query = "SELECT * FROM $table_name WHERE Aid='$_POST[a_id]' AND NRC='$_POST[NRC_no]'";
                mysqli_select_db($conn, $database);
                $result = mysqli_query($conn, $query);
                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if(!$myrow)
                {
                    ?>
                    <script>
                    window.alert('Incorrect application ID or NRC number!');
                    </script>
                    <?php
                }
                else
                {
                    session_start();
                    $_SESSION['sess_id']=$_POST['a_id'];
                    $_SESSION['sess_nrc']=$_POST['NRC_no'];
                    mysqli_close($conn);
                    header("Location: Result.php");
                    exit();
                }
            }
        }
        ?>
    </body>
</html>