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
        <title>Comment Section</title>
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
        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

        $table_name2 = 'forum';
        $query1 = "SELECT * FROM $table_name2 WHERE ForumID=$_SESSION[sess_fid]";
        mysqli_select_db($conn, $database);
        $result1 = mysqli_query($conn, $query1);
        $myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        mysqli_close($conn);

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'cos209';
            $table_name = 'comment';
            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
        
            $query = "DELETE FROM $table_name WHERE CommentID = '$_POST[cid]'";
            mysqli_select_db($conn, $database);
            mysqli_query($conn, $query);
            mysqli_close($conn);
            header("Refresh: 0");
        }
        ?>

        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="SuForum.php"><</a></div>
                    <div class="title-upper">Student Comments</div>
                </div>

                <div class="lower">
                    <div class="view">
                        <div class="view-post">
                            <div class="info-section">
                                <?php echo $_SESSION['sess_owner'];?><br><br>
                                <p class="time">Time: <?php echo $myrow1['Time'];?></p>
                            </div>

                            <div class="content-section">
                                <span>TOPIC: </span><?php echo $myrow1['Title'];?><br><br>
                                <?php echo $myrow1['Content'];?>
                            </div>

                            <div class="cmt-section">
                                <?php
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'comment';
                                $table_name1 = 'student';
                                $table_name2 = 'application';

                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                $sql = "SELECT * FROM $table_name INNER JOIN $table_name1 ON $table_name.Sid = $table_name1.Sid
                                                                INNER JOIN $table_name2 ON $table_name1.Aid = $table_name2.Aid
                                                                WHERE ForumID='$_SESSION[sess_fid]'";
                                $query = $conn -> query($sql);

                                while($row=$query->fetch_array()){
                                ?> 
                                <div class="cmt">
                                    <div class="cmt-owner">
                                        <?php echo $row['Aname']; ?>
                                        <span><?php echo $row['Time']; ?></span>
                                    </div>

                                    <div class="cmt-content">
                                        <textarea rows="1"><?php echo $row['Content'] ?></textarea>
                                    </div>

                                    <div class="cmt-form">
                                        <form name="Cmt Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <input type="hidden" name="cid" value="<?php echo $row['CommentID']; ?>">
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
            </div>
        </div>
    </body>
</html>
<?php
}
?>