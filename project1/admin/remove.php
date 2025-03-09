<?php
session_start();
include_once('assects/config.php');
if(!isset($_SESSION['user_id'])){
    echo" <script>documnet.location = 'index.php';</script>";
}
    $r_no = $_GET['id'];
    // $data = $con->query("select v_id from registration  where r_no = $r_no");
    $data =$con->query("SELECT *FROM vehical JOIN registration ON registration.v_id = vehical.v_id JOIN customer ON registration.r_no = customer.r_no where registration.r_no = $r_no ");
    $data1 = mysqli_fetch_array($data);
    if(mysqli_num_rows($data)>0)
    {
        $sql = "delete from customer where r_no = '$r_no'";
        $sql1 = "delete from registration where r_no = '$r_no'";
        if($con->query($sql)==TRUE && $con->query($sql1)==TRUE){
            echo "<script>alert('vehical deregisterd sucessfully');</script>";
            echo "<script>document.location='deregistration.php';</script>";
            $v_id=$data1['v_id'];
            $sql2 = "UPDATE vehical SET vehical_status='INACTIVE' WHERE v_id = $v_id";
            $con->query($sql2);
        }
        else{
            echo "<script>alert('vehical deregistion is fail');</script>";
            echo "<script>document.location='deregistration.php';</script>";
        }
    }
    else{

    }
?>