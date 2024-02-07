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
        <title>View Payment</title>
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
                                <form name="Select Payment" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="radio" name="v_pay" value="registration">Registration Fees 
                                    <input type="radio" name="v_pay" value="school_fee">School Fees
                                    <button type="submit" name="select_btn">OKAY</button>
                                </form>
                            </center>
                        </div>
                        
                        <div class="lower-view-table">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(isset($_POST['select_btn']))
                                {
                                    if(empty($_POST['v_pay']))
                                    {
                                        ?><p class="error"><?php echo "Choose a table to view." ?></p><?php
                                    }
                                    else if($_POST['v_pay'] == "registration")
                                    {
                                        ?>
                                        <table>
                                            <th>Register ID</th>
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
                                    
                                            $sql = "SELECT $table_name.* , $table_name1.Aname FROM $table_name INNER JOIN $table_name1 ON $table_name.Aid = $table_name1.Aid WHERE $table_name.Aid IS NOT NULL";
                                            
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
                                    else if($_POST['v_pay'] == "school_fee")
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
                    
                                            $sql = "SELECT $table_name.*, $table_name3.Sid, $table_name4.Aname FROM $table_name 
                                                    INNER JOIN $table_name1 ON $table_name.Fid = $table_name1.Fid 
                                                    INNER JOIN $table_name2 ON $table_name1.Eid = $table_name2.Eid
                                                    INNER JOIN $table_name3 ON $table_name2.Sid = $table_name3.Sid
                                                    INNER JOIN $table_name4 ON $table_name3.Aid = $table_name4.Aid
                                                    WHERE $table_name.Fid IS NOT NULL";
            
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
                                    $_SESSION['sess_pid'] = $_POST['pid'];
                                    $_SESSION['before_viewpay'] = true;
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