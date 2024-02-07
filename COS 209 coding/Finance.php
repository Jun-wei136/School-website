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
        <title>Finance Details</title>
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
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $_SESSION['sess_eid'] = $_POST['eid'];
            header("Location: Pay.php");
            exit();
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
                    <li><a href="#">Finance</a></li>
                    <li><a href="FinanceDetail.php" class="small-list">Payments</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul> 
            </div>

            <div class="main_content">
                <div class="upper">
                    MY FINANCE
                </div>

                <div class="lower">
                    <table Border=1>
                        <tr class="head-table">
                            <td>Subject</td>
                            <td>Total Installment</td>
                            <td>Current Installment</td>
                            <td>Total Fee</td>
                            <td>Paid Fee</td>
                            <td>Remaining Fee</td>
                            <td>Payment Status</td>
                            <td>Pay</td>
                        </tr>

                        <?php
                        $host = 'localhost';
                        $user = 'root';
                        $password = '';
                        $database = 'cos209';
                        $table_name = 'enroll';
                        $table_name1 = 'finance';
                        $table_name2 = 'payment';
                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                        $sql = "SELECT $table_name.*, SUM($table_name2.AmountPaid) AS paid,
                                MAX($table_name2.InstallmentNo) AS current, $table_name1.*,
                                ($table_name1.TotalAmount - SUM($table_name2.AmountPaid)) AS remain,
                                $table_name.Eid FROM $table_name
                                LEFT JOIN $table_name1 ON $table_name.Eid = $table_name1.Eid
                                LEFT JOIN $table_name2 ON $table_name1.Fid = $table_name2.Fid
                                WHERE Sid = '$_SESSION[sess_sid]' GROUP BY $table_name2.Fid";

                        $query = $conn -> query($sql);
                        while($row=$query->fetch_array()){
                        ?> 
                                <tbody>
                                <tr id="row_<?php echo $row['Eid']; ?>">
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
                                    <td><?php echo $row['TotalInstallments']; ?></td>
                                    <td><?php echo $row['current']; ?></td>
                                    <td><?php echo $row['TotalAmount']; ?></td>
                                    <td><?php echo $row['paid']; ?></td>
                                    <td><?php echo $row['remain']; ?></td>
                                    <td><?php echo $row['Status']; ?></td>
                                    <td>
                                    <?php
                                    if($row['Status'] != "Done")
                                    {
                                        ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <input type="hidden" name="eid" value="<?php echo $row['Eid']; ?>">
                                            <button type="submit">Pay</button>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                    </td>
                                </tr>
                            </tbody>
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