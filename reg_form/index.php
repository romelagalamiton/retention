<?php
include "../conn.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/css/styles.min.css" />
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
    <title>Retention</title>
</head>


<body>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->

        <aside class="left-sidebar">
            <!-- Sidebar scroll-->

            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between bg-dark text-light">
                    <a href="index.php" class="text-nowrap logo-img">
                        <!--<img src="assets/images/logos/dark-logo.svg" width="180" alt="" />-->
                        <h5 class="text-light">Retention</h5>
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
                            <span class="hide-menu">UI COMPONENTS</span>
                        </li>

                        <li class="sidebar-item">
                            <a href="" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#add">
                                <span>
                                    <i class="ti ti-user"></i>
                                    List of Registered Students
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
                </nav>
            </header>


            <div class="container-fluid">
                <!-- Modal -->
                <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registered Students</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>Profile</th>
                                            <th>ID Number</th>
                                            <th>Student Lastname</th>
                                            <th>Student Firstname</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $get_reg = mysqli_query($conn,"SELECT * FROM  parents_info");
                                        while($row2 = mysqli_fetch_array($get_reg)){

                                
                                        ?>
                                        <tr>
                                            <td><img src="uploads/<?php echo $row2 ['profile'];?>" class="img-thumbnail" width="70px"></td>
                                            <td><?php  echo $row2['student_id_number'];?></td>
                                            <td><?php  echo $row2['student_lastname'];?></td>
                                            <td><?php  echo $row2['student_firstname'];?></td>
                                        </tr>
                                        <?php 
                                             }
                                        ?>
                                    </tbody>
                                </table>
                                <script>
                                 new DataTable('#example');  
                                </script>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3>Add Profile Picture</h3>
                            <div class="card shadow" style="width: 18rem;height:25rem;">
                                <img id="pp" src="uploads/profile.png" style="height: 20rem;" class="card-img-top " alt="Guardian Profile">
                                <div class="card-body">
                                    <label for="f" class="card-title d-flex justify-content-center fw-bold text-center" style="cursor: pointer;">Add Profile</label>
                                    <input class="form-control" type="file" name="pic" id="f" accept="image/*" onchange="Loadpp()" style="visibility:hidden;">
                                </div>
                                <script>
                                    var Loadpp = function() {
                                        var output = document.getElementById('pp');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Student Information</h3>

                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-123"></i></div>
                                            <input type="text" class="form-control" name="s_idnumber" placeholder="Student ID Number" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                                            <input type="text" class="form-control" name="s_firstname" placeholder="Student Firstname" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                                            <input type="text" class="form-control" name="s_lastname" placeholder="Student Lastname" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                            <input type="email" class="form-control" name="s_email" placeholder="Student Email" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-phone"></i></div>
                                            <input type="text" class="form-control" name="s_contact_no" placeholder="Student Contact Number" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                            <input type="text" class="form-control" name="s_subject" placeholder="Student Subject" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-building"></i></div>
                                            <input type="text" class="form-control" name="s_section" placeholder="Student Section" required>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text"><i class="bi bi-building"></i></div>
                                        <select name="s_semester" id="" class="form-select">
                                            <option value="">--Select Semester</option>
                                            <option value="1st Semester">1st Semester</option>
                                            <option value="2nd Semester">2nd Semester</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                    <?php
                                    $date = date('Y');
                                    $year = $date + 1;
                                    $sy = "S.Y." . $date . '-' . $year;
                                    ?>
                                    <div class="input-group-text"><i class="bi bi-building"></i></div>
                                    <select class="form-control" name="s_schoolyear" id="">
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


                                </div>
                                <div class="col-6">
                                    <h3>Guardian Information</h3>

                                    <div class="mb-4">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                                            <input type="text" class="form-control" name="g_firstname" placeholder="Guardian Firstname" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                                            <input type="text" class="form-control" name="g_lastname" placeholder="Guardian Lastname" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                            <input type="email" class="form-control" name="g_email" placeholder="Guardian Email" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-phone"></i></div>
                                            <input type="text" class="form-control" name="g_contact_no" placeholder="Guardian Contact Number" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-geo-alt"></i></div>
                                            <input type="text" class="form-control" name="g_address" placeholder="Guardian Address" required>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" class="btn btn-primary" name="reg_guardian" value="REGISTER">
                    </div>
                </form>
            </div>
            <!-- /.container -->
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