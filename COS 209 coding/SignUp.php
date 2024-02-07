<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="SignUp.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
        <title>Signing Up</title>
    </head>
    <body>
        <?php
        session_start();
        $nation_error = $dob_error = $address_error = $phone_error = $gender_error = $father_error = $guard_error = $pass_error = $confirm_error = "";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $nation = $dob = $address = $phone = $gender = $father = $guard = $pass = $confirm = "";

            if(empty($_POST['s_nation']))
            {
                $nation_error = "Please Select Your Nationality.";
            }
            else
            {
                $nation = input_data($_POST['s_nation']);
            }

            if(empty($_POST['s_dob']))
            {
                $dob_error = "Please Select Your Date Of Birth.";
            }
            else
            {
                $dob = input_data($_POST['s_dob']);
            }

            if(empty($_POST['s_address']))
            {
                $address_error = "Please Enter Your Current Address.";
            }
            else
            {
                $address = input_data($_POST['s_address']);
            }

            if(empty($_POST['s_phone']))
            {
                $phone_error = "Please Enter Your Phone Number.";
            }
            else
            {
                $phone = input_data($_POST['s_phone']);

                if(!preg_match("/^[0-9]*$/", $phone))
                {
                    $phone_error = "Phone Number Should Only Be Numeric Value.";
                }
            }

            if(empty($_POST['s_gender']))
            {
                $gender_error = "Please Select Your Gender.";
            }
            else
            {
                $gender = input_data($_POST['s_gender']);
            }
            
            if(empty($_POST['s_father']))
            {
                $father_error = "Please Enter Your Father Name.";
            }
            else
            {
                $father = input_data($_POST['s_father']);
            }

            if(empty($_POST['s_guard']))
            {
                $guard_error = "Please Enter Your Guardian's Phone Number.";
            }
            else
            {
                $guard = input_data($_POST['s_guard']);

                if(!preg_match("/^[0-9]*$/", $guard))
                {
                    $guard_error = "Phone Number Should Only Be Numeric Value.";
                }
            }
            
            if(empty($_POST['s_pass']))
            {
                $pass_error = "Please Enter A Password.";
            }
            else
            {
                $pass = input_data($_POST['s_pass']);
                
                if(strlen($pass) < 8)
                {
                    $pass_error = "Password Must Contain At Least 8 Letters.";
                }
            }
            
            if(empty($_POST['s_confirm']))
            {
                $confirm_error = "Please Confirm Your Password Again.";
            }
            else
            {
                $confirm = input_data($_POST['s_confirm']);
                
                if($pass != $confirm)
                {
                    $confirm_error = "Confirmed Password Does Not Match.";
                }
            }

            if($nation_error == "" && $dob_error == "" && $address_error == "" && $phone_error == "" && $gender_error == "" && $father_error == "" && $guard_error == "" && $pass_error == "" && $confirm_error == "")
            {
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'cos209';
                $table_name = 'student';

                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                $query = "UPDATE $table_name SET Password='".$confirm."', FatherName='".$father."', DOB='".$dob."', Gender='".$gender."', Nationality='".$nation."', 
                          Address='".$address."', PhoneNo ='".$phone."', GuardianPhoneNo ='".$guard."', AcceptedDate=CURDATE(), Status='Studying' WHERE Aid='$_SESSION[sess_id]'";
                mysqli_query($conn, $query);

                $query1 = "SELECT Sid FROM $table_name WHERE Aid = '$_SESSION[sess_id]'";
                mysqli_select_db($conn, $database);
                $result = mysqli_query($conn, $query1);
                $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $_SESSION['sess_sid'] = $myrow['Sid'];
                mysqli_close($conn);
                header("Location: Student.php");
                exit();
            }
        }

        function input_data($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if(isset($_POST["cancel_btn"]))
        {
            header("Location: Result.php");
            exit();
        }
        ?>
        <div class="signup-section">
            <form name="SignUpForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="signup-form">
                <h1 class="signup-title">Create Your Student Account</h1>
                <div class="wrap">
                    <div class="left-wrap">
                        <div class="signup-form-group">
                            <select name="s_nation" class="signup-form-control" id="nationality">
                                <option value="">-- Select --</option>
                                <option value="afghan">Afghan</option>
                                <option value="albanian">Albanian</option>
                                <option value="algerian">Algerian</option>
                                <option value="american">American</option>
                                <option value="andorran">Andorran</option>
                                <option value="angolan">Angolan</option>
                                <option value="antiguans">Antiguans</option>
                                <option value="argentinean">Argentinean</option>
                                <option value="armenian">Armenian</option>
                                <option value="australian">Australian</option>
                                <option value="austrian">Austrian</option>
                                <option value="azerbaijani">Azerbaijani</option>
                                <option value="bahamian">Bahamian</option>
                                <option value="bahraini">Bahraini</option>
                                <option value="bangladeshi">Bangladeshi</option>
                                <option value="barbadian">Barbadian</option>
                                <option value="barbudans">Barbudans</option>
                                <option value="batswana">Batswana</option>
                                <option value="belarusian">Belarusian</option>
                                <option value="belgian">Belgian</option>
                                <option value="belizean">Belizean</option>
                                <option value="beninese">Beninese</option>
                                <option value="bhutanese">Bhutanese</option>
                                <option value="bolivian">Bolivian</option>
                                <option value="bosnian">Bosnian</option>
                                <option value="brazilian">Brazilian</option>
                                <option value="british">British</option>
                                <option value="bruneian">Bruneian</option>
                                <option value="bulgarian">Bulgarian</option>
                                <option value="burkinabe">Burkinabe</option>
                                <option value="burmese">Burmese</option>
                                <option value="burundian">Burundian</option>
                                <option value="cambodian">Cambodian</option>
                                <option value="cameroonian">Cameroonian</option>
                                <option value="canadian">Canadian</option>
                                <option value="cape verdean">Cape Verdean</option>
                                <option value="central african">Central African</option>
                                <option value="chadian">Chadian</option>
                                <option value="chilean">Chilean</option>
                                <option value="chinese">Chinese</option>
                                <option value="colombian">Colombian</option>
                                <option value="comoran">Comoran</option>
                                <option value="congolese">Congolese</option>
                                <option value="costa rican">Costa Rican</option>
                                <option value="croatian">Croatian</option>
                                <option value="cuban">Cuban</option>
                                <option value="cypriot">Cypriot</option>
                                <option value="czech">Czech</option>
                                <option value="danish">Danish</option>
                                <option value="djibouti">Djibouti</option>
                                <option value="dominican">Dominican</option>
                                <option value="dutch">Dutch</option>
                                <option value="east timorese">East Timorese</option>
                                <option value="ecuadorean">Ecuadorean</option>
                                <option value="egyptian">Egyptian</option>
                                <option value="emirian">Emirian</option>
                                <option value="equatorial guinean">Equatorial Guinean</option>
                                <option value="eritrean">Eritrean</option>
                                <option value="estonian">Estonian</option>
                                <option value="ethiopian">Ethiopian</option>
                                <option value="fijian">Fijian</option>
                                <option value="filipino">Filipino</option>
                                <option value="finnish">Finnish</option>
                                <option value="french">French</option>
                                <option value="gabonese">Gabonese</option>
                                <option value="gambian">Gambian</option>
                                <option value="georgian">Georgian</option>
                                <option value="german">German</option>
                                <option value="ghanaian">Ghanaian</option>
                                <option value="greek">Greek</option>
                                <option value="grenadian">Grenadian</option>
                                <option value="guatemalan">Guatemalan</option>
                                <option value="guinea-bissauan">Guinea-Bissauan</option>
                                <option value="guinean">Guinean</option>
                                <option value="guyanese">Guyanese</option>
                                <option value="haitian">Haitian</option>
                                <option value="herzegovinian">Herzegovinian</option>
                                <option value="honduran">Honduran</option>
                                <option value="hungarian">Hungarian</option>
                                <option value="icelander">Icelander</option>
                                <option value="indian">Indian</option>
                                <option value="indonesian">Indonesian</option>
                                <option value="iranian">Iranian</option>
                                <option value="iraqi">Iraqi</option>
                                <option value="irish">Irish</option>
                                <option value="israeli">Israeli</option>
                                <option value="italian">Italian</option>
                                <option value="ivorian">Ivorian</option>
                                <option value="jamaican">Jamaican</option>
                                <option value="japanese">Japanese</option>
                                <option value="jordanian">Jordanian</option>
                                <option value="kazakhstani">Kazakhstani</option>
                                <option value="kenyan">Kenyan</option>
                                <option value="kittian and nevisian">Kittian and Nevisian</option>
                                <option value="kuwaiti">Kuwaiti</option>
                                <option value="kyrgyz">Kyrgyz</option>
                                <option value="laotian">Laotian</option>
                                <option value="latvian">Latvian</option>
                                <option value="lebanese">Lebanese</option>
                                <option value="liberian">Liberian</option>
                                <option value="libyan">Libyan</option>
                                <option value="liechtensteiner">Liechtensteiner</option>
                                <option value="lithuanian">Lithuanian</option>
                                <option value="luxembourger">Luxembourger</option>
                                <option value="macedonian">Macedonian</option>
                                <option value="malagasy">Malagasy</option>
                                <option value="malawian">Malawian</option>
                                <option value="malaysian">Malaysian</option>
                                <option value="maldivan">Maldivan</option>
                                <option value="malian">Malian</option>
                                <option value="maltese">Maltese</option>
                                <option value="marshallese">Marshallese</option>
                                <option value="mauritanian">Mauritanian</option>
                                <option value="mauritian">Mauritian</option>
                                <option value="mexican">Mexican</option>
                                <option value="micronesian">Micronesian</option>
                                <option value="moldovan">Moldovan</option>
                                <option value="monacan">Monacan</option>
                                <option value="mongolian">Mongolian</option>
                                <option value="moroccan">Moroccan</option>
                                <option value="mosotho">Mosotho</option>
                                <option value="motswana">Motswana</option>
                                <option value="mozambican">Mozambican</option>
                                <option value="namibian">Namibian</option>
                                <option value="nauruan">Nauruan</option>
                                <option value="nepalese">Nepalese</option>
                                <option value="new zealander">New Zealander</option>
                                <option value="ni-vanuatu">Ni-Vanuatu</option>
                                <option value="nicaraguan">Nicaraguan</option>
                                <option value="nigerien">Nigerien</option>
                                <option value="north korean">North Korean</option>
                                <option value="northern irish">Northern Irish</option>
                                <option value="norwegian">Norwegian</option>
                                <option value="omani">Omani</option>
                                <option value="pakistani">Pakistani</option>
                                <option value="palauan">Palauan</option>
                                <option value="panamanian">Panamanian</option>
                                <option value="papua new guinean">Papua New Guinean</option>
                                <option value="paraguayan">Paraguayan</option>
                                <option value="peruvian">Peruvian</option>
                                <option value="polish">Polish</option>
                                <option value="portuguese">Portuguese</option>
                                <option value="qatari">Qatari</option>
                                <option value="romanian">Romanian</option>
                                <option value="russian">Russian</option>
                                <option value="rwandan">Rwandan</option>
                                <option value="saint lucian">Saint Lucian</option>
                                <option value="salvadoran">Salvadoran</option>
                                <option value="samoan">Samoan</option>
                                <option value="san marinese">San Marinese</option>
                                <option value="sao tomean">Sao Tomean</option>
                                <option value="saudi">Saudi</option>
                                <option value="scottish">Scottish</option>
                                <option value="senegalese">Senegalese</option>
                                <option value="serbian">Serbian</option>
                                <option value="seychellois">Seychellois</option>
                                <option value="sierra leonean">Sierra Leonean</option>
                                <option value="singaporean">Singaporean</option>
                                <option value="slovakian">Slovakian</option>
                                <option value="slovenian">Slovenian</option>
                                <option value="solomon islander">Solomon Islander</option>
                                <option value="somali">Somali</option>
                                <option value="south african">South African</option>
                                <option value="south korean">South Korean</option>
                                <option value="spanish">Spanish</option>
                                <option value="sri lankan">Sri Lankan</option>
                                <option value="sudanese">Sudanese</option>
                                <option value="surinamer">Surinamer</option>
                                <option value="swazi">Swazi</option>
                                <option value="swedish">Swedish</option>
                                <option value="swiss">Swiss</option>
                                <option value="syrian">Syrian</option>
                                <option value="taiwanese">Taiwanese</option>
                                <option value="tajik">Tajik</option>
                                <option value="tanzanian">Tanzanian</option>
                                <option value="thai">Thai</option>
                                <option value="togolese">Togolese</option>
                                <option value="tongan">Tongan</option>
                                <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                <option value="tunisian">Tunisian</option>
                                <option value="turkish">Turkish</option>
                                <option value="tuvaluan">Tuvaluan</option>
                                <option value="ugandan">Ugandan</option>
                                <option value="ukrainian">Ukrainian</option>
                                <option value="uruguayan">Uruguayan</option>
                                <option value="uzbekistani">Uzbekistani</option>
                                <option value="venezuelan">Venezuelan</option>
                                <option value="vietnamese">Vietnamese</option>
                                <option value="welsh">Welsh</option>
                                <option value="yemenite">Yemenite</option>
                                <option value="zambian">Zambian</option>
                                <option value="zimbabwean">Zimbabwean</option>
                            </select>
                            <label class="signup-form-label signup-form-label-required">NATIONALITY</label>
                        </div>
                        <?php
                        if(!empty($nation_error))
                        {
                            ?><div class="error">
                                <p><?php echo $nation_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-group">
                            <input type="date" name="s_dob" class="signup-form-control">
                            <label class="signup-form-label signup-form-label-required">DATE OF BIRTH</label>
                        </div>
                        <?php
                        if(!empty($dob_error))
                        {
                            ?><div class="error">
                                <p><?php echo $dob_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-group">
                            <input type="text" name="s_address" class="signup-form-control" placeholder="">
                            <label class="signup-form-label signup-form-label-required">ADDRESS</label>
                        </div>
                        <?php
                        if(!empty($address_error))
                        {
                            ?><div class="error">
                                <p><?php echo $address_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-group">
                            <input type="text" name="s_phone" class="signup-form-control" placeholder="">
                            <label class="signup-form-label signup-form-label-required">PHONE NUMBER</label>
                        </div>
                        <?php
                        if(!empty($phone_error))
                        {
                            ?><div class="error">
                                <p><?php echo $phone_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-radio">
                            GENDER
                            <input type="radio" name="s_gender" class="radio-btn" value="male">Male 
                            <input type="radio" name="s_gender" class="radio-btn" value="female">Female
                        </div>
                        <?php
                        if(!empty($gender_error))
                        {
                            ?><div class="error">
                                <p><?php echo $gender_error?></p>
                            </div><?php
                        }
                        ?>
                    </div>

                    <div class="right-wrap">
                        <div class="signup-form-group">
                            <input type="text" name="s_father" class="signup-form-control" placeholder="">
                            <label class="signup-form-label signup-form-label-required">FATHER NAME</label>
                        </div>
                        <?php
                        if(!empty($father_error))
                        {
                            ?><div class="error">
                                <p><?php echo $father_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-group">
                            <input type="text" name="s_guard" class="signup-form-control" placeholder="">
                            <label class="signup-form-label signup-form-label-required">GUARDIAN PHONE NUMBER</label>
                        </div>
                        <?php
                        if(!empty($guard_error))
                        {
                            ?><div class="error">
                                <p><?php echo $guard_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-group">
                            <input type="password" name="s_pass" class="signup-form-control" placeholder="">
                            <label class="signup-form-label signup-form-label-required">PASSWORD</label>
                        </div>
                        <?php
                        if(!empty($pass_error))
                        {
                            ?><div class="error">
                                <p><?php echo $pass_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-group">
                            <input type="password" name="s_confirm" class="signup-form-control" placeholder="">
                            <label class="signup-form-label signup-form-label-required">CONFIRM PASSWORD</label>
                        </div>
                        <?php
                        if(!empty($confirm_error))
                        {
                            ?><div class="error">
                                <p><?php echo $confirm_error?></p>
                            </div><?php
                        }
                        ?>
                        <div class="signup-form-group">
                            <button type="submit" class="signup-form-submit-button">Sign Up</button>
                            <button type="submit" name="cancel_btn" class="signup-form-submit-button">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>