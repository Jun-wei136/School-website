<?php
session_start();
if(!isset($_SESSION["sess_eid"]))
{
 header("Location: Home.php");
}
else {
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Payment Page</title>
        <link rel="stylesheet" href="Pay.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
        <style>
        body.popup-open 
        {
            overflow-y: hidden;
        }
        </style>
        <script>
        function closePopup()
        {
            document.body.classList.remove('popup-open');
        }
        </script>
    </head>

    <body>
        <?php
        $error = "";
        $amount ="";
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cos209';
        $table_name1 = 'finance';

        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

        $query1 = "SELECT * FROM $table_name1 WHERE Eid='$_SESSION[sess_eid]'";
        mysqli_select_db($conn, $database);
        $result1 = mysqli_query($conn, $query1);
        $myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

        if(!empty($myrow1['TotalAmount']) && !empty($myrow1['TotalInstallments']))
        {
            $amount = $myrow1['TotalAmount'] / $myrow1['TotalInstallments'];
        }

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["ok_btn"]))
            {
                if(empty($_POST['install_method']))
                {
                    ?>
                    <script>
                    window.alert('Please choose an installment plan!');
                    </script>
                    <?php
                }
                else
                {
                    $host = 'localhost';
                    $user = 'root';
                    $password = '';
                    $database = 'cos209';
                    $table_name = 'finance';
    
                    $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
    
                    $query = "INSERT INTO $table_name(Eid, TotalAmount, TotalInstallments, Status)
                    VALUES('$_SESSION[sess_eid]', '6000', '$_POST[install_method]', 'Paying')";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    header("Refresh: 0");
                }
            }

            if(isset($_POST['cancel_btn']))
            {
                header("Location: Finance.php");
            }

            if(isset($_POST['submit_btn']))
            {
                if(empty($_POST['payment_method']))
                {
                    ?>
                    <script>
                    window.alert('Please choose a payment method!');
                    </script>
                    <?php
                }
                else
                {
                    if(empty($_POST['b_card']))
                    {
                        $error = "Please enter your card number!";
                    }
                    else if(!preg_match("/^[0-9]*$/", $_POST['b_card']))
                    {
                        $error = "Card number should only be numeric value!";
                    }
                    else if(strlen($_POST['b_card']) < 15 || strlen($_POST['b_card']) > 20)
                    {
                        $error = "Card number should be between 15 and 20 digits!";
                    }
                    else if(empty($_POST['b_name']))
                    {
                        $error = "Please enter the name on card!";
                    }
                    else if(empty($_POST['b_password']))
                    {
                        $error = "Please enter the password!";
                    }
                    else if(empty($_POST['b_expiry']))
                    {
                        $error = "Please enter the expiry date!";
                    }
                    else if(empty($_POST['b_cvv']))
                    {
                        $error = "Please enter the CVV code!";
                    }
                    else if(!preg_match("/^[0-9]*$/", $_POST['b_cvv']))
                    {
                        $error = "CVV code should only be numeric value!";
                    }
                    else if(strlen($_POST['b_cvv']) != 3)
                    {
                        $error = "CVV code must contain 3 digits!";
                    }
                    else
                    {
                        $host = 'localhost';
                        $user = 'root';
                        $password = '';
                        $database = 'cos209';
                        $table_name = 'bank';
                    
                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                    
                        $query = "SELECT * FROM $table_name WHERE CardNo='$_POST[b_card]' AND Password='$_POST[b_password]' AND CardType='$_POST[payment_method]' AND ExpiryDate='$_POST[b_expiry]' AND CvvCode='$_POST[b_cvv]' AND AccHolder='$_POST[b_name]'";
                        mysqli_select_db($conn, $database);
                        $result = mysqli_query($conn, $query);
                        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                        if(!$myrow)
                        {
                            ?>
                            <script>
                            window.alert('Invalid card information!');
                            </script>
                            <?php
                        }
                        else
                        {
                            if(strtotime($myrow['ExpiryDate']) < strtotime('today'))
                            {
                                $error = "Your card is expired!";
                            }
                            else if($myrow['Balance'] < $amount)
                            {
                                ?>
                                <script>
                                window.alert('Insufficient balance!');
                                </script>
                                <?php
                            }
                            else
                            {
                                $new_balance = $myrow['Balance'] - $amount;
                                $query2 = "UPDATE $table_name SET Balance = '".$new_balance."' WHERE CardNo='$_POST[b_card]'";
                                mysqli_query($conn, $query2);
    
                                $table_name2 = 'payment';
                                $query3 = "SELECT InstallmentNo FROM $table_name2 WHERE Fid='$myrow1[Fid]' AND Pid=(SELECT MAX(Pid) FROM $table_name2 WHERE Fid='$myrow1[Fid]')";
                                mysqli_select_db($conn, $database);
                                $result2 = mysqli_query($conn, $query3);
                                $myrow2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                                if(!$myrow2)
                                {
                                    $query4 = "INSERT INTO $table_name2(Fid, CardNo, PaymentDate, Method, InstallmentNo, AmountPaid)
                                    VALUES('$myrow1[Fid]', '$_POST[b_card]', CURDATE(), 'Online', '1', '".$amount."')";
                                    
                                    mysqli_query($conn, $query4);
                                    $_SESSION['sess_pid'] = mysqli_insert_id($conn);
                                }
                                else
                                {
                                    $new_installment = $myrow2['InstallmentNo'] + 1;
                                    $query4 = "INSERT INTO $table_name2(Fid, CardNo, PaymentDate, Method, InstallmentNo, AmountPaid)
                                    VALUES('$myrow1[Fid]', '$_POST[b_card]', CURDATE(), 'Online', '".$new_installment."', '".$amount."')";

                                    mysqli_query($conn, $query4);
                                    $_SESSION['sess_pid'] = mysqli_insert_id($conn);
                                }
    
                                mysqli_close($conn);
                                header("Location: Receipt.php");
                                exit();
                            }
                        }
                        mysqli_close($conn);
                    }
                }
            }
        }
        ?>
        <div class="upper">
            <?php
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
            ?>
            <div class="title-upper">School Fee Payment</div>
        </div>
        
        <section class="payment-section">
            <div class="container">
                <div class="payment-wrapper">
                    <div class="payment-left">
                        <div class="payment-header">
                            <div class="payment-header-title">Payment Summary</div>

                            <p class="payment-header-description">
                                Dear Students, your investment in education goes beyond the classroom. Your school fees contribute directly to enhancing your overall learning experience by funding essential student facilities. These include state-of-the-art libraries, advanced computer labs, well-equipped study spaces, and recreational areas. Therefore, be mindful that your financial commitment ensures a vibrant and conducive learning environment, empowering you to excel both academically and personally.
                            </p>
                            <p class="payment-header-description">
                                If you have any questions or concerns regarding your payment details, pleases do not hestitate to reach out to our dedicated finance team. Thank you for your commitment to your education, and we wish you continued success in your academic pursuits.
                            </p>
                            <br>
                            <h3>Total School Fee: $6000 USD</h3><br>
                            <h3>One Installment Amount: $<?php echo $amount ?>USD</h3>
                        </div>
                        
                        <?php
                            if(!empty($error))
                            {
                                ?>
                                <div class="payment-error"><?php echo $error;?></div>
                                <?php
                            }
                        ?>
                    </div>
                </div>

                <div class="payment-right">
                    <form name="RegistrationForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="payment-form">
                        <h1 class="payment-title">Choose Payment Method</h1>
                        <div class="payment-method">
                            <input type="radio" name="payment_method" value="visa" id="method-1">
                            <label for="method-1" class="payment-method-item">
                                <img src="Images/visa.png" alt="This is Visa card.">
                            </label>

                            <input type="radio" name="payment_method" value="master" id="method-2">
                            <label for="method-2" class="payment-method-item">
                                <img src="Images/mastercard.png" alt="This is Master card.">
                            </label>

                            <input type="radio" name="payment_method" value="paypal" id="method-3">
                            <label for="method-3" class="payment-method-item">
                                <img src="Images/paypal.png" alt="This is Paypal.">
                            </label>

                            <input type="radio" name="payment_method" value="stripe" id="method-4">
                            <label for="method-4" class="payment-method-item">
                                <img src="Images/stripe.png" alt="This is Stripe.">
                            </label>
                        </div>

                        <h1 class="payment-title">Credit Card Info</h1>

                        <div class="payment-form-group">
                            <input type="text" name="b_card" class="payment-form-control" id="card-number" placeholder="">
                            <label for="card-number" class="payment-form-label payment-form-label-required">CARD NUMBER</label>
                        </div>

                        <div class="payment-form-group">
                            <input type="text" name="b_name" class="payment-form-control" id="name-on-card" placeholder="">
                            <label for="name-on-card" class="payment-form-label payment-form-label-required">NAME ON CARD</label>
                        </div>

                        <div class="payment-form-group">
                            <input type="password" name="b_password" class="payment-form-control" id="card-number" placeholder="">
                            <label for="card-number" class="payment-form-label payment-form-label-required">PASSWORD</label>
                        </div>

                        <div class="payment-form-group-flex">
                            <div class="payment-form-group">
                                <input type="date" name="b_expiry" class="payment-form-control" id="expiry-date">
                                <label for="expiry-date" class="payment-form-label payment-form-label-required">EXPIRY DATE</label>
                            </div>

                            <div class="payment-form-group">
                                <input type="text" name="b_cvv" class="payment-form-control" id="cvv" placeholder="">
                                <label for="cvv" class="payment-form-label payment-form-label-required">CVV CODE</label>
                            </div>
                        </div>

                        <button name="submit_btn" type="submit" class="payment-form-submit-button">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cos209';
        $table_name = 'finance';
    
        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
    
        $query = "SELECT * FROM $table_name WHERE Eid='$_SESSION[sess_eid]'";
        
        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
        if(!$myrow)
        {?>
            <div class="popup">
                <div class="popup-content">
                    <h2>Choose Installment Plan</h2>
                    
                    <p>Before finalizing your installment plan choice, be mindful that changes are not allowed once confirmed, so it's important to carefully consider your decision.</p>
                    <form name="Check Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="radio" name="install_method" class="radio-btn" value="1">1 time 
                        <input type="radio" name="install_method" class="radio-btn" value="2">2 times
                        <input type="radio" name="install_method" class="radio-btn" value="3">3 times
                        <input type="radio" name="install_method" class="radio-btn" value="4">4 times
                        <br>
                        <button name="ok_btn" type="submit" onclick="closePopup()">OKAY</button>
                        <button name="cancel_btn" type="submit">CANCEL</button>
                    </form>
                </div>
                <script>
                document.body.classList.add('popup-open');
                </script>
            </div>
        <?php
        }
    ?>
    </body>
</html>
<?php
}
?>