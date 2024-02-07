<?php
session_start();
if(!isset($_SESSION["sess_aid"]))
{
 header("Location: Home.php");
}
else {
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search Student</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(empty($_POST['f_search']))
            {
                ?><script>alert("Fill field!");</script><?php
            }
            else
            {
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'cos209';
                $table_name = 'student';

                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
            
                $query = "SELECT * FROM $table_name WHERE Sid = '$_POST[f_search]'";

                mysqli_select_db($conn, $database);
                $result = mysqli_query($conn, $query);
                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if(empty($myrow))
                {
                    ?><script>alert("Student ID does not exist!");</script><?php
                    mysqli_close($conn);
                }
                else
                {
                    $_SESSION['sess_sid'] = $_POST['f_search'];
                    mysqli_close($conn);
                    header("Location: SSEdit.php");
                }
            }
        }
        ?>

        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">Search Student To Edit</div>
                </div>

                <div class="lower">
                    <div class="edit-section">
                        <center>
                            <div class="upper-wrap">
                                <form name="Search Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="text" name="f_search" placeholder="Student ID">
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>