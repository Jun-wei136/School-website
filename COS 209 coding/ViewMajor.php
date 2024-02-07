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
        <title>Student By Major</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">BUC Students</div>
                </div>

                <div class="lower">
                    <div class="view-table">
                        <div class="upper-view-table">
                            <center>
                                <form name="Select Payment" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="radio" name="v_major" value="hdit">HDIT 
                                    <input type="radio" name="v_major" value="hdb">HDB
                                    <button type="submit" name="search_btn">OKAY</button>
                                </form>
                            </center>
                        </div>

                        <div class="lower-view-table">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(isset($_POST['search_btn']))
                                {
                                    if(empty($_POST['v_major']))
                                    {
                                        ?><p class="error"><?php echo "Choose a table to view." ?></p><?php
                                    }
                                    else if($_POST['v_major'] == "hdit")
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
                                    
                                            $sql = "SELECT $table_name.*, $table_name2.Aname FROM $table_name
                                                    LEFT JOIN $table_name1 ON $table_name.Sid = $table_name1.Sid
                                                    LEFT JOIN $table_name2 ON $table_name1.Aid = $table_name2.Aid
                                                    WHERE Cid='01'";

                                            $query = $conn -> query($sql);
                                            while($row=$query->fetch_array()){
                                            ?> 
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $row['Sid']; ?></td>
                                                    <td><?php echo $row['Aname']; ?></td>
                                                    <td><?php echo "HDIT"; ?></td>
                                                    <td><?php echo $row['EnrolledDate']; ?></td>
                                                    <td><?php echo $row['Status']; ?></td>
                                                    <td>
                                                        <?php
                                                        if($row['Status'] == "Studying")
                                                        {
                                                            ?>
                                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                                    <input type="hidden" name="eid" value="<?php echo $row['Eid']; ?>">
                                                                    <button type="submit" name="fail_btn">Fail</button>
                                                                    <button type="submit" name="finish_btn">Finish</button>
                                                                </form>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <?php 
                                            }
                                            ?>
                                        </table>
                                        <?php
                                    }
                                    else if($_POST['v_major'] == "hdb")
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
                                    
                                            $sql = "SELECT $table_name.*, $table_name2.Aname FROM $table_name
                                                    LEFT JOIN $table_name1 ON $table_name.Sid = $table_name1.Sid
                                                    LEFT JOIN $table_name2 ON $table_name1.Aid = $table_name2.Aid
                                                    WHERE Cid='02'";

                                            $query = $conn -> query($sql);
                                            while($row=$query->fetch_array()){
                                            ?> 
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $row['Sid']; ?></td>
                                                    <td><?php echo $row['Aname']; ?></td>
                                                    <td><?php echo "HDB"; ?></td>
                                                    <td><?php echo $row['EnrolledDate']; ?></td>
                                                    <td><?php echo $row['Status']; ?></td>
                                                    <td>
                                                        <?php
                                                        if($row['Status'] == "Studying")
                                                        {
                                                            ?>
                                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                                    <input type="hidden" name="eid" value="<?php echo $row['Eid']; ?>">
                                                                    <button type="submit" name="fail_btn">Fail</button>
                                                                    <button type="submit" name="finish_btn">Finish</button>
                                                                </form>
                                                            <?php
                                                        }
                                                        ?>
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
                                else if(isset($_POST['fail_btn']))
                                {
                                    ?>
                                    <script>
                                        var result = confirm("Is this student failing?");
                                        if(result)
                                        {
                                            console.log("User clicked OK");
                                            <?php
                                            $host = 'localhost';
                                            $user = 'root';
                                            $password = '';
                                            $database = 'cos209';
                                            $table_name = 'enroll';

                                            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                            $query = "UPDATE $table_name SET Status='Failed' WHERE Eid = '$_POST[eid]'";

                                            mysqli_query($conn, $query);
                                            mysqli_close($conn);
                                            ?>
                                        }
                                        else
                                        {
                                            console.log("User clicked Cancel");
                                        }
                                    </script>
                                    <?php
                                }
                                else if(isset($_POST['finish_btn']))
                                {
                                    ?>
                                    <script>
                                        var result = confirm("Is this student finished?");
                                        if(result)
                                        {
                                            console.log("User clicked OK");
                                            <?php
                                            $host = 'localhost';
                                            $user = 'root';
                                            $password = '';
                                            $database = 'cos209';
                                            $table_name = 'enroll';

                                            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                            $query = "UPDATE $table_name SET Status='Finished' WHERE Eid = '$_POST[eid]'";

                                            mysqli_query($conn, $query);
                                            mysqli_close($conn);
                                            ?>
                                        }
                                        else
                                        {
                                            console.log("User clicked Cancel");
                                        }
                                    </script>
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