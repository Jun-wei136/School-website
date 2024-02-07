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
        <title>Admission</title>
        <link rel="stylesheet" type="text/css" href="Approve.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">Applied Candidate Forms</div>
                </div>

                <div class="lower">
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        $host = 'localhost';
                        $user = 'root';
                        $password = '';
                        $database = 'cos209';
                        $table_name = 'application';
                
                        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                        if(isset($_POST['approve_btn']))
                        {
                            ?>
                            <script>
                                var result = confirm("Approve this applicant?");
                                if(result)
                                {
                                    console.log("User clicked OK");
                                    <?php
                                    $query = "UPDATE $table_name SET Status = 'Approved' WHERE Aid = $_POST[id]";
                                    mysqli_query($conn, $query);
            
                                    $table_name1 = 'student';
                                    $query1 = "INSERT INTO $table_name1(Aid) VALUES('$_POST[id]')";
                                    mysqli_query($conn, $query1);
            
                                    $query2 = "SELECT Sid FROM $table_name1 WHERE Aid='$_POST[id]'";
                                    mysqli_select_db($conn, $database);
                                    $result = mysqli_query($conn, $query2);
                                    $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    $sid = $myrow['Sid'];
            
                                    $table_name2 = 'enroll';
                                    $query3 = "INSERT INTO $table_name2(Cid, Sid, EnrolledDate, Status) VALUES('$_POST[subject]', '".$sid."', CURDATE(), 'Studying')";
                                    mysqli_query($conn, $query3);
            
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
                        else if(isset($_POST['reject_btn']))
                        {
                            ?>
                            <script>
                                var result = confirm("Reject this applicant?");
                                if(result)
                                {
                                    console.log("User clicked OK");
                                    <?php
                                    $query = "UPDATE $table_name SET Status = 'Rejected' WHERE Aid = $_POST[id]";
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

                    <center>
                        <table>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Passport pic</th>
                            <th>NRC</th>
                            <th>NRC pic</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Applied Date</th>
                            <th>Diploma pic</th>
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
                            ?> 
                            <tbody>
                                <tr id="row_<?php echo $row['Aid']; ?>">
                                    <td><?php echo $row['Aid']; ?></td>
                                    <td><?php echo $row['Aname']; ?></td>
                                    <td><img src="<?php echo $row['Apicture']; ?>"></td>
                                    <td><?php echo $row['NRC']; ?></td>
                                    <td><img src="<?php echo $row['NRCpicture']; ?>"></td>
                                    <td><?php echo $row['Aemail']; ?></td>
                                    <td><?php
                                        if($row['Subject'] == "01")
                                        {
                                            echo "HDIT";
                                        }
                                        else 
                                        {
                                            echo "HDB";
                                        }
                                        ?></td>
                                    <td><?php echo $row['Adate']; ?></td>
                                    <td><img src="<?php echo $row['HighschoolDiploma']; ?>"></td>
                                    <td>
                                        <?php
                                        if($row['Status'] == "Pending")
                                        {
                                            ?>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['Aid']; ?>">
                                                <input type="hidden" name="subject" value="<?php echo $row['Subject']; ?>">
                                                <button type="submit" name="approve_btn">Approve</button><br>
                                                <button type="submit" name="reject_btn">Reject</button>
                                            </form>
                                            <?php
                                        }
                                        else
                                        {
                                            echo $row['Status'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                            <?php 
                            }
                            ?>
                        </table>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>