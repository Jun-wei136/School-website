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
        <title>Search Payment</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">BUC Student Payments</div>
                </div>
                
                <div class="lower">
                    <div class="view-table">
                        <div class="upper-view-table">
                            <center>
                                <div class="search">
                                    <form name="Search Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="radio" name="search_id" value="aid">Application ID
                                        <input type="radio" name="search_id" value="sid">Student ID
                                        <input type="text" name="f_search">
                                        <button name="search_btn" type="submit">Search</button>
                                    </form>
                                </div>
                            </center>
                        </div>

                        <div class="lower-view-table">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(isset($_POST['search_btn']))
                                {
                                    if(empty($_POST['f_search']) || empty($_POST['search_id']))
                                    {
                                        ?><p class="error"><?php echo "Fill field!" ?></p><?php
                                    }
                                    else if($_POST['search_id'] == "aid")
                                    {
                                        ?>
                                        <table>
                                            <th>Application ID</th>
                                            <th>Name</th>
                                            <th>Card Number</th>
                                            <th>Paid Date</th>
                                            <th>Paid Method</th>
                                            <th>Paid Amount</th>
                                            <?php
                                            $host = 'localhost';
                                            $user = 'root';
                                            $password = '';
                                            $database = 'cos209';
                                            $table_name = 'payment';
                                            $table_name1 = 'application';
                
                                            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                
                                            $sql = "SELECT $table_name.*, $table_name1.* FROM $table_name
                                                    INNER JOIN $table_name1 ON $table_name.Aid = $table_name1.Aid
                                                    WHERE $table_name.Aid='$_POST[f_search]'";
                                        
                                            $query = $conn -> query($sql);
                                            while($row=$query->fetch_array()){
                                            ?> 
                                            <tbody>
                                                <tr id="row_<?php echo $row['Pid']; ?>">
                                                    <td><?php echo $row['Aid']; ?></td>
                                                    <td><?php echo $row['Aname']; ?></td>
                                                    <td><?php echo $row['CardNo']; ?></td>
                                                    <td><?php echo $row['PaymentDate']; ?></td>
                                                    <td><?php echo $row['Method']; ?></td>
                                                    <td><?php echo $row['AmountPaid']; ?></td>
                                                    <td>
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                        <input type="hidden" name="pid" value="<?php echo $row['Pid']; ?>">
                                                        <button type="submit" name="receipt_btn">Receipt</button>
                                                    </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <?php 
                                            }
                                            ?>
                                        </table>
                                        <?php
                                    }
                                    else if($_POST['search_id'] == "sid")
                                    {
                                        ?>
                                        <table>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Card Number</th>
                                            <th>Paid Date</th>
                                            <th>Paid Method</th>
                                            <th>Installment Number</th>
                                            <th>Paid Amount</th>
                                            <?php
                                            $host = 'localhost';
                                            $user = 'root';
                                            $password = '';
                                            $database = 'cos209';
                                            $table_name = 'payment';
                                            $table_name1 = 'finance';
                                            $table_name2 = 'enroll';
                                            $table_name3 = 'student';
                                            $table_name4 = 'application';
                
                                            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                
                                            $sql = "SELECT $table_name.*, $table_name4.Aname, $table_name3.Sid FROM $table_name
                                                    LEFT JOIN $table_name1 ON $table_name.Fid = $table_name1.Fid
                                                    LEFT JOIN $table_name2 ON $table_name1.Eid = $table_name2.Eid
                                                    LEFT JOIN $table_name3 ON $table_name2.Sid = $table_name3.Sid
                                                    LEFT JOIN $table_name4 ON $table_name3.Aid = $table_name4.Aid
                                                    WHERE $table_name3.Sid='$_POST[f_search]'";
                                        
                                            $query = $conn -> query($sql);
                                            while($row=$query->fetch_array()){
                                            ?> 
                                            <tbody>
                                                <tr id="row_<?php echo $row['Pid']; ?>">
                                                    <td><?php echo $row['Sid']; ?></td>
                                                    <td><?php echo $row['Aname']; ?></td>
                                                    <td><?php echo $row['CardNo']; ?></td>
                                                    <td><?php echo $row['PaymentDate']; ?></td>
                                                    <td><?php echo $row['Method']; ?></td>
                                                    <td><?php echo $row['InstallmentNo']; ?></td>
                                                    <td><?php echo $row['AmountPaid']; ?></td>
                                                    <td>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                            <input type="hidden" name="pid" value="<?php echo $row['Pid']; ?>">
                                                            <button type="submit" name="receipt_btn">Receipt</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <?php 
                                            }
                                            ?>
                                        </table>
                                        <?php
                                    }
                                }
                                else if(isset($_POST['receipt_btn']))
                                {
                                    $_SESSION['before_search'] = true;
                                    $_SESSION['sess_pid'] = $_POST['pid'];
                                    header("Location: Receipt.php");
                                    exit();
                                }
                            }
                            ?>
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