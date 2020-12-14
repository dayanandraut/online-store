<?php
session_start();
session_destroy();
echo 'Logged out';
header("Location:index.php");
?>