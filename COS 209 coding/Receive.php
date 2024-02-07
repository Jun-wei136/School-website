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
        <title>Receive Payment</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">Receiving School Fee</div>
                </div>

                <div class="lower">
                    <div class="view-table">
                    <div class="upper-view-table">
                        <center>
                            <form name="Select Payment" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="text" name="f_sid" placeholder="Student ID">
                                <button name="select_btn" type="submit">Select</button>
                            </form>
                        </center>
                        </div>

                        <div class="lower-view-table">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(isset($_POST['select_btn']))
                                {
                                    if(empty($_POST['f_sid']))
                                    {
                                        ?><p class="error"><?php echo "Fill field!" ?></p><?php
                                    }
                                    else
                                    {
                                        ?>
                                        <table>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Enrolled Date</th>
                                            <th>Status</th>
                                            <?php
                                            $host = 'localhost';
                                            $user = 'root';
                                            $password = '';
                                            $database = 'cos209';
                                            $table_name = 'enroll';
                                            $table_name1 = 'student';
                                            $table_name2 = 'application';
                
                                            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                
                                            $sql = "SELECT * FROM $table_name WHERE Sid='$_POST[f_sid]'";
                
                                            $sql1 = "SELECT Aname FROM $table_name2 WHERE Aid=(SELECT Aid FROM $table_name1 WHERE Sid='$_POST[f_sid]')";
                                            mysqli_select_db($conn, $database);
                                            $result = mysqli_query($conn, $sql1);
                                            $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                        
                                            $query = $conn -> query($sql);
                                            while($row=$query->fetch_array()){
                
                                                if($row['Cid'] == "01")
                                                {
                                                    $class = "HDIT";
                                                }
                                                else if($row['Cid'] == "02")
                                                {
                                                    $class = "HDB";
                                                }
                                            ?> 
                                            <tbody>
                                                <tr id="row_<?php echo $row['Eid']; ?>">
                                                    <td><?php echo $row['Sid']; ?></td>
                                                    <td><?php echo $myrow['Aname']; ?></td>
                                                    <td><?php echo $class; ?></td>
                                                    <td><?php echo $row['EnrolledDate']; ?></td>
                                                    <td><?php echo $row['Status']; ?></td>
                                                    <td>
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                        <input type="hidden" name="eid" value="<?php echo $row['Eid']; ?>">
                                                        <button name="receive_btn" type="submit">Receive</button>
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
                                
                                if(isset($_POST['receive_btn']))
                                {
                                    $_SESSION['sess_eid'] = $_POST['eid'];
                                    header("Location: Pay.php");
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