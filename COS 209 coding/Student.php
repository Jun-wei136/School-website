<?php
session_start();
if(!isset($_SESSION["sess_sid"]))
{
 header("Location: Home.php");
}
else {
?>
<html>
    <head>
	    <meta charset="utf-8">
    	<title>Student Portal</title>
    	<link rel="stylesheet" href="Student.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
        <script>
            function confirmLogout()
            {
                var result = confirm("Are you sure you want to log out?");
                if(result)
                {
                    window.location.href = "Logout.php";
                }
            }
        </script>
    </head>

    <body>
        <?php
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cos209';
        $table_name = 'student';
        $table_name1 = 'application';
        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

        $query = "SELECT * FROM $table_name INNER JOIN $table_name1 ON $table_name.Aid = $table_name1.Aid
                  WHERE $table_name.Sid = '$_SESSION[sess_sid]'";

        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['sess_name'] = $myrow['Aname'];
        mysqli_close($conn);
        ?>

        <div class="wrapper">
            <div class="sidebar">
                <center><img src="<?php echo $myrow['Apicture']; ?>" width="120px"></center>
                <br>
                <h3><?php echo $myrow['Aname'] ?></h3>
                <h3>Student ID - <?php echo $myrow['Sid'] ?></h3>
                <br>
                <ul>
                    <li><a href="#">Profile</a></li>
                    <li><a href="StdEdit.php" class="small-list">Edit Profile Information</a></li>
                    <li><a href="StdChange.php" class="small-list">Change Password</a></li>
                    <li><a href="StdForum.php">Forum</a></li>
                    <li><a href="StdClass.php">Classes</a></li>
                    <li><a href="Finance.php">Finance</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul> 
            </div>

            <div class="main_content">
                <div class="upper">
                    MY PROFILE
                </div>

                <div class="lower">
                    <div class="image-container">
                        <div class="card">
                            <br><h2>Email</h2><br><?php echo $myrow['Aemail'] ?>
                        </div>

                        <div class="card">
                            <br><h2>NRC</h2><br><?php echo $myrow['NRC'] ?>
                        </div>

                        <div class="card">
                            <br><h2>Date of Birth</h2><br><?php echo $myrow['DOB'] ?>
                        </div>
        
                        <div class="card">
                            <br><h2>Gender</h2><br><?php echo $myrow['Gender'] ?>
                        </div>
        
                        <div class="card">
                            <br><h2>Nationality</h2><br><?php echo $myrow['Nationality'] ?>
                        </div>
        
                        <div class="card">
                            <br><h2>Father Name</h2><br><?php echo $myrow['FatherName'] ?>
                        </div>
        
                        <div class="card">
                            <br><h2>Address</h2><br><?php echo $myrow['Address'] ?>
                        </div>
        
                        <div class="card">
                            <br><h2>Phone Number</h2><br><?php echo $myrow['PhoneNo'] ?>
                        </div>
        
                        <div class="card">
                            <h2>Guardian Phone Number</h2><br><?php echo $myrow['GuardianPhoneNo'] ?>
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