<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include "../conn.php";

if(isset($_POST['create_class'])){
    $sub_code = mysqli_real_escape_string($conn, $_POST['sub_code']);
    $sub_desc = mysqli_real_escape_string($conn, $_POST['sub_desc']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $color = mysqli_real_escape_string($conn,$_POST['favcolor']);
    $val_section = mysqli_query($conn, "SELECT * FROM class WHERE section='$section'");
    $sec_num = mysqli_num_rows($val_section);


    if($sec_num >=1){
        ?>
        <script>
            alert("This section Already Exists!");
            location.href="index.php";
        </script>
        <?php
    }else{
        $insert = mysqli_query($conn, "INSERT INTO class VALUES('0', '$sub_code', '$sub_desc', '$section', '$date', '$time', '$room','$email','$color')");

        if($insert==true){
            
            ?>
            <script>
                alert("Class Created Successfully!");
                location.href="index.php";
            </script>
            <?php
            
        }else{
            ?>
            <script>
                alert("Error in Creating Class!");
                location.href="index.php";
            </script>
            <?php
        }
    }
}

//file uploading
if(isset($_POST['file_upd'])){
    if(!empty($_FILES['file']['name'])){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $csvFile = fopen($_FILES['file']['tmp_name'],'r');

            fgetcsv($csvFile);

            while(($line = fgetcsv($csvFile)) !== FALSE){
                $id = $line[0];
                $id_number = $line[1];
                $firstname = $line[2];
                $lastname = $line[3];
                $sub_code = $line[4];
                $sub_desc = $line[5];
                $section = $line[6];
                $email1 = $line[7];
                $email2 = $line[8];
                $term = $line[9];
                $teacher_email = $_POST['teacher_email'];
                //$class_id1 = $_POST['class_id'];
                $schl_year = $_POST['school_year'];
                $sm        = $_POST['semester'];

                
       

          
                
              
                $get_class_id = mysqli_query($conn,"SELECT * FROM class WHERE teacher_email = '$teacher_email'");
                while($class_id = mysqli_fetch_object($get_class_id)){
                    $id_class = $class_id->id;
                }
               

             
                    $class_id1 = $_POST['class_id'];

                   
                    $insert = mysqli_query($conn, "INSERT INTO student_risk_tbl VALUES ('0', '$id_number', '$firstname', '$lastname', '$sub_code', 
                    '$sub_desc', '$section', '$teacher_email','$class_id1','$term','$sm','$schl_year','$email1','$email2')");

                    if($insert==true){
                        
                        ?>
                        <script>
                            alert("CSV File Uploaded Successfully!");
                            location.href="class.php?id=<?php echo $class_id1 ?>&&teacher_email=<?php  echo $teacher_email; ?>";
                        </script>
                        <?php
                        
                    }else{
                        ?>
                        <script>
                            alert("CSV File not Uploaded!");
                            location.href="class.php?id=<?php echo $class_id1 ?>&&teacher_email=<?php  echo $teacher_email; ?>";
                        </script>
                        <?php
                    }
                }
                
                  
            }
          
        }
        
    }


//updating list of classes

if(isset($_POST['edit_class'])){

    $id = $_GET['id'];

    $sub_code = $_POST['sub_code'];
    $sub_desc = $_POST['sub_desc'];
    $section  = $_POST['section'];
    $date     = $_POST['date'];
    $time     = $_POST['time'];
    $room_no  = $_POST['room_no'];
    $color    = $_POST['color'];

    $update = mysqli_query($conn, "UPDATE class SET subject_code = '$sub_code', subject_desc = '$sub_desc', section = '$section', date = '$date', time = '$time', room_no ='$room_no', color = '$color' WHERE id ='$id'");

    if($update == true){
        ?>
        <script>
            alert("List of Classes Updated Successfully!");
            location.href="class_list.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Error in Updating!");
            location.href="class_list.php";
        </script>
        <?php
    }
}


if(isset($_POST['send_email'])){

    $to = $_POST['email'];
    $cc = $_POST['cc'];
    $content = $_POST['message'];
    $teacher_email = $_POST['teach_email'];
    $class_id = $_SESSION['class_id'];
    $star_id  = $_POST['star_id'];
    
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host    = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "marvinaungon10@gmail.com";
    $mail->Password = "idcvolpivvuwqbzl";
    $mail->SMTPSecure ='ssl';
    $mail->Port     = 465;

    $mail->setFrom($teacher_email,"SSP Adviser");
    $mail->addAddress($to);
    $mail->addCC($cc);

    $mail->Subject = ('Student at Risk');
    $mail->isHtml(true);
    $mail->Body = $content;
    $check_sent = mysqli_query($conn,"SELECT * FROM student_risk_tbl WHERE email1 = 'Sent' AND id = '$star_id'");
    $sent_num = mysqli_num_rows($check_sent);
    if($sent_num >= 1){
        ?>
            <script>
                alert("You already sent an email to this student");
                location.href="class.php?id=<?php echo $class_id ?>&&teacher_email=<?php  echo $teacher_email; ?>";
            </script>
        <?php

    }else{
        if($mail->send()){
            $update_email1 = mysqli_query($conn,"UPDATE student_risk_tbl SET email1 = 'Sent' WHERE id = '$star_id'");
            ?>
                <script>
                    alert('Sent');
                    location.href="class.php?id=<?php echo $class_id ?>&&teacher_email=<?php  echo $teacher_email; ?>";
                </script>
            <?php
        }else{
            ?>
            <script>
                alert('Not Sent');
                location.href="class.php?id=<?php echo $class_id;?>&&teacher_email=<?php  echo $teacher_email; ?>";
            </script>
        <?php
        }
    
    }
  
    
    
    
  

}

