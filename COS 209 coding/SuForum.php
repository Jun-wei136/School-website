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
        <title>Student Forum</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST['cmt_btn']))
            {
                $_SESSION['sess_fid'] = $_POST['fid'];
                $_SESSION['sess_owner'] = $_POST['post_owner'];
                header("Location: SuCmt.php");
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
            
                $query = "DELETE FROM $table_name WHERE ForumID=$_POST[fid]"; 

                $query1 = "DELETE FROM $table_name1 WHERE ForumID='$_POST[fid]'";

                mysqli_select_db($conn, $database);
                mysqli_query($conn, $query);
                mysqli_query($conn, $query1);
                mysqli_close($conn);
                header("Refresh: 0");
            }
        }
        ?>

        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">Student Forum</div>
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
                        GROUP BY $table_name.ForumID";
                        $query = $conn -> query($sql);

                        while($row=$query->fetch_array()){
                        ?> 
                        <div class="forum-post">
                            <div class="forum-info">
                                <?php echo $row['Aname'];?><br><br>
                                Student ID: <?php echo $row['Sid'];?><br><br>
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
                                    <button type="submit" name="cmt_btn">Comments</button>
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