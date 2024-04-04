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
        $profile = $admin->profile;
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

        body {
            background-color: #f5f7fa;
        }

        .testimonial-card .card-up {
            height: 120px;
            overflow: hidden;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
        }

        .aqua-gradient {
            background: linear-gradient(40deg, #2096ff, #05ffa3) !important;
        }

        .testimonial-card .avatar {
            width: 120px;
            margin-top: -60px;
            overflow: hidden;
            border: 5px solid #fff;
            border-radius: 50%;
            width: 75px;
            height: 65px;
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
                                        <div class="input-group-text"></div>
                                        <input type="color" name="favcolor" value="#ff0000" class="form-control form-control-color">
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
                            <a class="sidebar-link" data-bs-toggle="modal" data-bs-target="#addteacher" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                    Create Class
                                </span>

                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="class_list.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                    List of Classes
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
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-body bg-success rounded">
                                <div class="row">
                                    <div class="col-12">

                                        <h5 class="text-light">Number of Students at Risks <i class="bi bi-person-fill"></i> </h5>
                                    </div>
                                    <hr>
                                    </hr>
                                    <div class="col-12">

                                        <p class="text-light fw-bold"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-body bg-primary rounded">
                                <div class="row">
                                    <div class="col-12">

                                        <h5 class="text-light">Number of Faculties <i class="bi bi-person-fill"></i> </h5>
                                    </div>
                                    <hr>
                                    </hr>
                                    <div class="col-12">

                                        <p class="text-light fw-bold"> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container ">

                        <section class="mx-auto my-5 ">


                            <div class="row">

                                <?php
                                $get_class = mysqli_query($conn, "SELECT * FROM class WHERE teacher_email = '$e'");
                                while ($class = mysqli_fetch_array($get_class)) {
                                    $teach_email = $class['teacher_email'];
                                    $get_profile = mysqli_query($conn, "SELECT * FROM teacher WHERE email = '$teach_email'");
                                    while ($profile = mysqli_fetch_array($get_profile)) {



                                ?>
                                        <div class="col-4">

                                            <div class="card testimonial-card mt-2 mb-3">



                                                <div class="card-up " style="background-color:<?php echo $class['color']; ?>"></div>
                                                <div class="avatar mx-auto white">
                                                    <img src="../admin/uploads/<?php echo $profile['profile']; ?>" class=" img-fluid">
                                                </div>
                                                <div class="card-body text-center">
                                                    <h4 class="card-title font-weight-bold"><?php echo $profile['firstname'] . '' . $profile['lastname']; ?></h4>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p><i class="fas fa-quote-left"></i> <?php echo $class['subject_code'];  ?>:<?php echo $class['section']; ?></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#edit<?php echo $class['id']; ?>">View Details</a>

                                                            <?php $id = $class['id'];
                                                            $getdata = mysqli_query($conn, "SELECT * FROM class WHERE id='$id'");
                                                            while ($row = mysqli_fetch_object($getdata)) {
                                                                $subject_code = $row->subject_code;
                                                                $subject_desc = $row->subject_desc;
                                                                $section      = $row->section;
                                                                $date         = $row->date;
                                                                $time         = $row->time;
                                                                $room_no      = $row->room_no;
                                                                $color        = $row->color;
                                                            }

                                                            ?>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $subject_code; ?></h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="teacher_process.php?id=<?php echo $id; ?>" method="POST">

                                                                            <div class="row">

                                                                            <label class="d-flex justify-content-start">Subject Code</label> 
                                                                                <div class="col-md-12">
                                                                                <div class="input-group mb-3 border border-success rounded">
                                                                                    <span class="input-group-text"><i class="bi bi-fonts"></i></span>
                                                                                    <input type="text" name="sub_code" class="form-control" value="<?php echo $subject_code;?>" required>
                                                                                </div>
                                                                                </div>

                                                                                <label class="d-flex justify-content-start">Subject Description</label> 
                                                                                <div class="col-md-12">
                                                                                <div class="input-group mb-3 border border-success rounded">
                                                                                    <span class="input-group-text"><i class="bi bi-type"></i></span>
                                                                                    <input type="text" name="sub_desc" class="form-control" value="<?php echo $subject_desc ;?>" required>
                                                                                </div>
                                                                                </div>

                                                                                <label class="d-flex justify-content-start">Section</label> 
                                                                                <div class="col-md-12">
                                                                                <div class="input-group mb-3 border border-success rounded">
                                                                                    <span class="input-group-text"><i class="bi bi-123"></i></span>
                                                                                    <input type="text" name="section" class="form-control" value="<?php echo $section ;?>" required>
                                                                                </div>
                                                                                </div>

                                                                                <label class="d-flex justify-content-start">Date</label> 
                                                                                <div class="col-md-12">
                                                                                <div class="input-group mb-3 border border-success rounded">
                                                                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                                                                    <input type="text" name="date" class="form-control" value="<?php echo $date ;?>" required>
                                                                                </div>
                                                                                </div>

                                                                                <label class="d-flex justify-content-start">Time</label> 
                                                                                <div class="col-md-12">
                                                                                <div class="input-group mb-3 border border-success rounded">
                                                                                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                                                                    <input type="text" name="time" class="form-control" value="<?php echo $time ;?>" required>
                                                                                </div>
                                                                                </div>

                                                                                <label class="d-flex justify-content-start">Room Number</label> 
                                                                                <div class="col-md-12">
                                                                                <div class="input-group mb-3 border border-success rounded">
                                                                                    <span class="input-group-text"><i class="bi bi-123"></i></span>
                                                                                    <input type="text" name="room_no" class="form-control" value="<?php echo $room_no ;?>" required>
                                                                                </div>
                                                                                </div>

                                                                                <label class="d-flex justify-content-start">Color</label> 
                                                                                <div class="col-md-12">
                                                                                <div class="input-group mb-3 border border-success rounded">
                                                                                    <span class="input-group-text"><i class="bi bi-palette"></i></span>
                                                                                    <input type="color" name="color" class="form-control" value="<?php echo $color ;?>" required>
                                                                                </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="edit_class" class="btn btn-secondary">Update</button>
                                                                            <a href="delete.php?id=<?php echo $id;?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this class?')">Delete</a>
                                                                            <a href="class.php?id=<?php echo $id;?>&&teacher_email=<?php  echo $e; ?>" class="btn btn-primary">Open Class</a>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>

                                        </div>
                                <?php
                                    }
                                }
                                ?>

                            </div>


                        </section>

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