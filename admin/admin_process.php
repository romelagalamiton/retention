<?php
include "../conn.php";

if(isset($_POST['add_teacher'])){
    $pic = $_FILES ['pic'] ['name'];
    $pic_Tmp = $_FILES ['pic'] ['tmp_name'];
    $fn = mysqli_real_escape_string($conn, $_POST['fn']);
    $ln = mysqli_real_escape_string($conn, $_POST['ln']);
    $id_number = mysqli_real_escape_string($conn, $_POST['id_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $val = mysqli_query($conn, "SELECT * FROM teacher WHERE email='$email' AND id_number='$id_number'");
    $num_rows = mysqli_num_rows($val);

    if($num_rows >=1){
        ?>
        <script>
            alert("Email or Id Number already existing!");
            location.href="index.php";
        </script>
        
        <?php
    }else{
        $insert = mysqli_query($conn, "INSERT INTO teacher VALUES ('0', '$id_number', '$fn', '$ln', '$email', '$ln', '$pic')");

        if($insert==true){
            move_uploaded_file($pic_Tmp, "uploads/".$pic);
            
            ?>

            <script>
                alert("Teacher's Account Added Successfully!");
                location.href="index.php";
            </script>
            <?php
            
        }else{
            ?>
            <script>
                alert("Teacher's Account not Added!");
                location.href="index.php";
            </script>
            <?php
        }
    }
}

//deleting account

if(isset($_POST['del_acc'])){
    $acc_id= $_GET['id'];

    $del_account = mysqli_query($conn, "DELETE FROM teacher WHERE id='$acc_id'");

    if($del_account==true){
        ?>
        <script>
            alert("Account Successfully Deleted!");
            location.href="index.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Error in Deleting!");
            location.href="index.php";
        </script>
        <?php
    }
}

if(isset($_POST['set_sem'])){
    $school_year  = $_POST['year'];
    $semester    = $_POST['semester'];
    $status      = "Open";

    $validate = mysqli_query($conn,"SELECT * FROM semester WHERE school_year = '$school_year' AND semester = '$semester' ");
    $num_val = mysqli_num_rows($validate);
    if($num_val >= 1){
        ?>
        <script>
            alert("This semester and school year already exist!");
            location.href="set_sem.php";
        </script>
        <?php


    }else{
        $insert = mysqli_query($conn,"INSERT INTO semester VALUE('0','$semester','$school_year','$status')");
        if($insert == true){
            ?>
            <script>
                alert("Semester Set Successfully!");
                location.href="set_sem.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Error Setting Semester!");
                location.href="set_sem.php";
            </script>
            <?php
        }
    }
    
}

if(isset($_POST['upd_sem'])){
    $upd_sem = $_POST['semester'];
    $upd_year = $_POST['year'];

    $update_sem = mysqli_query($conn,"UPDATE semester SET school_year = '$upd_year', semester = '$upd_sem' WHERE id = '1'");
    if($update_sem == true){
        ?>
            <script>
                alert("Semester Updated Successfully!");
                location.href="set_sem.php";
            </script>
        <?php
    }else{
        ?>
        <script>
            alert("Semester Not Updated!");
            location.href="set_sem.php";
        </script>
    <?php
    }
}
?>
