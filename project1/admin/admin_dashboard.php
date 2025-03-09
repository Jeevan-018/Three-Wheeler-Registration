<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    echo"<script>alert('first login please');document.location ='index.php';</script>";
}
?>
<html>
<head>
    <title>Three Wheeler Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('assects/header.php');?>
    <!-- <br><br> -->
    <div class="body">
        <?php include('assects/footer1.php'); ?>
    </div>
    <!-- <br> -->
    <?php include('assects/footer.php');?>
</body>