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
        <title>BUC Finance</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
        <?php
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cos209';
        $table_name = 'payment';
        $table_name1 = 'enroll';

        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

        $query = "SELECT SUM(AmountPaid) FROM $table_name WHERE Fid IS NULL";
        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_reg = $myrow['SUM(AmountPaid)'];

        $query1 = "SELECT COUNT(Eid) FROM $table_name1";
        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query1);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count_enroll = $myrow['COUNT(Eid)'];

        $each_enroll = "6000";
        $expect_total = $count_enroll * $each_enroll;
        $expect_income = $expect_total + $total_reg;
        
        $query2 = "SELECT SUM(AmountPaid) FROM $table_name";
        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query2);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $current_income = $myrow['SUM(AmountPaid)'];

        $remain = $expect_income - $current_income;

        mysqli_close($conn);
        ?>
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">BUC Finance Summary</div>
                </div>

                <div class="lower">
                    <div class="total-table">
                        <table>
                            <tr>
                                <th colspan=3>TOTAL BUC INCOME</th>
                            </tr>

                            <tr>
                                <td colspan=2>Total Registration Fee</td>
                                <td class="amount">USD $<?php echo $total_reg ?></td>
                            </tr>

                            <tr class="grey-tr">
                                <td colspan=2>Total Enrollment</td>
                                <td class="amount"><?php echo $count_enroll ?></td>
                            </tr>

                            <tr>
                                <td colspan=2>Each Enrollment Fee</td>
                                <td class="amount">USD $<?php echo $each_enroll ?></td>
                            </tr>
                            
                            <tr class="grey-tr">
                                <td colspan=2>Expected Total Enrollment Fee</td>
                                <td class="amount">USD $<?php echo $expect_total ?></td>
                            </tr>

                            <tr>
                                <td colspan=2>Expected Total Income</td>
                                <td class="amount"><b>USD $<?php echo $expect_income ?></b></td>
                            </tr>

                            <tr class="grey-tr">
                                <td colspan=2>Current Total Income</td>
                                <td class="amount"><b>USD $<?php echo $current_income ?></b></td>
                            </tr>

                            <tr>
                                <td colspan=2>Remaining Income</td>
                                <td class="amount">USD $<?php echo $remain ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>