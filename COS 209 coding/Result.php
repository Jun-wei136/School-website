<?php
session_start();
if(!isset($_SESSION["sess_id"]))
{
 header("Location: Home.php");
}
else {
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Checking Result</title>
        <link rel="stylesheet" type="text/css" href="Result.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <?php
        $app_result = "";

        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cos209';
        $table_name = 'application';

        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

        $query = "SELECT * FROM $table_name WHERE Aid='$_SESSION[sess_id]'";
        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($myrow['Subject'] == "01")
        {
            $subject = "HDIT";
        }
        else if($myrow['Subject'] == "02")
        {
            $subject = "HDB";
        }

        if($myrow['Status'] == "Pending")
        {
            $app_result = "We appreciate your interest in BUC ans would like to inform you that the application review process is currently underway. Our dedicated admissions team is carefully considering each application to ensure a thorough and fair evaluation. Please be patient, as our goal is to give each application the attention it deserves.";
        }
        else if($myrow['Status'] == "Approved")
        {
            $table_name2 = 'student';
            $query3 = "SELECT * FROM $table_name2 WHERE Aid='$_SESSION[sess_id]'";
            mysqli_select_db($conn, $database);
            $result2 = mysqli_query($conn, $query3);
            $myrow2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

            if(empty($myrow2['Password']))
            {
                $app_result = "CONGRATULATIONS! We are delighted to inform you that your application has been thoroughly reviewed, and we are pleased to extend our congratulations as your application has been accepted. We are excited about the prospect of welcoming you to our school. Now that you are officially one of our students, you are allowed to create a student portal account. Create Acc <a href='SignUp.php'>Here</a>.";
            }
            else
            {
                $app_result = "CONGRATULATIONS! We are delighted to inform you that your application has been thoroughly reviewed, and we are pleased to extend our congratulations as your application has been accepted. We are excited about the prospect of welcoming you to our school. We have found out that you have already created a student portal account. Log in <a href='Login.php'>Here</a>";
            }
        }
        else if($myrow['Status'] == "Rejected")
        {
            $app_result = "We are sorry to inform you that we are unable to offer you a place in the incoming class. We have reviewed your application under careful consideration. So, please understand that the decision-making process is comprehensive and each applicants is thoroughly evaluated. We appreciate the time and effort you invested in your application to BUC. While we are unable to welcome you as a student at this time, we encourage you to explore alternative educational opporunities that align with your aspirations for upcoming intakes. BUC wishes you every success in your future academic and personal pursuits.";
        }

        mysqli_close($conn);
        ?>

        <section class="payment-section">
            <div class="container">
                <div class="cv-form">
                    <table>
                        <th colspan="2"><h2>APPLICATION FORM</h2></th>
                        <tr>
                            <td colspan="2" class="basic-info">
                                <img src="<?php echo $myrow['Apicture'];?>">
                                <p>Application ID: <?php echo $myrow['Aid'];?></p><br>
                                <p>Name: <?php echo $myrow['Aname'];?></p><br>
                                <p>Email: <?php echo $myrow['Aemail'];?></p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>NRC: <?php echo $myrow['NRC'];?></p><br>
                                <p>Applied Date: <?php echo $myrow['Adate'];?></p><br>
                                <p>Subject: <?php echo $subject?></p>
                            </td>
                            <td class="nrc-td"><img src="<?php echo $myrow['NRCpicture'];?>"></td>
                        </tr>

                        <tr>
                            <td colspan="2" class="dip-td">
                                <img src="<?php echo $myrow['HighschoolDiploma'];?>">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="result-form">
                    <form name="RegistrationForm" 
                    action="<?php
                            if(!empty($_SESSION['sess_aid']))
                            {
                                echo "Admin.php";
                            }
                            else
                            {
                                echo "Home.php";
                            }
                            ?>" method="post" class="result">
                        <center><img src="Images/logo_blue.jpg" width="200px"></center>
                        <h1 class="result-title">Result</h1>
                        <p><?php echo $app_result;?></p>

                        <h1 class="result-title">Notice</h1>
                        <p>Dear applicant, we would like to remind you to securely retain your "Application ID" for future reference in checking your application status. The analysis of applications is anticipated to take approximately one to two weeks. Upon completion of the evaluation process, the final results will be released. Additionally, we will notify you of the result through the email address provided in your application. Thank you for choosing to apply to our school. We extend our best wishes to you and look forward to the possibility of welcoming you to our academic community.</p>
                        <p>If you have any urgent inquiries or need further assistance, feel free to reach out to us. </p>

                        <button type="submit" class="buttons">Okay</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
<?php
}
?>