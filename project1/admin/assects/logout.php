<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
session_destroy();
header("index.php");
// echo"<script>alert('admin logout sucessfully');document.location ='index.php';</script>";
?>