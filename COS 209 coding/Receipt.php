<html>
    <head>
	    <meta charset="utf-8">
    	<title>Payment Receipt</title>
	    <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <?php
                    session_start();
                    if(!isset($_SESSION["sess_pid"]))
                    {
                        header("Location: Home.php");
                    }
                    else
                    {
                        if(!empty($_SESSION['sess_eid']))
                        {
                            if(!empty($_SESSION['sess_aid']))
                            {
                                ?>
                                <div class="left-upper"><a href="Receive.php"><</a></div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="left-upper"><a href="Finance.php"><</a></div>
                                <?php
                            }
                        }
                        else if(!empty($_SESSION['before_viewpay']))
                        {
                            unset($_SESSION['before_viewpay']);
                            ?>
                            <div class="left-upper"><a href="ViewPay.php"><</a></div>
                            <?php
                        }
                        else if(!empty($_SESSION['before_search']))
                        {
                            unset($_SESSION['before_search']);
                            ?>
                            <div class="left-upper"><a href="SearchFinance.php"><</a></div>
                            <?php
                        }
                        else if(!empty($_SESSION['sess_sid']))
                        {
                            ?>
                            <div class="left-upper"><a href="FinanceDetail.php"><</a></div>
                            <?php
                        }
                    }
                    ?>

                    <div class="title-upper">BUC RECEIPT</div>

                    <?php
                    if(!empty($_SESSION['sess_sid']))
                    {
                        ?>
                        <div class="right-upper"><a href="Finance.php"><button>OK</button></a></div>
                        <?php
                    }
                    else if(!empty($_SESSION['sess_id']))
                    {
                        ?>
                        <div class="right-upper"><a href="Result.php"><button>OK</button></a></div>
                        <?php
                    }
            
                    $host = 'localhost';
                    $user = 'root';
                    $password = '';
                    $database = 'cos209';
                    $table_name = 'payment';
                    $table_name1 = 'application';
                    $table_name2 = 'finance';
                    $table_name3 = 'enroll';
                    $table_name4 = 'student';

                    $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                    $query = "SELECT $table_name.*, $table_name1.Aname,Aemail, $table_name3.Cid, $table_name4.Sid FROM $table_name
                              LEFT JOIN $table_name2 ON $table_name.Fid = $table_name2.Fid
                              LEFT JOIN $table_name3 ON $table_name2.Eid = $table_name3.Eid
                              LEFT JOIN $table_name4 ON $table_name3.Sid = $table_name4.Sid
                              LEFT JOIN $table_name1 ON $table_name4.Aid = $table_name1.Aid OR $table_name.Aid = $table_name1.Aid
                              WHERE $table_name.Pid='$_SESSION[sess_pid]'";

                    mysqli_select_db($conn, $database);
                    $result = mysqli_query($conn, $query);
                    $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    mysqli_close($conn);
                    ?>
                </div>

                <div class="lower">
                    <div class="receipt-table">
                        <table>
                            <tr>
                                <td>
                                    <img src="Images/logo_blue.jpg">
                                </td>
                                <td colspan="3">
                                    <h1>PAYMENT RECEIPT</h1>
                                </td>
                            </tr>

                            <tr>
                                <td class="info-td"><b>Payment ID</b></td>
                                <td class="info-td"><?php echo $myrow['Pid'] ?></td>
                                <td class="info-td"><b>Paid Date</b></td>
                                <td class="info-td"><?php echo $myrow['PaymentDate'] ?></td>
                            </tr>

                            <tr>
                                <td class="info-td">
                                    <b>
                                    <?php
                                    if(!empty($myrow['Aid']))
                                    {
                                        echo "Application ID";
                                    }
                                    else
                                    {
                                        echo "Student ID";
                                    }
                                    ?>
                                    </b>
                                </td>
                                <td class="info-td">
                                <?php
                                    if(!empty($myrow['Aid']))
                                    {
                                        echo $myrow['Aid'];
                                    }
                                    else
                                    {
                                        echo $myrow['Sid'];
                                    }
                                    ?>
                                </td>
                                <td class="info-td"><b>Payment Method</b></td>
                                <td class="info-td"><?php echo $myrow['Method'] ?></td>
                            </tr>

                            <tr>
                                <td class="info-td"><b>Name</b></td>
                                <td class="info-td"><?php echo $myrow['Aname'] ?></td>
                                <td class="info-td"><b>Fee Type</b></td>
                                <td class="info-td">
                                    <?php
                                    if(!empty($myrow['Aid']))
                                    {
                                        echo "Registration";
                                    }
                                    else
                                    {
                                        if($myrow['Cid'] == "01")
                                        {
                                            echo "HDIT";
                                        }
                                        else if($myrow['Cid'] == "02")
                                        {
                                            echo "HDB";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="info-td"><b>Email</b></td>
                                <td class="info-td"><?php echo $myrow['Aemail'] ?></td>
                                <td class="info-td"><b>Installment No.</b></td>
                                <td class="info-td"><?php echo $myrow['InstallmentNo'] ?></td>
                            </tr>

                            <tr class="total-tr">
                                <td colspan="2" class="tr-left">Total Fee Received</td>
                                <td colspan="2" class="tr-right">
                                    $<?php echo $myrow['AmountPaid'] ?> USD
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    S-25, U Chit Mg Housing U Chit Mg Road, Tamwe Tsp, Yangon<br>
                                    Phone No: +959 426 26 5552, 5551, 5550<br>
                                    Email: buc.finance@gmail.com
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>