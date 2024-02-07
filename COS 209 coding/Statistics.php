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
        <title>Student Statistics</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">BUC Student Statistics Of All Time</div>
                </div>

                <div class="middle">
                    <center>
                        <form name="Select Statistics" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="radio" name="s_stat" value="ALL" checked>ALL 
                            <input type="radio" name="s_stat" value="HDIT">HDIT
                            <input type="radio" name="s_stat" value="HDB">HDB
                            <button type="submit">OKAY</button>
                        </form>
                    </center>
                </div>

                <div class="lower">
                    <div class="total-table">
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            if($_POST['s_stat'] == "ALL")
                            {
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'application';
                                $table_name1 = 'student';
                            
                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                            
                                $query = "SELECT COUNT(Aid) FROM $table_name";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $total_app = $myrow['COUNT(Aid)'];

                                $query1 = "SELECT COUNT(Aid) FROM $table_name WHERE Status='Pending'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query1);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $pending = $myrow['COUNT(Aid)'];

                                $query2 = "SELECT COUNT(Aid) FROM $table_name WHERE Status='Rejected'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query2);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $rejected = $myrow['COUNT(Aid)'];
                                
                                $query3 = "SELECT COUNT(Aid) FROM $table_name WHERE Status='Approved'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query3);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $approved = $myrow['COUNT(Aid)'];

                                $accept_rate =sprintf("%.2f", ($approved / $total_app) * 100);

                                $query4 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Status='Studying'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query4);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $current_std = $myrow['COUNT(Sid)'];

                                $query5 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Status='Graduated'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query5);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $graduate_std = $myrow['COUNT(Sid)'];

                                $query6 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Status='Dropout'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query6);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $drop_std = $myrow['COUNT(Sid)'];
                            ?>
                            <table>
                                <tr>
                                    <th colspan=3>BUC STUDENT STATISTICS</th>
                                </tr>

                                <tr>
                                    <td colspan=2>Total Applicants</td>
                                    <td class="amount"><?php echo $total_app ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Waiting Applicants</td>
                                    <td class="amount"><?php echo $pending ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Rejected Applicants</td>
                                    <td class="amount"><?php echo $rejected ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Accepted Applicants</td>
                                    <td class="amount"><?php echo $approved ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Acceptance Rate</td>
                                    <td class="amount"><?php echo $accept_rate ?>%</td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Current Students</td>
                                    <td class="amount"><?php echo $current_std ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Graudated Students</td>
                                    <td class="amount"><?php echo $graduate_std ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Dropped Out Students</td>
                                    <td class="amount"><?php echo $drop_std ?></td>
                                </tr>
                            </table>
                            <?php
                            }
                            else if($_POST['s_stat'] == "HDIT")
                            {
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'application';
                                $table_name1 = 'enroll';
                            
                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                            
                                $query = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='01'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $total_app = $myrow['COUNT(Aid)'];

                                $query1 = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='01' AND Status='Pending'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query1);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $pending = $myrow['COUNT(Aid)'];

                                $query2 = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='01' AND Status='Rejected'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query2);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $rejected = $myrow['COUNT(Aid)'];
                                
                                $query3 = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='01' AND Status='Approved'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query3);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $approved = $myrow['COUNT(Aid)'];

                                $accept_rate =sprintf("%.2f", ($approved / $total_app) * 100);

                                $query4 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Cid='01' AND Status='Studying'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query4);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $current_std = $myrow['COUNT(Sid)'];

                                $query5 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Cid='01' AND Status='Finished'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query5);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $finish_std = $myrow['COUNT(Sid)'];

                                $query6 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Cid='01' AND Status='Failed'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query6);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $fail_std = $myrow['COUNT(Sid)'];
                            ?>
                            <table>
                                <tr>
                                    <th colspan=3>BUC IT STUDENT STATISTICS</th>
                                </tr>

                                <tr>
                                    <td colspan=2>Total HDIT Applicants</td>
                                    <td class="amount"><?php echo $total_app ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Waiting HDIT Applicants</td>
                                    <td class="amount"><?php echo $pending ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Rejected HDIT Applicants</td>
                                    <td class="amount"><?php echo $rejected ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Accepted HDIT Applicants</td>
                                    <td class="amount"><?php echo $approved ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Acceptance Rate of HDIT</td>
                                    <td class="amount"><?php echo $accept_rate ?>%</td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Current HDIT Students</td>
                                    <td class="amount"><?php echo $current_std ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Finished HDIT Students</td>
                                    <td class="amount"><?php echo $finish_std ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Failed HDIT Students</td>
                                    <td class="amount"><?php echo $fail_std ?></td>
                                </tr>
                            </table>
                            <?php
                            }
                            else if($_POST['s_stat'] == "HDB")
                            {
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'application';
                                $table_name1 = 'enroll';
                            
                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                            
                                $query = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='02'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $total_app = $myrow['COUNT(Aid)'];

                                $query1 = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='02' AND Status='Pending'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query1);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $pending = $myrow['COUNT(Aid)'];

                                $query2 = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='02' AND Status='Rejected'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query2);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $rejected = $myrow['COUNT(Aid)'];
                                
                                $query3 = "SELECT COUNT(Aid) FROM $table_name WHERE Subject='02' AND Status='Approved'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query3);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $approved = $myrow['COUNT(Aid)'];

                                $accept_rate =sprintf("%.2f", ($approved / $total_app) * 100);

                                $query4 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Cid='02' AND Status='Studying'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query4);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $current_std = $myrow['COUNT(Sid)'];

                                $query5 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Cid='02' AND Status='Finished'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query5);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $finish_std = $myrow['COUNT(Sid)'];

                                $query6 = "SELECT COUNT(Sid) FROM $table_name1 WHERE Cid='02' AND Status='Failed'";
                                mysqli_select_db($conn, $database);
                                $result = mysqli_query($conn, $query6);
                                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $fail_std = $myrow['COUNT(Sid)'];
                            ?>
                            <table>
                                <tr>
                                    <th colspan=3>BUC BUSINESS STUDENT STATISTICS</th>
                                </tr>

                                <tr>
                                    <td colspan=2>Total HDB Applicants</td>
                                    <td class="amount"><?php echo $total_app ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Waiting HDB Applicants</td>
                                    <td class="amount"><?php echo $pending ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Rejected HDB Applicants</td>
                                    <td class="amount"><?php echo $rejected ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Accepted HDB Applicants</td>
                                    <td class="amount"><?php echo $approved ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Acceptance Rate of HDB</td>
                                    <td class="amount"><?php echo $accept_rate ?>%</td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Current HDB Students</td>
                                    <td class="amount"><?php echo $current_std ?></td>
                                </tr>

                                <tr>
                                    <td colspan=2>Finished HDB Students</td>
                                    <td class="amount"><?php echo $finish_std ?></td>
                                </tr>

                                <tr class="grey-tr">
                                    <td colspan=2>Failed HDB Students</td>
                                    <td class="amount"><?php echo $fail_std ?></td>
                                </tr>
                            </table>
                            <?php
                            }
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