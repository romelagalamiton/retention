
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="img/">


  <title>Retention Tracking System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

<link rel="icon" type="image/x-icon" href="assets/img/ui.png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Techie
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/techie-free-skin-bootstrap-3/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.html">UIRTS</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">HOME</a></li>

          <li class="dropdown"><a href="#"><span>ACCOUNTS</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a data-bs-toggle="modal" data-bs-target="#admin_log" href="#">Login as Admin</a></li>
              <li><a data-bs-toggle="modal" data-bs-target="#teacher_log" href="#">Login as Teacher</a></li>
    
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->


    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container-fluid" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>UI RETENTION PRO: STUDENT TRACKING SYSTEM</h1>
          <h2>RETAIN YOUR FUTURE WITH US.</h2>
        </div>
        <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
          <img src="assets/img/logo.png" class="img-fluid animated" style="width: 1200px;" style="height: 1200px;" >
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



  <!-- Modal for Admin -->
  <div class="modal fade" id="admin_log" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login as Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="process.php" method="POST">

            <label>Email :</label><br>
            <div class="input-group mb-3">
              <div class="input-group-text">
                <i class="fa fa-solid fa fa-envelope"></i>
              </div>
              <input type="email" class="form-control" aria-label="Text input with checkbox" name="email" required placeholder="Enter Your Email"><br>
            </div>

            <label>Password :</label><br>
            <div class="input-group">
              <div class="input-group-text">
                <i class="fa fa-solid fa fa-key"></i>
              </div>
              <input type="password" class="form-control" aria-label="Text input with radio button" name="pass" required placeholder="Enter Your Password" id="myInput"></br>
            </div>
            <input type="checkbox" onclick="myFunction()"> Show Password

        </div>
        <div class="modal-footer">
          <input type="reset" value="CLEAR" class="btn btn-secondary">
          <input type="submit" class="btn btn-primary" name="admin_log" value="Login">
        </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal for Teacher -->
  <div class="modal fade" id="teacher_log" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">Login as Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="process.php" method="POST">

            <label>Email :</label><br>
            <div class="input-group mb-3">
              <div class="input-group-text">
                <i class="fa fa-solid fa fa-envelope"></i>
              </div>
              <input type="email" class="form-control" aria-label="Text input with checkbox" name="email" required placeholder="Enter Your Email"><br>
            </div>

            <label>Password :</label><br>
            <div class="input-group">
              <div class="input-group-text">
                <i class="fa fa-solid fa fa-key"></i>
              </div>
              <input type="password" class="form-control" aria-label="Text input with radio button" name="pass" required placeholder="Enter Your Password" id="myInput3"></br>
            </div>
            <input type="checkbox" onclick="myFunction3()"> Show Password

        </div>
        <div class="modal-footer">
          <input type="reset" value="CLEAR" class="btn btn-secondary">
          <input type="submit" class="btn btn-primary" name="teacher_log" value="LOGIN">
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal for Student -->
  <div class="modal fade" id="student_log" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Register as Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="process.php" method="POST">

            <label>Email :</label><br>
            <div class="input-group mb-3">
              <div class="input-group-text">
                <i class="bi bi-envelope"></i>
              </div>
              <input type="email" class="form-control" aria-label="Text input with checkbox" name="email" required placeholder="Enter Your Email"><br>
            </div>

            <label>Password :</label><br>
            <div class="input-group">
              <div class="input-group-text">
                <i class="bi bi-key"></i>
              </div>
              <input type="password" class="form-control" aria-label="Text input with radio button" name="pass" required placeholder="Enter Your Password" id="myInput1"></br>
            </div>
            <input type="checkbox" onclick="myFunction1()"> Show Password

        </div>
        <div class="modal-footer">
          <input type="reset" value="CLEAR" class="btn btn-secondary">
          <input type="submit" class="btn btn-primary" name="student_log" value="REGISTER">
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>


  <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

  <script>
    function myFunction1() {
      var x = document.getElementById("myInput1");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

  <script>
    function myFunction2() {
      var x = document.getElementById("myInput2");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

  <script>
    function myFunction3() {
      var x = document.getElementById("myInput3");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    
    }
  </script>

</body>

</html>