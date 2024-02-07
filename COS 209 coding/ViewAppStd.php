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
        <title>View Students</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">List of Applicants & Students</div>
                </div>

                <div class="lower">
                    <div class="view-table">
                        <div class="upper-view-table">
                            <center>
                                <form name="Select Payment" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="radio" name="v_app_std" value="applications">Applications 
                                    <input type="radio" name="v_app_std" value="students">Students
                                    <button type="submit">OKAY</button>
                                </form>
                            </center>
                        </div>

                        <div class="lower-view-table">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(empty($_POST['v_app_std']))
                                {
                                    ?><p class="error"><?php echo "Choose a table to view" ?></p><?php
                                }
                                else if($_POST['v_app_std'] == "applications")
                                {
                                    ?>
                                    <table>
                                        <th>Application ID</th>
                                        <th>Name</th>
                                        <th>NRC</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <?php
                                        $host = 'localhost';
                                        $user = 'root';
                                        $password = '';
                                        $database = 'cos209';
                                        $table_name = 'application';

                                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                                
                                        $sql = "SELECT * FROM $table_name";
                                        $query = $conn -> query($sql);
                                        while($row=$query->fetch_array()){

                                            if($row['Subject'] == "01")
                                            {
                                                $class = "HDIT";
                                            }
                                            else if($row['Subject'] == "02")
                                            {
                                                $class = "HDB";
                                            }
                                        ?> 
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['Aid']; ?></td>
                                                <td><?php echo $row['Aname']; ?></td>
                                                <td><?php echo $row['NRC']; ?></td>
                                                <td><?php echo $row['Aemail']; ?></td>
                                                <td><?php echo $class; ?></td>
                                                <td><?php echo $row['Adate']; ?></td>
                                                <td><?php echo $row['Status']; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php 
                                        }
                                        ?>
                                    </table>
                                    <?php
                                }
                                else if($_POST['v_app_std'] == "students")
                                {
                                    ?>
                                    <table>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Father</th>
                                        <th>Birthday</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Guardian Phone</th>
                                        <th>Status</th>
                                        <?php
                                        $host = 'localhost';
                                        $user = 'root';
                                        $password = '';
                                        $database = 'cos209';
                                        $table_name = 'student';
                                        $table_name1 = 'application';

                                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                        $sql = "SELECT $table_name.*, $table_name1.Aname FROM $table_name 
                                                INNER JOIN $table_name1 ON $table_name.Aid = $table_name1.Aid";

                                        $query = $conn -> query($sql);
                                        while($row=$query->fetch_array()){
                                        ?> 
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['Sid']; ?></td>
                                                <td><?php echo $row['Aname']; ?></td>
                                                <td><?php echo $row['FatherName']; ?></td>
                                                <td><?php echo $row['DOB']; ?></td>
                                                <td><?php echo $row['Address']; ?></td>
                                                <td><?php echo $row['PhoneNo']; ?></td>
                                                <td><?php echo $row['GuardianPhoneNo']; ?></td>
                                                <td><?php echo $row['Status']; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php 
                                        }
                                        ?>
                                    </table>
                                    <?php
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