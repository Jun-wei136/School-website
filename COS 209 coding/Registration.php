<html>
    <head>
        <meta charset="utf-8">
        <title>Payment Page</title>
        <link rel="stylesheet" href="Registration.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <?php
        session_start();
        if(!isset($_SESSION["sess_name"]))
        {
            header("Location: Home.php");
        }
        else
        {
            $error = "";

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(empty($_POST['payment_method']))
                {
                    $error = "Please choose a payment method!";
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
                    
                        $query = "SELECT * FROM $table_name WHERE CardNo='$_POST[b_card]' 
                                  AND Password='$_POST[b_password]' AND CardType='$_POST[payment_method]' 
                                  AND ExpiryDate='$_POST[b_expiry]' AND CvvCode='$_POST[b_cvv]' AND AccHolder='$_POST[b_name]'";

                        mysqli_select_db($conn, $database);
                        $result = mysqli_query($conn, $query);
                        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                        if(!$myrow)
                        {
                            $error = "Invalid card information!";
                        }
                        else
                        {
                            if(strtotime($myrow['ExpiryDate']) < strtotime('today'))
                            {
                                $error = "Your card is expired!";
                            }
                            else if($myrow['Balance'] < 300)
                            {
                                $error = "Insufficient balance!";
                            }
                            else
                            {
                                $new_balance = $myrow['Balance'] - 300;
                                $query1 = "UPDATE $table_name SET Balance = '".$new_balance."' WHERE CardNo='$_POST[b_card]'";
                                mysqli_query($conn, $query1);
    
                                $table_name1 = 'application';
                                $query2 = "INSERT INTO $table_name1(Aname, Apicture, NRC, NRCpicture, Subject, Aemail, Adate, HighschoolDiploma, Status)
                                VALUES('$_SESSION[sess_name]', '$_SESSION[sess_pic]', '$_SESSION[sess_nrc]', '$_SESSION[sess_nrc_pic]', '$_SESSION[sess_sub]', '$_SESSION[sess_email]', CURDATE(), '$_SESSION[sess_dip]', 'Pending')";
                                mysqli_query($conn, $query2);

                                $_SESSION['sess_id'] = mysqli_insert_id($conn);
    
                                unset($_SESSION['sess_name'], $_SESSION['sess_pic'], $_SESSION['sess_nrc'], $_SESSION['sess_nrc_pic'], $_SESSION['sess_sub'], $_SESSION['sess_email'], $_SESSION['sess_dip']);
    
                                $table_name2 = 'payment';
                                $query3 = "INSERT INTO $table_name2(Aid, CardNo, PaymentDate, Method, InstallmentNo, AmountPaid)
                                VALUES('$_SESSION[sess_id]', '$_POST[b_card]', CURDATE(), 'Online', '0', '300')";
                                mysqli_query($conn, $query3);
    
                                $_SESSION['sess_pid'] = mysqli_insert_id($conn);
    
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
        <div class="header">
            <?php
            if(!empty($_SESSION['sess_aid']))
            {
                ?>
                <div class="left-upper"><a href="Admin.php"><</a></div>
                <?php
            }
            else
            {
                ?>
                <div class="left-upper"><a href="Application.php"><</a></div>
                <?php
            }
            ?>
            <div class="title-upper">REGISTRATION FEE PAYMENT</div>
        </div>
        
        <section class="payment-section">
            <div class="container">
                <div class="payment-wrapper">
                    <div class="payment-left">
                        <div class="payment-header">
                            <div class="payment-header-title">Payment Summary</div>

                            <p class="payment-header-description">
                                The registration fee is a vital component that supports various aspects of your education, including classroom resources, facility maintenance and extracurricular activities. According to rules and regulation of British University College, registration fee is required to pay immediately while applying a course.
                            </p>
                            <br>

                            <p class="payment-header-description">
                                Please be noted that registration fee is going to be <b>nonrefundable</b> under any condition, once it is paid.
                            </p>
                            <br>

                            <h3>Registration Fee: $300 USD</h3>
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
                                <img src="Images/mastercard.png" alt="This is Master Card.">
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

                        <button type="submit" class="payment-form-submit-button">Pay</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>