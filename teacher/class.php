<?php
include "../conn.php";

if (empty($_SESSION['email'])) {
?>
    <script>
        alert("Session Expired!");
        location.href = "../index.php";
    </script>
<?php
} else {
    $e = $_SESSION['email'];
    $get_admin = mysqli_query($conn, "SELECT * FROM teacher WHERE email='$e'");

    while ($admin = mysqli_fetch_object($get_admin)) {
        $lastname = $admin->lastname;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <!-- bootstrap 5 icons cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <!-- data tables -->
    <link href="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/kt-2.8.2/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/sr-1.2.2/datatables.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/kt-2.8.2/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/sr-1.2.2/datatables.min.js"></script>


    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
            height: 100vh;

        }
    </style>
    <title>Teacher's Page</title>
</head>


<body>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->

        <!-- Modal for adding Teacher-->
        <div class="modal fade" id="addteacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="teacher_process.php" method="POST" enctype="multipart/form-data">

                            <div class="row">


                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-fonts"></i></div>
                                        <input type="text" class="form-control" name="sub_code" placeholder="Subject Code" required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-type"></i></div>
                                        <input type="text" name="sub_desc" class="form-control" placeholder="Subject Description" required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-123"></i></div>
                                        <input type="text" name="section" class="form-control" placeholder="Section" required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-calendar"></i></div>
                                        <input type="date" name="date" class="form-control" placeholder="Date">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-clock"></i></div>
                                        <input type="time" name="time" class="form-control" placeholder="Time">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-123"></i></div>
                                        <input type="text" name="room" class="form-control" placeholder="Room Number">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-palette"></i></div>
                                        <input type="color" id="favcolor" name="favcolor" value="#ff0000" class="rounded-circle">
                                    </div>
                                </div>
                                <input type="hidden" name="email" value="<?php echo $e; ?>">


                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-primary" value="CLEAR">
                                <input type="submit" class="btn btn-success" name="create_class" value="CREATE">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->

            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between bg-dark text-light">
                    <a href="index.php" class="text-nowrap logo-img">
                        <!--<img src="assets/images/logos/dark-logo.svg" width="180" alt="" />-->
                        <h5 class="text-light">Teacher's page</h5>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="index.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">UI COMPONENTS</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" data-bs-toggle="modal" data-bs-target="#addteacher" href="" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                    Create Class
                                </span>

                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="class_list.php" aria-expanded="false">
                                <span>
                                    <i class="bi bi-x-circle-fill"></i>
                                    Close Class
                                </span>

                            </a>
                        </li>


                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header bg-dark">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>

                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="assets/images/1.png" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="profile.php" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="logout.php" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-power fs-6"></i>
                                            <p class="mb-0 fs-3">Logout</p>
                                        </a>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->

                <div class="modal" id="add_student" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Students at Risk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="teacher_process.php" method="POST" enctype="multipart/form-data">
                                    <input type="file" class="form-control" name="file" accept=".csv">
                                    <input type="hidden" name="teacher_email" value="<?php echo $e; ?>">
                                    <input type="hidden" name="semester" value="<?php echo $semester ?>">
                                    <input type="hidden" name="school_year" value="<?php echo $schoolyear ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $_GET['id']; ?>">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="file_upd" class="btn btn-primary">Upload</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#add_student">Add Star</button>
                    </div>
                    <div class="container mt-3">
                        <!--<h2>Toggleable Tabs</h2>-->
                        <br>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">P1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1">P2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu2">P3</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="home" class="container tab-pane active"><br>
                                <h3>P1</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Section</th>
                                            <th>Action 1</th>
                                            <th>Action 2 </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $class_id = $_GET['id'];
                                        
                                        $teach_email = $_GET['teacher_email'];

                                        $_SESSION['class_id'] = $class_id;
                                        $get_star = mysqli_query($conn, "SELECT * FROM student_risk_tbl WHERE class_id= '$class_id' AND term = 'p1'");
                                        while ($star = mysqli_fetch_array($get_star)) {
                                            $id_num = $star['id_number'];
                                            $get_parent = mysqli_query($conn, "SELECT * FROM parents_info WHERE student_id_number ='$id_num'");
                                            while ($parent = mysqli_fetch_object($get_parent)) {
                                                $guardian_email = $parent->guardians_email;
                                            }


                                        ?>
                                            <tr>
                                                <td><?= $star['id_number']; ?></td>
                                                <td><?= $star['firstname']; ?></td>
                                                <td><?= $star['lastname']; ?></td>
                                                <td><?= $star['section']; ?></td>
                                                <td><a href="" data-bs-toggle="modal" data-bs-target="#send_email<?php echo $star['id']; ?>">Send Email to Parents</a></td>
                                                <td><a href="" data-bs-toggle="modal" data-bs-target="#action_taken<?php echo $star['id']; ?>">Action Taken</a></td>
                                            </tr>
                                            <div class="modal" id="send_email<?php echo $star['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Email</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="teacher_process.php" method="POST">
                                                                <label class="px-2">To:</label>
                                                                <input type="email" name="email" readonly class="form-control" value="<?php echo $guardian_email; ?>" required placeholder="Enter Email">
                                                                <label class="px-2">CC:</label>
                                                                <input type="email" name="cc" readonly class="form-control" value="deejaybarredo@gmail.com" required placeholder="Add CC"><br>
                                                                <label class="px-2">Message</label>
                                                                <textarea name="message" cols="30" rows="10" class="form-control empty-top"></textarea>
                                                                <input type="hidden" name="teach_email" value="<?php echo $teach_email; ?>">
                                                                <input type="hidden" name="class_id" value="<?php echo $_SESSION['class_id']; ?>">
                                                                <input type="hidden" name="star_id" value="<?php echo $star['id']; ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="send_email" class="btn btn-primary">Send</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal" id="action_taken<?php echo $star['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Email</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="teacher_process.php" method="POST">
                                                                <label class="px-2">To:</label>
                                                                <input type="email" name="email" readonly class="form-control" value="<?php echo $guardian_email; ?>" required placeholder="Enter Email">
                                                                <label class="px-2">CC:</label>
                                                                <input type="email" name="cc" value="deejaybarredo@gmail.com" readonly class="form-control" required placeholder="Add CC"><br>
                                                                <label class="px-2">Message</label>
                                                                <textarea name="message" cols="30" rows="10" class="form-control empty-top"></textarea>
                                                                <input type="hidden" name="teach_email" value="<?php echo $teach_email; ?>">
                                                                <input type="hidden" name="class_id" value="<?php echo $_SESSION['class_id']; ?>">
                                                                <input type="hidden" name="star_id" value="<?php echo $star['id']; ?>">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="send_action" class="btn btn-primary">Send</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="menu1" class="container tab-pane fade"><br>
                                <h3>P2</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Section</th>
                                            <th>Action 1</th>
                                            <th>Action 2</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $class_id = $_GET['id'];
                                        $_SESSION['class_id'] = $class_id;
                                        $get_star = mysqli_query($conn, "SELECT * FROM student_risk_tbl WHERE class_id= '$class_id' AND term = 'p2'");
                                        while ($star = mysqli_fetch_array($get_star)) {


                                        ?>
                                            <tr>
                                                <td><?= $star['id_number']; ?></td>
                                                <td><?= $star['firstname']; ?></td>
                                                <td><?= $star['lastname']; ?></td>
                                                <td><?= $star['section']; ?></td>
                                                <td><a href="" data-bs-toggle="modal" data-bs-target="#send_email<?php echo $star['id']; ?>">Send Email to Parents</a></td>
                                                <td><a href="" data-bs-toggle="modal" data-bs-target="#action_taken<?php echo $star['id']; ?>">Action Taken</a></td>
                                            </tr>
                                            <div class="modal" id="send_email<?php echo $star['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Email</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="teacher_process.php" method="POST">
                                                                <label class="px-2">To:</label>
                                                                <input type="email" name="email" readonly class="form-control" value="<?php echo $guardian_email; ?>" required placeholder="Enter Email">
                                                                <label class="px-2">CC:</label>
                                                                <input type="email" name="cc" value="deejaybarredo@gmail.com" readonly class="form-control" required placeholder="Add CC"><br>
                                                                <label class="px-2">Message</label>
                                                                <textarea name="message" cols="30" rows="10" class="form-control empty-top"></textarea>
                                                                <input type="hidden" name="teach_email" value="<?php echo $teach_email; ?>">
                                                                <input type="hidden" name="class_id" value="<?php echo $_SESSION['class_id']; ?>">
                                                                <input type="hidden" name="star_id" value="<?php echo $star['id']; ?>">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="send_action" class="btn btn-primary">Send</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="action_taken<?php echo $star['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Email</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="teacher_process.php" method="POST">
                                                                <label class="px-2">To:</label>
                                                                <input type="email" name="email" readonly class="form-control" value="<?php echo $guardian_email; ?>" required placeholder="Enter Email">
                                                                <label class="px-2">CC:</label>
                                                                <input type="email" name="cc" value="deejaybarredo@gmail.com" readonly class="form-control" required placeholder="Add CC"><br>
                                                                <label class="px-2">Message</label>
                                                                <textarea name="message" cols="30" rows="10" class="form-control empty-top"></textarea>
                                                                <input type="hidden" name="teach_email" value="<?php echo $teach_email; ?>">
                                                                <input type="hidden" name="class_id" value="<?php echo $_SESSION['class_id']; ?>">
                                                                <input type="hidden" name="star_id" value="<?php echo $star['id']; ?>">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="send_action" class="btn btn-primary">Send</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="menu2" class="container tab-pane fade"><br>
                                <h3>P3</h3>
                                <table class="table"> 
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Section</th>
                                            <th>Action 1</th>
                                            <th>Action 2</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $class_id = $_GET['id'];

                                        $_SESSION['class_id'] = $class_id;
                                        $get_star = mysqli_query($conn, "SELECT * FROM student_risk_tbl WHERE class_id= '$class_id' AND term = 'p3'");
                                        while ($star = mysqli_fetch_array($get_star)) {


                                        ?>
                                            <tr>
                                                <td><?= $star['id_number']; ?></td>
                                                <td><?= $star['firstname']; ?></td>
                                                <td><?= $star['lastname']; ?></td>
                                                <td><?= $star['section']; ?></td>
                                                <td><a href="" data-bs-toggle="modal" data-bs-target="#send_email<?php echo $star['id']; ?>">Send Email to Parents</a></td>
                                                <td><a href="" data-bs-toggle="modal" data-bs-target="#action_taken<?php echo $star['id']; ?>">Action Taken</a></td>
                                            </tr>
                                            <div class="modal" id="send_email<?php echo $star['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Email</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="teacher_process.php" method="POST">
                                                                <label class="px-2">To:</label>
                                                                <input type="email" name="email" readonly class="form-control" value="<?php echo $guardian_email; ?>" required placeholder="Enter Email">
                                                                <label class="px-2">CC:</label>
                                                                <input type="email" name="cc"  value="deejaybarredo@gmail.com" class="form-control" required placeholder="Add CC"><br>
                                                                <label class="px-2">Message</label>
                                                                <textarea name="message" cols="30" rows="10" class="form-control empty-top"></textarea>
                                                                <input type="hidden" name="teach_email" value="<?php echo $teach_email; ?>">
                                                                <input type="hidden" name="class_id" value="<?php echo $_SESSION['class_id']; ?>">
                                                                <input type="hidden" name="star_id" value="<?php echo $star['id']; ?>">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="send_action" class="btn btn-primary">Send</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="action_taken<?php echo $star['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Email</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="teacher_process.php" method="POST">
                                                                <label class="px-2">To:</label>
                                                                <input type="email" name="email" readonly class="form-control" value="<?php echo $guardian_email; ?>" required placeholder="Enter Email">
                                                                <label class="px-2">CC:</label>
                                                                <input type="email" name="cc" readonly class="form-control" required placeholder="Add CC"><br>
                                                                <label class="px-2">Message</label>
                                                                <textarea name="message" cols="30" rows="10" class="form-control empty-top"></textarea>
                                                                <input type="hidden" name="teach_email" value="<?php echo $teach_email; ?>">
                                                                <input type="hidden" name="class_id" value="<?php echo $_SESSION['class_id']; ?>">
                                                                <input type="hidden" name="star_id" value="<?php echo $star['id']; ?>">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="send_action" class="btn btn-primary">Send</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>



           


                <script src="assets/libs/jquery/dist/jquery.min.js"></script>
                <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                <script src="assets/js/sidebarmenu.js"></script>
                <script src="assets/js/app.min.js"></script>
                <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
                <script src="assets/libs/simplebar/dist/simplebar.js"></script>
                <script src="assets/js/dashboard.js"></script>









</body>

</html>