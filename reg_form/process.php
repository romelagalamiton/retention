<?php
    include "../conn.php";

    if(isset($_POST['reg_guardian'])){
        
        $profile = $_FILES['pic']['name'];
        $profile_tmp  = $_FILES['pic']['tmp_name'];
        $s_idnumber = mysqli_real_escape_string($conn, $_POST['s_idnumber']);
        $s_firstname = mysqli_real_escape_string($conn, $_POST['s_firstname']);
        $s_lastname = mysqli_real_escape_string($conn, $_POST['s_lastname']);
        $s_email = mysqli_real_escape_string($conn, $_POST['s_email']);
        $s_contact_no = mysqli_real_escape_string($conn, $_POST['s_contact_no']);
        $s_subject = mysqli_real_escape_string($conn, $_POST['s_subject']);
        $s_section = mysqli_real_escape_string($conn, $_POST['s_section']);
        $s_schoolyear = mysqli_real_escape_string($conn, $_POST['s_schoolyear']);
        $s_semester = mysqli_real_escape_string($conn, $_POST['s_semester']);
        $g_firstname = mysqli_real_escape_string($conn, $_POST['g_firstname']);
        $g_lastname = mysqli_real_escape_string($conn, $_POST['g_lastname']);
        
        $g_email = mysqli_real_escape_string($conn, $_POST['g_email']);
        $g_contact_no = mysqli_real_escape_string($conn, $_POST['g_contact_no']);
        $g_address = mysqli_real_escape_string($conn, $_POST['g_address']);
        
      
   

        $check = mysqli_query($conn,"SELECT * FROM parents_info WHERE student_email='$s_email' AND student_id_number='$s_idnumber' AND guardians_email='$g_email'");
        $validate = mysqli_num_rows($check);

        if($validate >=1){
            ?>
            <script>
                alert("This student already fill the form!");
                location.href='index.php';
            </script>
            <?php
        }else{
            $insert = mysqli_query($conn, "INSERT INTO parents_info VALUES('0', '$s_idnumber','$s_firstname','$s_lastname','$s_email','$s_contact_no','$s_section','$s_subject','$s_schoolyear',
            '$s_semester','$g_firstname','$g_lastname','$g_email','$g_contact_no','$g_address','$profile')");

            if($insert == true){
                move_uploaded_file($profile_tmp, 'uploads/'.$profile);
                ?>
                    <script>
                        alert("Profile Registered Successfully!");
                        location.href='index.php';
                    </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Some error occur!");
                    location.href='index.php';
                </script>
            <?php
            }
        }
    }
?>
