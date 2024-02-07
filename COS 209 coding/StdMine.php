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
        <title>My Forum Posts</title>
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
            if(isset($_POST['cmt_btn']))
            {
                $_SESSION['sess_fid'] = $_POST['fid'];
                header("Location: StdMyCmt.php");
                exit();
            }
        
            if(isset($_POST['del_btn']))
            {
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'cos209';
                $table_name = 'comment';
                $table_name1 = 'forum';
                
                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
            
                $query = "DELETE FROM $table_name WHERE ForumID='$_POST[fid]'";

                $query1 = "DELETE FROM $table_name1 WHERE ForumID='$_POST[fid]'";

                mysqli_select_db($conn, $database);
                mysqli_query($conn, $query);
                mysqli_query($conn, $query1);
                mysqli_close($conn);
                ?>
                <script>alert("Successfully deleted your post!");</script>
                <?php
                header("Refresh: 0");
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
                    <li><a href="StdForum.php">Forum</a></li>
                    <li><a href="StdAdd.php" class="small-list">Post On Forum</a></li>
                    <li><a href="#" class="small-list">My Posts</a></li> 
                    <li><a href="StdClass.php">Classes</a></li>
                    <li><a href="Finance.php">Finance</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul> 
            </div>

            <div class="main_content">
                <div class="upper">
                    MY FORUM POSTS
                </div>

                <div class="lower">
                    <div class="forum-newfeed">
                        <?php
                        $host = 'localhost';
                        $user = 'root';
                        $password = '';
                        $database = 'cos209';
                        $table_name = 'forum';
                        $table_name1 = 'student';
                        $table_name2 = 'application';
                        $table_name3 = 'comment';

                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                        $sql = "SELECT $table_name.*, $table_name2.Aname, COUNT($table_name3.CommentID) AS comment_count FROM $table_name 
                                INNER JOIN $table_name1 ON $table_name.Sid = $table_name1.Sid
                                INNER JOIN $table_name2 ON $table_name1.Aid = $table_name2.Aid
                                LEFT JOIN $table_name3 ON $table_name.ForumID = $table_name3.ForumID
                                WHERE $table_name.Sid='$_SESSION[sess_sid]' GROUP BY $table_name.ForumID ORDER BY $table_name.ForumID DESC";
                                
                        $query = $conn -> query($sql);

                        while($row=$query->fetch_array()){
                        ?> 
                        <div class="forum-post">
                            <div class="forum-info">
                                <?php echo $row['Aname'];?><br><br>
                                <p class="time">Time: <?php echo $row['Time'];?></p>
                            </div>

                            <div class="forum-content">
                                <span>TOPIC: </span><?php echo $row['Title'];?><br><br>
                                <?php
                                echo $row['Content'];
                                ?>
                            </div>

                            <div class="forum-form">
                                <form name="Cmt Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="fid" value="<?php echo $row['ForumID']; ?>">
                                    <input type="hidden" name="post_owner" value="<?php echo $row['Aname']; ?>">
                                    <?php echo $row['comment_count'];?> comments
                                    <button type="submit" name="cmt_btn">Comment</button>
                                    <button type="submit" name="del_btn">Delete</button>
                                </form>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>