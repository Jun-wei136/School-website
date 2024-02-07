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
        <title>View Finance</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">BUC Student Finance</div>
                </div>

                <div class="lower">
                    <div class="view-table">
                        <div class="lower-view-table">
                            <table>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Total Installments</th>
                                <th>Current Installments</th>
                                <th>Total Fee</th>
                                <th>Paid Fee</th>
                                <th>Status</th>
                                <?php
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'finance';
                                $table_name1 = 'payment';
                                $table_name2 = 'enroll';
                                $table_name3 = 'student';
                                $table_name4 = 'application';

                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                {
                                    $query1 = "UPDATE $table_name SET Status='Done' WHERE Fid='$_POST[fid]'";
                                    mysqli_query($conn, $query1);
                                    ?><script>alert("Status has been changed!");</script><?php
                                    header("Refresh: 0");
                                    mysqli_close($conn);
                                }
                                
                                $sql = "SELECT $table_name.*, SUM($table_name1.AmountPaid) AS paid, MAX($table_name1.InstallmentNo) AS install_no,
                                        $table_name2.Cid, $table_name3.Sid, $table_name4.Aname FROM $table_name
                                        LEFT JOIN $table_name1 ON $table_name.Fid = $table_name1.Fid
                                        LEFT JOIN $table_name2 ON $table_name.Eid = $table_name2.Eid
                                        LEFT JOIN $table_name3 ON $table_name2.Sid = $table_name3.Sid
                                        LEFT JOIN $table_name4 ON $table_name3.Aid = $table_name4.Aid
                                        GROUP BY $table_name.Fid";
                                
                                $query = $conn -> query($sql);

                                while($row=$query->fetch_array()){

                                if($row['Cid'] == "01")
                                {
                                    $class = "HDIT";
                                }
                                else if($row['Cid'] == "02")
                                {
                                    $class = "HDB";
                                }
                                ?> 
                                <tbody>
                                    <tr id="row_<?php echo $row['Fid']; ?>">
                                        <td><?php echo $row['Sid']; ?></td>
                                        <td><?php echo $row['Aname']; ?></td>
                                        <td><?php echo $class; ?></td>
                                        <td><?php echo $row['TotalInstallments']; ?></td>
                                        <td><?php echo $row['install_no']; ?></td>
                                        <td><?php echo $row['TotalAmount']; ?></td>
                                        <td><?php echo $row['paid']; ?></td>
                                        <?php
                                        if($row['Status'] == "Paying")
                                        {   ?>
                                            <td>
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                    <input type="hidden" name="fid" value="<?php echo $row['Fid']; ?>">
                                                    <button type="submit">Change</button>
                                                </form>
                                            </td>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <td><?php echo $row['Status']; ?></td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                                <?php 
                                }
                                ?>
                            </table>
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