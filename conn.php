<?php
session_start();

$conn = mysqli_connect('localhost','root','');
$db =mysqli_select_db($conn, "ui_migration");


$sem_stat = "Open";
$get_sem = mysqli_query($conn,"SELECT * FROM semester WHERE status = '$sem_stat'");
while($sem = mysqli_fetch_object($get_sem)){
    $semster = $sem->semester;
    $schoolyear = $sem->school_year;
}
?>