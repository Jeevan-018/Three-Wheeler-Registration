<?php
    $db="threewheller";
    $host="localhost";
    $username="root";
    $password="";
    try{
        $con=new mysqli($host,$username,$password,$db);
    }
    catch(Exception $e){
        exit("Error: " . $e->getMessage());
    }
?>