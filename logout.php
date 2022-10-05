<?php
session_start();
session_unset();
session_destroy();
echo "<script> alert('You have been logged out successfully');window.location='index.php'</script>";
?>