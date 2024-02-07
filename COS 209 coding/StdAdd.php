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
        <title>Posting on Forum</title>
        <link rel="stylesheet" href="StdAdd.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <?php
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

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'cos209';
            $table_name = 'forum';

            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
        
            $query = "INSERT INTO $table_name(Sid, Title, Content, Time) VALUES('$_SESSION[sess_sid]', '$_POST[f_title]', '$_POST[f_content]', CURTIME())";
            mysqli_query($conn, $query);
            mysqli_close($conn);
            ?>
            <script>alert("Your post has been uploaded on the forum!");</script>
            <?php
            header("Location: StdForum.php");
            exit();
        }
        ?>

        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="StdForum.php"><</a></div>
                    <div class="title-upper">What's on your mind?</div>
                </div>
                
                <div class="lower">
                    <center>
                    <div class="add-form">
                        <form name="Check Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="text" name="f_title" placeholder="TITLE" required><br><br><br>
                            <textarea name="f_content" rows="15" placeholder="CONTENT" required></textarea><br><br><br>
                            <button name="add_btn" type="submit">UPLOAD</button>
                        </form>
                    </div>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>