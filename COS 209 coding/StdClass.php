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
        <title>Enrolled Courses</title>
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
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'cos209';
            $table_name = 'enroll';

            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

            if(isset($_POST["business_btn"]))
            {
                $query = "SELECT * FROM $table_name WHERE Cid='02' AND Sid='$_SESSION[sess_sid]' AND Status='Studying'";

                mysqli_select_db($conn, $database);
                $result = mysqli_query($conn, $query);
                $myrow1 = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if($myrow1){
                    ?>
                        <script>
                            window.alert('You have already enrolled this class!');
                        </script>
                    <?php
                }
                else
                {
                    ?>
                        <script>
                            var result = confirm("Do you want to proceed?");
                            if(result)
                            {
                                console.log("User clicked OK");
                                window.alert("Successfully enrolled HD Business!");
                                <?php
                                $query1 = "INSERT INTO $table_name(Cid, Sid, EnrolledDate, Status) VALUES('02', '$_SESSION[sess_sid]', CURDATE(), 'Studying')";

                                mysqli_query($conn, $query1);
                                ?>
                            }
                            else
                            {
                                console.log("User clicked Cancel");
                            }
                        </script>
                    <?php
                }
                mysqli_close($conn);
            }
        
            if(isset($_POST["it_btn"]))
            {
                $query = "SELECT * FROM $table_name WHERE Cid='01' AND Sid='$_SESSION[sess_sid]' AND Status='Studying'";

                mysqli_select_db($conn, $database);
                $result = mysqli_query($conn, $query);
                $myrow1 = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if($myrow1){
                    ?>
                        <script>
                        window.alert('You have already enrolled this class!');
                        </script>
                    <?php
                }
                else
                {
                    ?>
                    <script>
                        var result = confirm("Do you want to proceed?");
                        if(result)
                        {
                            console.log("User clicked OK");
                            window.alert("Successfully enrolled HDIT!");
                            <?php
                            $query1 = "INSERT INTO $table_name(Cid, Sid, EnrolledDate, Status) VALUES('01', '$_SESSION[sess_sid]', CURDATE(), 'Studying')";

                            mysqli_query($conn, $query1);
                            ?>
                        }
                        else
                        {
                            console.log("User clicked Cancel");
                        }
                    </script>
                    <?php
                }
                mysqli_close($conn);
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
                    <li><a href="#">Classes</a></li>
                    <li><a href="Finance.php">Finance</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul> 
            </div>

            <div class="main_content">
                <div class="upper">
                    Your Classes
                </div>

                <div class="lower">
                    <div class="your-class">
                        <center>
                            <table>
                                <tr class="header-tr">
                                    <td colspan=3>
                                        <h3>Classes You Have Enrolled</h3>
                                    </td>
                                </tr>
                                <tr class="header-tr">
                                    <td>Course</td>
                                    <td>Enrolled Date</td>
                                    <td>Status</td>
                                </tr>

                                <?php
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'enroll';

                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                $sql = "SELECT * FROM $table_name WHERE Sid='$_SESSION[sess_sid]'";
                                $query = $conn -> query($sql);
                                while($row=$query->fetch_array()){
                                ?> 
                                <tr>
                                    <td>
                                    <?php 
                                    if($row['Cid'] == "01")
                                    {
                                        echo "HDIT";
                                    }
                                    else if($row['Cid'] == "02")
                                    {
                                        echo "HDB";
                                    }
                                    ?>
                                    </td>
                                    <td><?php echo $row['EnrolledDate']; ?></td>
                                    <td><?php echo $row['Status']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </center>
                    </div>

                    <div class="class-text">
                        <h2>INTRODUCTION TO ONE-CLICK ENROLLMENT</h2>
                        Being a proud student of BUC, you can enjoy numerous privileges that make you academic journey smoother and more convenient. One such remarkable advantage is the "One Click Enrollment" feature, exclusively designed for BUC students. With this feature, you can effortlessly enroll in new classes that you are not currently studying with just a single click. No more registration fee and lengthy forms are necessary here. Make the most of your education experience with the ease and convenience of one-click enrollment at BUC!
                    </div>

                    <div class="image-container">
                        <div class="enroll-text">
                            <h2>Enroll New Course With One Click Here!</h2>
                            <p>Please remember that once you enroll the class, you cannot unenroll the class. You have responsible to pay the entire fee of the course you have enrolled. Therefore, consider again before enrolling a new course.</p>
                        </div>
                        <form name="CheckForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" name="business_btn"><img src="Images/HDB.png"></button>
                            <button type="submit" name="it_btn"><img src="Images/HDIT.png"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>