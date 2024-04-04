<?php
include "conn.php";

//log-in for admin

if(isset($_POST['admin_log'])){

    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    $val = mysqli_query($conn, "SELECT * FROM admin WHERE Email='$email' AND Password='$password'");
    $num_row = mysqli_num_rows($val);

    if($num_row>=1){
        $_SESSION['email'] = $email;
        ?>
        <script>
            alert("Login Successfully!");
            location.href="admin/index.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Wrong Email or Password \nPlease Login again.");
            location.href="index.php";
        </script>
        <?php
    }    
}

//TEACHER'S LOGIN

if(isset($_POST['teacher_log'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $val_acc = mysqli_query($conn, "SELECT * FROM teacher WHERE email='$email' AND password='$pass'");
    $check = mysqli_num_rows($val_acc);

    if($check >=1){
        $_SESSION['email'] = $email;
        ?>
        <script>
            alert("Login Successfully!");
            location.href="teacher/index.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Wrong Email or Password \nPlease Login again.");
            location.href="index.php";
        </script>
        <?php
    }
}


?>