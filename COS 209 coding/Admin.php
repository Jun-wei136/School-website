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
        <title>Admin Page</title>
        <link rel="stylesheet" href="Admin.css">
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
        
        <?php
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cos209';
        $table_name = 'admin';

        $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

        $query = "SELECT * FROM $table_name WHERE AdminId = '$_SESSION[sess_aid]'";

        mysqli_select_db($conn, $database);
        $result = mysqli_query($conn, $query);
        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

        mysqli_close($conn);

        $department = $myrow['Department'];
        $position = $myrow['Position'];
        function Permission($department, $position, $button)
        {
            $permission = [
                "Finance" => [
                    "Junior" => ["view_pay", "search_pay_finance"],
                    "Senior" => ["view_pay", "view_finance", "insert_finance"],
                    "Manager" => ["view_all_finance"]
                ],

                "Student Service" => [
                    "Junior" => ["insert_register"],
                    "Senior" => ["view_app_student", "edit_student"],
                    "Manager" => ["approve", "view_major"]
                ],

                "Head" => [
                    "CEO" => ["view_all_finance", "view_teacher", "percent_app_student_enroll", "update_admin"]
                ],

                "Student Support" => [
                    "Staff" => ["search_pay_finance", "manage_forum"] 
                ]
            ];

            return in_array($button, $permission[$department][$position]);
        }
        ?>
    </head>

    <body>
        <div class="wrapper">
            <div class="main_content">
                <div class="card">
                    <div class="upper-card">
                        <img src="Images/logo_org.jpg"></img>
                        <p><?php echo $_SESSION['sess_aid'] ?></p>
                        <p>Name - <?php echo $myrow['AdminName'] ?></p>
                        <p>Department - <?php echo $department ?></p>
                        <p>Position - <?php echo $position ?></p>
                    </div>
                    
                    <div class="lower-card">
                        <?php if (Permission($department, $position, "view_pay")): ?>
                        <div class="button-wrap">
                        <a href="ViewPay.php"><button>Payments</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "search_pay_finance")): ?>
                        <div class="button-wrap">
                        <a href="SearchFinance.php"><button>Search</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "view_finance")): ?>
                        <div class="button-wrap">
                        <a href="ViewFinance.php"><button>Finance</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "insert_finance")): ?>
                        <div class="button-wrap">
                        <a href="Receive.php"><button>Receive</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "view_all_finance")): ?>
                        <div class="button-wrap">
                        <a href="TotalFinance.php"><button>Finance</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "insert_register")): ?>
                        <div class="button-wrap">
                        <a href="Application.php"><button>Register</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "view_app_student")): ?>
                        <div class="button-wrap">
                        <a href="ViewAppStd.php"><button>View</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "edit_student")): ?>
                        <div class="button-wrap">
                        <a href="SSSearch.php"><button>Edit Student</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "approve")): ?>
                        <div class="button-wrap">
                        <a href="Approve.php"><button>Approve</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "view_major")): ?>
                        <div class="button-wrap">
                        <a href="ViewMajor.php"><button>Students</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "view_teacher")): ?>
                        <div class="button-wrap">
                        <a href="ViewTeacher.php"><button>Teachers</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "percent_app_student_enroll")): ?>
                        <div class="button-wrap">
                        <a href="Statistics.php"><button>Statistics</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "update_admin")): ?>
                        <div class="button-wrap">
                        <a href="Employee.php"><button>Employees</button></a>
                        </div>
                        <?php endif; ?>

                        <?php if (Permission($department, $position, "manage_forum")): ?>
                        <div class="button-wrap">
                        <a href="SuForum.php"><button>Forum</button></a>
                        </div>
                        <?php endif; ?>

                        <div class="button-wrap">
                        <a href="#" onclick="confirmLogout()"><button>Logout</button></a>
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