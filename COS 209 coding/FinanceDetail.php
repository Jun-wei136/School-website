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
        <title>Fee Payments</title>
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
            $_SESSION['sess_pid'] = $_POST['pid'];
            header("Location: Receipt.php");
            exit();
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
                    <li><a href="StdClass.php">Classes</a></li>
                    <li><a href="Finance.php">Finance</a></li>
                    <li><a href="#" class="small-list">Payments</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul> 
            </div>

            <div class="main_content">
                <div class="upper">
                    My Payments
                </div>

                <div class="lower">
                    <table>
                        <tr class="head-table">
                            <td>Subject</td>
                            <td>Installment Number</td>
                            <td>Paid Date</td>
                            <td>Card Number</td>
                            <td>Paid Method</td>
                            <td>Receipt</td>
                        </tr>
                        <?php
                        $host = 'localhost';
                        $user = 'root';
                        $password = '';
                        $database = 'cos209';
                        $table_name = 'payment';
                        $table_name1 = 'finance';
                        $table_name2 = 'enroll';
                        $table_name3 = 'student';

                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                        $sql = "SELECT * FROM $table_name LEFT JOIN $table_name1 ON $table_name.Fid = $table_name1.Fid
                                LEFT JOIN $table_name2 ON $table_name1.Eid = $table_name2.Eid
                                LEFT JOIN $table_name3 ON $table_name3.Sid = $table_name2.Sid
                                WHERE $table_name.Aid='$myrow[Aid]' OR $table_name3.Sid='$myrow[Sid]'";

                        $query = $conn -> query($sql);
                        while($row=$query->fetch_array()){
                        ?> 
                        <tr id="row_<?php echo $row['Pid']; ?>">
                            <td>
                            <?php 
                            if($row['Cid'] == "")
                            {
                                echo "Registration";
                            }
                            else if($row['Cid'] == "01")
                            {
                                echo "HDIT";
                            }
                            else if($row['Cid'] == "02")
                            {
                                echo "HDB";
                            }
                            ?>
                            </td>
                            <td><?php echo $row['InstallmentNo']; ?></td>
                            <td><?php echo $row['PaymentDate']; ?></td>
                            <td><?php echo $row['CardNo']; ?></td>
                            <td><?php echo $row['Method']; ?></td>
                            <td>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="pid" value="<?php echo $row['Pid']; ?>">
                                    <button type="submit">Receipt</button>
                                </form>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>