if(isset($_POST['send_email'])){

    $to = $_POST['email'];
    $cc = $_POST['cc'];
    $content = $_POST['message'];
    $teacher_email = $_POST['teach_email'];
    $class_id = $_SESSION['class_id'];
    $star_id  = $_POST['star_id'];
    
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host    = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "marvinaungon10@gmail.com";
    $mail->Password = "idcvolpivvuwqbzl";
    $mail->SMTPSecure ='ssl';
    $mail->Port     = 465;

    $mail->setFrom($teacher_email,"SSP Adviser");
    $mail->addAddress($to);
    $mail->addCC($cc);

    $mail->Subject = ('Student at Risk');
    $mail->isHtml(true);
    $mail->Body = $content;
    $check_sent = mysqli_query($conn,"SELECT * FROM student_risk_tbl WHERE email1 = 'Sent' AND id = '$star_id'");
    $sent_num = mysqli_num_rows($check_sent);
    if($sent_num >= 1){
        ?>
            <script>
                alert("You already sent an email to this student");
                location.href="class.php?id=<?php echo $class_id ?>&&teacher_email=<?php  echo $teacher_email; ?>";
            </script>
        <?php

    }else{
        if($mail->send()){
            $update_email1 = mysqli_query($conn,"UPDATE student_risk_tbl SET email1 = 'Sent' WHERE id = '$star_id'");
            ?>
                <script>
                    alert('Sent');
                    location.href="class.php?id=<?php echo $class_id ?>&&teacher_email=<?php  echo $teacher_email; ?>";
                </script>
            <?php
        }else{
            ?>
            <script>
                alert('Not Sent');
                location.href="class.php?id=<?php echo $class_id;?>&&teacher_email=<?php  echo $teacher_email; ?>";
            </script>
        <?php
        }
    
    }
  
    
    
    
  

}

if(isset($_POST['send_action'])){

    $to = $_POST['email'];
    $cc = $_POST['cc'];
    $content = $_POST['message'];
    $teacher_email = $_POST['teach_email'];
    $class_id = $_SESSION['class_id'];
    $star_id  = $_POST['star_id'];
    
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host    = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "marvinaungon10@gmail.com";
    $mail->Password = "idcvolpivvuwqbzl";
    $mail->SMTPSecure ='ssl';
    $mail->Port     = 465;

    $mail->setFrom($teacher_email,"SSP Adviser");
    $mail->addAddress($to);
    $mail->addCC('hii@gmail.com');

    $mail->Subject = ('Student at Risk');
    $mail->isHtml(true);
    $mail->Body = $content;
    $check_sent = mysqli_query($conn,"SELECT * FROM student_risk_tbl WHERE email2 = 'Sent' AND id = '$star_id'");
    $sent_num = mysqli_num_rows($check_sent);
    if($sent_num >= 1){
        ?>
            <script>
                alert("You already sent an email to this student");
                location.href="class.php?id=<?php echo $class_id ?>&&teacher_email=<?php  echo $teacher_email; ?>";
            </script>
        <?php

    }else{
        if($mail->send()){
            $update_email1 = mysqli_query($conn,"UPDATE student_risk_tbl SET email2 = 'Sent' WHERE id = '$star_id'");
            ?>
                <script>
                    alert('Sent');
                    location.href="class.php?id=<?php echo $class_id ?>&&teacher_email=<?php  echo $teacher_email; ?>";
                </script>
            <?php
        }else{
            ?>
            <script>
                alert('Not Sent');
                location.href="class.php?id=<?php echo $class_id;?>&&teacher_email=<?php  echo $teacher_email; ?>";
            </script>
        <?php
        }
    
    }
  
    
    
    
  

}




































/*
//send email

if(isset(['send_email'])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'marvinaungon10@gmail.com';
    $mail->Password = 'idcvolpivvuwqbzl';
    $mail->SMTPSecure = 'false';
    $mail->Port = 25;

    $mail->setFrom($email);
    $mail->addAddress("");
    $mail->Subject = ("");
    $mail->isHTML(true);
    $mail->Body = "Hello Ma'am/Sir" . '<br><br>'. "I 
    ";
}
*/
?>
