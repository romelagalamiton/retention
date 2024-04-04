<?php
include "../conn.php";

$id = $_GET['id'];

$delete = mysqli_query($conn, "DELETE FROM class WHERE id='$id'");

if($delete==true){
    ?>
    <script>
        alert("Class Successfully Deleted!");
        location.href="class_list.php";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("Error in Deleting the Class!");
        location.href="class_list.php";
    </script>
    <?php
}
?>