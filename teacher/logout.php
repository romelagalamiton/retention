<?php

session_start();
session_destroy();
?>
<script>
    alert("Logged out Successfully!");
    location.href="../index.php";
</script>
