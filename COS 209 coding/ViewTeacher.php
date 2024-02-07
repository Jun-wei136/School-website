<?php
session_start();
if(!isset($_SESSION["sess_aid"]))
{
 header("Location: Home.php");
 exit();
}
else {
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>BUC Teachers</title>
        <link rel="stylesheet" href="AdminFunction.css">
        <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="upper">
                    <div class="left-upper"><a href="Admin.php"><</a></div>
                    <div class="title-upper">Managing Teachers And Modules</div>
                </div>

                <div class="lower">
                    <div class="left-lower">
                        <div class="left-lower-top">
                            <center><h1>MODULE LIST</h1></center>
                        </div>

                        <div class="left-lower-bottom">
                            <?php
                            $host = 'localhost';
                            $user = 'root';
                            $password = '';
                            $database = 'cos209';
                            $table_name = 'teacher';
                            $table_name1 = 'module';
                            $table_name2 = 'course';

                            $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");
                            ?>
                            <table>
                                <th>Module</th>
                                <th>Teacher ID</th>
                                <th>Teacher Name</th>
                                <th>Subject</th>
                                <th>Classroom</th>
                                <th>Teacher Status</th>
                                <?php
                        
                                $sql = "SELECT $table_name.*, $table_name2.Cname, $table_name1.Mid, $table_name1.Classroom FROM $table_name 
                                        LEFT JOIN $table_name1 ON $table_name.Tid = $table_name1.Tid
                                        LEFT JOIN $table_name2 ON $table_name1.Cid = $table_name2.Cid";
                                        
                                $query = $conn -> query($sql);
                                while($row=$query->fetch_array()){
                                ?> 
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['Mid']; ?></td>
                                        <td><?php echo $row['Tid']; ?></td>
                                        <td><?php echo $row['Tname']; ?></td>
                                        <td><?php echo $row['Cname']; ?></td>
                                        <td><?php echo $row['Classroom']; ?></td>
                                        <td><?php echo $row['Status']; ?></td>
                                    </tr>
                                </tbody>
                                <?php 
                                }
                                ?>
                            </table>
                        </div>
                    </div>

                    <div class="right-lower">
                        <div class="right-lower-top">
                            <center>
                                <form name="Search Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="text" name="s_module" placeholder="Teacher/Module ID"> 
                                    <button type="submit" name="search_btn">Search</button><br>
                                    <select name="s_insert">
                                        <option value="teacher">TEACHER</option>
                                        <option value="module">MODULE</option>
                                    </select>
                                    <button type="submit" name="insert_btn">Insert</button>
                                </form>
                            </center>
                        </div>

                        <div class="right-lower-bottom">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'teacher';
                                $table_name1 = 'module';

                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                if(isset($_POST['search_btn']))
                                {
                                    if(empty($_POST['s_module']))
                                    {
                                        ?><div class="error-msg"><?php echo "Type in teacher ID or module ID." ?></div><?php
                                    }
                                    else
                                    {
                                        if(ctype_digit(substr($_POST['s_module'], 0, 1)))
                                        {
                                            $query = "SELECT * FROM $table_name WHERE Tid='$_POST[s_module]'";
                                            mysqli_select_db($conn, $database);
                                            $result = mysqli_query($conn, $query);
                                            $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                            if(empty($myrow))
                                            {
                                                ?>
                                                <script>
                                                    window.alert("Invalid ID!");
                                                </script>
                                                <?php
                                            }
                                            else
                                            {
                                                if($myrow['Status'] == "Resigned")
                                                {
                                                    ?>
                                                    <script>
                                                        window.alert("Cannot edit resigned teacher!");
                                                    </script>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <center>
                                                        <form name="Teacher Select" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                            <input type="text" name="s_tid" value="<?php echo $myrow['Tid'] ?>" readonly><br>
                                                            <input type="text" name="s_tname" value="<?php echo $myrow['Tname'] ?>"><br>
                                                            <button type="submit" name="edit_teach_btn">Edit</button><br>
                                                            <button type="submit" name="del_teach_btn">Delete</button>
                                                        </form>
                                                    </center>
                                                    <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                            $query = "SELECT * FROM $table_name1 WHERE Mid='$_POST[s_module]'";
                                            mysqli_select_db($conn, $database);
                                            $result = mysqli_query($conn, $query);
                                            $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                            $sql = "SELECT Tid, Tname FROM $table_name WHERE Status='Working'";
                                            $query1 = $conn -> query($sql);
                                            $options = "";
            
                                            while($row=$query1->fetch_array()){
                                                $options .= "<option value='".$row['Tid']."'>".$row['Tid']."/".$row['Tname']."</option>";
                                            }

                                            if(empty($myrow))
                                            {
                                                ?>
                                                <script>
                                                    window.alert("Invalid ID!");
                                                </script>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <center>
                                                    <form name="Module Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                        <input type="text" name="s_mid" value="<?php echo $myrow['Mid'] ?>" readonly><br>
                                                        <select name="s_cid">
                                                            <option value="01" 
                                                            <?php 
                                                            if($myrow['Cid'] == "01"){ echo "selected";} 
                                                            ?>>HDIT</option>
                                                            <option value="02"
                                                            <?php
                                                            if($myrow['Cid'] == "02"){ echo "selected";}
                                                            ?>>HDB</option>
                                                        </select><br>
                                                        <select name="s_tid">
                                                            <?php echo $options ?>
                                                        </select><br>
                                                        <input type="text" name="s_classroom" value="<?php echo $myrow['Classroom'] ?>"><br>
                                                        <button type="submit" name="edit_module_btn">Edit</button><br>
                                                        <button type="submit" name="del_module_btn">Delete</button>
                                                    </form>
                                                </center>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                if(isset($_POST['insert_btn']))
                                {
                                    if($_POST['s_insert'] == "teacher")
                                    {
                                        ?>
                                        <center>
                                            <form name="Teacher Select" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                <input type="text" name="s_tname" placeholder="Teacher Name"><br>
                                                <button type="submit" name="insert_teach_btn">Insert</button>
                                            </form>
                                        </center>
                                        <?php
                                    }
                                    else if($_POST['s_insert'] == "module")
                                    {
                                        $sql = "SELECT Tid, Tname FROM $table_name";
                                        $query = $conn -> query($sql);
                                        $options = "";

                                        while($row=$query->fetch_array()){
                                            $options .= "<option value='".$row['Tid']."'>".$row['Tid']."/".$row['Tname']."</option>";
                                        }
                                        ?>
                                        <center>
                                            <form name="Teacher Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                <input type="text" name="s_mid" placeholder="Module ID"><br>
                                                <select name="s_cid">
                                                    <option value="">--Select--</option>
                                                    <option value="01">HDIT</option>
                                                    <option value="02">HDB</option>
                                                </select><br>
                                                <select name="s_tid">
                                                    <?php echo $options ?>
                                                </select><br>
                                                <input type="text" name="s_classroom" placeholder="Classroom"><br>
                                                <button type="submit" name="insert_module_btn">Insert</button>
                                            </form>
                                        </center>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $database = 'cos209';
                                $table_name = 'teacher';
                                $table_name1 = 'module';
                                $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

                                if(isset($_POST['edit_teach_btn']))
                                {
                                    if(empty($_POST['s_tname']))
                                    {
                                        ?>
                                        <script>window.alert("Please fill the field!");</script>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <script>
                                            var result = confirm("Edit this teacher info?");
                                            if(result)
                                            {
                                                console.log("User clicked OK");
                                                <?php
                                                $query = "UPDATE $table_name SET Tid='$_POST[s_tid]', Tname='$_POST[s_tname]' WHERE Tid='$_POST[s_tid]'";
                                                mysqli_query($conn, $query);
                                                header("Refresh: 0");
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
                                else if(isset($_POST['del_teach_btn']))
                                {
                                    ?>
                                    <script>
                                        var result = confirm("Delete this teacher?");
                                        if(result)
                                        {
                                            console.log("User clicked OK");
                                            <?php
                                            $query = "DELETE FROM $table_name1 WHERE Tid='$_POST[s_tid]'";
                                            $query1 = "UPDATE $table_name SET Status='Resigned' WHERE Tid='$_POST[s_tid]'";
                                            mysqli_query($conn, $query);
                                            mysqli_query($conn, $query1);
                                            mysqli_close($conn);
                                            header("Refresh: 0");
                                            ?>
                                        }
                                        else
                                        {
                                            console.log("User clicked Cancel");
                                        }
                                    </script>
                                    <?php
                                }
                                else if(isset($_POST['insert_teach_btn']))
                                {
                                    if(empty($_POST['s_tname']))
                                    {
                                        ?>
                                        <script>window.alert("Please fill the field!");</script>
                                        <?php
                                    }
                                    else
                                    {
                                        $query = "INSERT INTO $table_name(Tname, Status) VALUES('$_POST[s_tname]', 'Working')";

                                        mysqli_query($conn, $query);
                                        mysqli_close($conn);
                                    }
                                }
                                else if(isset($_POST['edit_module_btn']))
                                {
                                    ?>
                                    <script>
                                        var result = confirm("Edit this module?");
                                        if(result)
                                        {
                                            console.log("User clicked OK");
                                            <?php
                                            if(empty($_POST['s_mid']) || empty($_POST['s_classroom']))
                                            {
                                                ?>
                                                <script>window.alert("Please fill the field!");</script>
                                                <?php
                                            }
                                            else
                                            {
                                                $query = "UPDATE $table_name1 SET Tid='$_POST[s_tid]', Cid='$_POST[s_cid]', Classroom='$_POST[s_classroom]' WHERE Mid='$_POST[s_mid]'";
                                                mysqli_query($conn, $query);
                                                header("Refresh: 0");
                                                mysqli_close($conn);
                                            }
                                            ?>
                                        }
                                        else
                                        {
                                            console.log("User clicked Cancel");
                                        }
                                    </script>
                                    <?php
                                }
                                else if(isset($_POST['del_module_btn']))
                                {
                                    ?>
                                    <script>
                                        var result = confirm("Delete this module?");
                                        if(result)
                                        {
                                            console.log("User clicked OK");
                                            <?php
                                            $query = "DELETE FROM $table_name1 WHERE Mid='$_POST[s_mid]'";
                                            mysqli_query($conn,$query);
                                            header("Refresh: 0");
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
                                else if(isset($_POST['insert_module_btn']))
                                {
                                    if(empty($_POST['s_mid']) || empty($_POST['s_cid']) || empty($_POST['s_classroom']))
                                    {
                                        ?>
                                        <script>window.alert("Please fill the field!");</script>
                                        <?php
                                    }
                                    else
                                    {
                                        $query = "INSERT INTO $table_name1(Mid, Cid, Tid, Classroom) VALUES('$_POST[s_mid]', '$_POST[s_cid]', '$_POST[s_tid]', '$_POST[s_classroom]')";
                                        mysqli_query($conn, $query);
                                        mysqli_close($conn);
                                    }
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