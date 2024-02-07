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
        <title>BUC Employees</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">Managing BUC Admins</div>
                </div>

                <div class="lower">
                    <div class="view-table">
                        <div class="upper-view-table">
                            <center>
                                <form name="Select Admin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="text" name="s_aid" placeholder="Admin ID">
                                    <button name="select_btn" type="submit">Select</button>
                                    <button name="add_btn" type="submit">Add</button>
                                </form>
                            </center>
                        </div>

                        <div class="lower-view-table">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'admin';

                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                                if(isset($_POST['select_btn']))
                                {
                                    if(empty($_POST['s_aid']))
                                    {
                                        ?><p class="error"><?php echo "Fill Field" ?></p><?php
                                    }
                                    else
                                    {
                                        $sql = "SELECT * FROM $table_name WHERE AdminId='$_POST[s_aid]'";
                                        $query = $conn -> query($sql);
                                        while($row=$query->fetch_array()){
                                        ?> 
                                        <center>
                                            <form name="Manage Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                <p>ID</p>
                                                <input type="text" name="a_id" value="<?php echo $_POST['s_aid'] ?>" readonly>
                                                <p>Name</p>
                                                <input type="text" name="a_name" value="<?php echo $row['AdminName'] ?>">
                                                <p>Department</p>
                                                <input type="text" name="a_depart" value="<?php echo $row['Department'] ?>">
                                                <p>Position</p>
                                                <input type="text" name="a_position" value="<?php echo $row['Position'] ?>">
                                                <p>Email</p>
                                                <input type="text" name="a_email" value="<?php echo $row['Email'] ?>"><br>
                                                <button name="edit_btn" type="submit">Edit</button>
                                                <button name="del_btn" type="submit">Fire</button>
                                            </form>
                                        </center>
                                        <?php 
                                        }
                                    }
                                }
                                else if(isset($_POST['add_btn']))
                                {
                                    ?> 
                                    <center>
                                        <form name="Manage Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <p>ID</p>
                                            <input type="text" name="a_id">
                                            <p>Name</p>
                                            <input type="text" name="a_name">
                                            <p>Department</p>
                                            <input type="text" name="a_depart">
                                            <p>Position</p>
                                            <input type="text" name="a_position">
                                            <p>Email</p>
                                            <input type="text" name="a_email">
                                            <p>Password</p>
                                            <input type="text" name="a_password">
                                            <p>Confirm Password</p>
                                            <input type="text" name="a_confirm"><br>
                                            <button name="insert_btn" type="submit">Insert</button>
                                        </form>
                                    </center>
                                    <?php 
                                }

                                if(isset($_POST['edit_btn']))
                                {
                                    $query = "UPDATE $table_name SET AdminName='$_POST[a_name]', Department='$_POST[a_depart]', Position='$_POST[a_position]', Email='$_POST[a_email]' WHERE AdminId='$_POST[a_id]'";
                                    mysqli_query($conn, $query);
                                    mysqli_close($conn);
                                    ?><script> alert("Successfully Edited!"); </script><?php
                                    header("Refresh: 0");
                                }

                                if(isset($_POST['insert_btn']))
                                {
                                    $query = "INSERT INTO $table_name(AdminId, AdminName, Department, Position, Email, Password) VALUES('$_POST[a_id]', '$_POST[a_name]', '$_POST[a_depart]', '$_POST[a_position]', '$_POST[a_email]', '$_POST[a_confirm]')";
                                    mysqli_query($conn, $query);
                                    mysqli_close($conn);
                                    ?><script> alert("Successfully Inserted!"); </script><?php
                                    header("Refresh: 0");
                                }

                                if(isset($_POST['del_btn']))
                                {
                                    $query = "DELETE FROM $table_name WHERE AdminId = '$_POST[a_id]'";
                                    mysqli_query($conn, $query);
                                    mysqli_close($conn);
                                    ?><script> alert("Successfully Fired!"); </script><?php
                                    header("Refresh: 0");
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="lower">
                    <div class="view-table">
                        <div class="lower-view-table">
                            <table>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Email</th>
                                <?php
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'admin';
                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                                
                                $sql = "SELECT * FROM $table_name";
                                $query = $conn -> query($sql);
                                while($row=$query->fetch_array()){
                                ?> 
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['AdminId']; ?></td>
                                        <td><?php echo $row['AdminName']; ?></td>
                                        <td><?php echo $row['Department']; ?></td>
                                        <td><?php echo $row['Position']; ?></td>
                                        <td><?php echo $row['Email']; ?></td>
                                    </tr>
                                </tbody>
                            <?php 
                                }
                            ?>
                            </table>
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