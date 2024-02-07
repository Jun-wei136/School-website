<html>
    <head>
        <meta charset="utf-8">
        <title>Application Form</title>
        <link rel="stylesheet" type="text/css" href="Application.css"/>
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="header">
            <?php
            session_start();
            if(!empty($_SESSION['sess_aid']))
            {
                ?>
                <div class="left-upper"><a href="Admin.php"><</a></div>
                <?php
            }
            else
            {
                ?>
                <div class="left-upper"><a href="Home.php"><</a></div>
                <?php
            }
            ?>
            <div class="title-upper">SCHOOL ADMISSION</div>
        </div>

    <?php
        $error = "";
        
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(empty($_POST['a_name']))
            {
                $error = "Please fill your name!";
            }
            else if(!isset($_FILES['passport_pic']) || $_FILES['passport_pic']['error'] == UPLOAD_ERR_NO_FILE)
            {
                $error = "Please add your passport picture!";
            }
            else if(empty($_POST['a_nrc']))
            {
                $error = "Please fill your NRC number!";
            }
            else if(!isset($_FILES['nrc_pic']) || $_FILES['nrc_pic']['error'] == UPLOAD_ERR_NO_FILE)
            {
                $error = "Please add your NRC picture!";
            }
            else if(empty($_POST['a_email']))
            {
                $error = "Please fill your email address!";
            }
            else if(!filter_var($_POST['a_email'], FILTER_VALIDATE_EMAIL))
            {
                $error = "Invalid email format!";
            }
            else if($_POST['a_subject'] == "none")
            {
                $error = "Please choose the subject!";
            }
            else if(!isset($_FILES['diploma_pic']) || $_FILES['diploma_pic']['error'] == UPLOAD_ERR_NO_FILE)
            {
                $error = "Please add your diploma picture!";
            }
            else if(!isset($_POST['a_agree']))
            {
                $error = "Please agree to the terms and conditions!";
            }
            else
            {
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'cos209';
                $table_name = 'application';

                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
            
                $query = "SELECT * FROM $table_name WHERE NRC = '$_POST[a_nrc]' AND Adate = CURDATE()";
                mysqli_select_db($conn, $database);
                $result = mysqli_query($conn, $query);
                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if($myrow)
                {
                    $error = "You have already applied today!";
                }
                else
                {
                    $_SESSION['sess_name'] = $_POST['a_name'];
                    $_SESSION['sess_nrc'] = $_POST['a_nrc'];
                    $_SESSION['sess_sub'] = $_POST['a_subject'];
                    $_SESSION['sess_email'] = $_POST['a_email'];

                    $target_pp_dir = "Passport/";
                    $target_pp_file = $target_pp_dir . $_FILES['passport_pic']['name'];
                    $target_nr_dir = "NRC/";
                    $target_nr_file = $target_nr_dir . $_FILES['nrc_pic']['name'];
                    $target_dp_dir = "Diploma/";
                    $target_dp_file = $target_dp_dir . $_FILES['diploma_pic']['name'];

                    $maxsize = 5242880;
                    $extension_arr = array("png", "jpeg", "jpg");
                    
                    $imageFileType_pp = strtolower(pathinfo($target_pp_file,PATHINFO_EXTENSION));
                    $imageFileType_nr = strtolower(pathinfo($target_nr_file,PATHINFO_EXTENSION));
                    $imageFileType_dp = strtolower(pathinfo($target_pp_file,PATHINFO_EXTENSION));

                    if(in_array($imageFileType_pp,$extension_arr))
                    {
                        if(($_FILES['passport_pic']['size'] >= $maxsize) || ($_FILES['passport_pic']['size'] == 0))
                        {
                            $error = "Passport picture must be less than 5MB!";
                        }
                        else
                        {
                            if(move_uploaded_file($_FILES['passport_pic']['tmp_name'], $target_pp_file))
                            {
                                $_SESSION['sess_pic'] = $target_pp_file;
                            }
                            else
                            {
                                $error = "Error uploading passport picture!";
                            }
                        }
                    }

                    if(in_array($imageFileType_nr,$extension_arr))
                    {
                        if(($_FILES['nrc_pic']['size'] >= $maxsize) || ($_FILES['nrc_pic']['size'] == 0))
                        {
                            $error = "NRC picture must be less than 5MB!";
                        }
                        else
                        {
                            if(move_uploaded_file($_FILES['nrc_pic']['tmp_name'], $target_nr_file))
                            {
                                $_SESSION['sess_nrc_pic'] = $target_nr_file;
                            }
                            else
                            {
                                $error = "Error uploading NRC picture!";
                            }
                        }
                    }

                    if(in_array($imageFileType_dp,$extension_arr))
                    {
                        if(($_FILES['diploma_pic']['size'] >= $maxsize) || ($_FILES['diploma_pic']['size'] == 0))
                        {
                            $error = "Diploma picture must be less than 5MB!";
                        }
                        else
                        {
                            if(move_uploaded_file($_FILES['diploma_pic']['tmp_name'], $target_dp_file))
                            {
                                $_SESSION['sess_dip'] = $target_dp_file;
                                header("Location: Registration.php");
                                exit();
                            }
                            else
                            {
                                $error = "Error uploading diploma picture!";
                            }
                        }
                    }
                }
            }
        }
        function input_data($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <center>
            <form name="ApplicationForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <table>
                    <th colspan="2"><h1>"Application Form"</h1></th>
                    <tr>
                        <?php
                            if(!empty($error))
                            {
                                ?>
                                <td colspan="2" class="error">
                                    <p><?php echo $error?></p>
                                </td>
                                <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <td>
                            <p>Name</p>
                            <input type="text" name="a_name" placeholder="Your Full Name">
                        </td>
                        <td class="right">
                            <p>Passport Picture</p>
                            <input type="file" name="passport_pic">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>NRC Number</p>
                            <input type="text" name="a_nrc" placeholder="Your NRC Number">
                        </td>
                        <td class="right">
                            <p>NRC Picture</p>
                            <input type="file" name="nrc_pic">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>Email</p>
                            <input type="text" name="a_email" placeholder="Your Email Address">
                        </td>
                        <td>
                            <p>Subject</p>
                            <?php
                            if(!empty($_SESSION['sess_sub']))
                            {
                                ?>
                                <select name="a_subject">
                                    <option value="none">--SELECT--</option>
                                    <option value="01" <?php echo ($_SESSION['sess_sub'] == "HDIT") ? 'selected' : ''; ?>>HDIT</option>
                                    <option value="02" <?php echo ($_SESSION['sess_sub'] == "HDB") ? 'selected' : ''; ?>>HDB</option>
                                </select>
                                <?php
                            }
                            else
                            {
                            ?>
                            <select name="a_subject">
                                <option value="none">--SELECT--</option>
                                <option value="01">HDIT</option>
                                <option value="02">HDB</option>
                            </select>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>High School Diploma</p>
                            <input type="file" name="diploma_pic">
                        </td>
                        <td class="buttons">
                            <button type="submit">Submit</button>
                            <button type="reset">Clear</button>
                        </td>
                    </tr>

                    <tr>
                        <td><input type="checkbox" name="a_agree"> I accpet the Terms and Conditions.</td>
                    </tr>
                </table>
            </form>
        </center>
    </body>
</html>