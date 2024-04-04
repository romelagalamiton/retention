<?php
include "../conn.php";

if(empty($_SESSION['email'])){
    ?>
    <script>
        alert("Session Expired!");
        location.href="../index.php";
    </script>
    <?php
}else{
    $e = $_SESSION['email'];
    $get_admin = mysqli_query($conn, "SELECT * FROM admin WHERE Email='$e'");

    while($admin = mysqli_fetch_object($get_admin)){
        $lastname = $admin->Lastname;

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
    <title>Admin Dashboard<?php echo $lastname;?></title>
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="admin_process.php" method="POST" enctype="multipart/form-data">

                            <div class="row">


                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-person-fill-add"></i></div>
                                        <input type="file" name="pic" class="form-control" accept="image/*">
                                    </div>

                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-person-fill-add"></i></div>
                                        <input type="text" class="form-control" name="fn" placeholder="First name" required aria-label="First name">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-person-fill-add"></i></div>
                                        <input type="text" name="ln" class="form-control" placeholder="Last name" required aria-label="Last name">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-123"></i></div>
                                        <input type="text" name="id_no" class="form-control" placeholder="ID Number" required aria-label="ID Number">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-envelope-at-fill"></i></div>
                                        <input type="email" name="email" class="form-control" placeholder="Email" required aria-label="Email">
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-primary" value="CLEAR">
                                <input type="submit" class="btn btn-success" name="add_teacher" value="ADD">
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
                        <h5 class="text-light">Admin Dashboard</h5>
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
                                    Add Teacher
                                </span>

                            </a>
                        </li>

                           
                        <li class="sidebar-item">
                            <a class="sidebar-link"  href="set_sem.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                    Set Semester
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



                    <div class="container-fluid">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="admin_process.php" method="POST">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-building"></i></div>
                                        <select name="semester" id="" class="form-select">
                                            <option value="">--Select Semester</option>
                                            <option value="1st Semester">1st Semester</option>
                                            <option value="2nd Semester">2nd Semester</option>
                                        </select>
                                    </div>

                                    <div class="input-group mt-3">
                                    <?php
                                    $date = date('Y');
                                    $year = $date + 1;
                                    $sy = "S.Y." . $date . '-' . $year;
                                    ?>
                                    <div class="input-group-text"><i class="bi bi-building"></i></div>
                                    <select class="form-control" name="year" id="">
                                        <option value="">--Select Year--</option>
                                        <?php
                                        for ($i = 0; $i < 5; $i++) {
                                        ?>

                                            <option value="<?php echo "S.Y." . $date + $i . '-' . $year + $i; ?>"><?php echo "S.Y." . $date + $i . '-' . $year + $i; ?> </option>

                                        <?php
                                        }
                                        ?>
                                    </select>


                                </div> 
                                

                                <div class="d-flex justify-content-end">
                                    
                                <input type="submit" class="btn btn-primary mt-3" value="Set Semester" name="set_sem">
                                </div>

                                </form>
                            </div>
                        </div>


                        <div class="card shadow">
                            <div class="card-body">
                                <h1>Update Semester</h1>
                                <form action="admin_process.php" method="POST">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-building"></i></div>
                                        <select name="semester" id="" class="form-select">
                                            <option value="<?php  echo $semster; ?>"><?php  echo $semster; ?></option>
                                            <option value="1st Semester">1st Semester</option>
                                            <option value="2nd Semester">2nd Semester</option>
                                        </select>
                                    </div>

                                    <div class="input-group mt-3">
                                    <?php
                                    $date = date('Y');
                                    $year = $date + 1;
                                    $sy = "S.Y." . $date . '-' . $year;
                                    ?>
                                    <div class="input-group-text"><i class="bi bi-building"></i></div>
                                    <select class="form-control" name="year" id="">
                                        <option value="<?php  echo $schoolyear; ?>"><?php  echo $schoolyear; ?></option>
                                        <?php
                                        for ($i = 0; $i < 5; $i++) {
                                        ?>

                                            <option value="<?php echo "S.Y." . $date + $i . '-' . $year + $i; ?>"><?php echo "S.Y." . $date + $i . '-' . $year + $i; ?> </option>

                                        <?php
                                        }
                                        ?>
                                    </select>


                                </div> 
                                

                                <div class="d-flex justify-content-end">
                                    
                                <input type="submit" class="btn btn-success mt-3" value="Set Semester" name="upd_sem">
                                </div>

                                </form>
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