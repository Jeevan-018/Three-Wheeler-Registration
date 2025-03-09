<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    echo"<script>document.location ='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        *{
            padding:0;
            margin:0;
        }
        .header{
            text-align:center;
            border: 2px solid black;
            padding:15px;
            margin-left: 125px;
            margin-right:125px;
            margin-top:15px;
            margin-bottom:15px;
            
        }
        table td {
            align : center;
            margin-left:180px;
            padding:5px;
        }
        .btn{
            margin-left:50px ;
            width: 100%;
            height: 35px;
            background-color: #303f9f;
            border: none;
            outline: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            color: white;
            font-weight: 600;
        }
    </style>
    <title>preview</title>
</head>
<body>
    <div class="header">
    <?php
        include('assects/config.php');
        echo "KA 06 TK " . $regno=$_GET['id'];
        $result =$con->query("SELECT *FROM vehical JOIN registration ON registration.v_id = vehical.v_id JOIN customer ON registration.r_no = customer.r_no where registration.r_no =$regno");
        if(mysqli_num_rows($result) != 0)
        {
           while($row=mysqli_fetch_array($result))
            {
    ?>
            <h1 color="blue">Three Wheller Vehical Registration</h1>
            <p>BH ROAD TUMAKURU VIDYANAGAR 572226   <br> phone: 1234567890  gmail : rto@gmail.com</p>
                <br>
           <strong> <?php echo "REG NO : KA 06 TK ".$regno?></strong>
           <br><hr><br>
           
           <table CELLSPACING="25" CELLPADING="15">
            <tr>
                <td>Owner Name</td><td>:</td>
                <td><?php echo $row['name'];?></td>
            </tr>
            <tr>
                <td>Father Name:</td><td>:</td>
                <td><?php echo $row['father_name'];?></td>
            </tr>
            <tr>
                <td>Age</td><td>:</td>
                <td><?php echo $row['age'];?></td>
            </tr>
            <tr>
                <td>Date Of Birth</td><td>:</td>
                <td><?php echo $row['dob'];?></td>
            </tr>
            <tr>
                <td>Gender</td><td>:</td>
                <td><?php echo $row['gender'];?></td>
            </tr>
            <tr>
                <td>Address</td><td>:</td>
                <td><?php echo $row['address'];?></td>
            </tr>
            <tr>
                <td>Phone no</td><td>:</td>
                <td><?php echo $row['phone'];?></td>
            </tr>
            <tr>
                <td>Manufacturer</td><td>:</td>
                <td><?php echo $row['manufacturer'];?></td>
            </tr>
            <tr>
                <td>Chassis no.</td><td>:</td>
                <td><?php echo $row['chassis_no'];?></td>
            </tr>
            <tr>
                <td>Engine no</td><td>:</td>
                <td><?php echo $row['engine_no'];?></td>
            </tr>
            <tr>
                <td>Model no</td><td>:</td>
                <td><?php echo $row['model_no'];?></td>
            </tr>
            <tr>
                <td>Vehical type</td><td>:</td>
                <td><?php echo $row['v_type'];?></td>
            </tr>
            <tr>
                <td>Fuel type</td><td>:</td>
                <td><?php echo $row['fuel_type'];?></td>
            </tr>
            <tr>
                <td>Date Of Registration</td><td>:</td>
                <td><?php echo $row['r_date'];?></td>
            </tr>
            <tr>
                <td>Registration Expires</td><td>:</td>
                <td><?php echo $row['re_date'];?></td>
            </tr>
            <tr>
                <br>
                <!-- <td></td> -->
                <td><input type="button" value="back" class="btn" onclick="history.back()"/> </td>
                <td></td>
                <!-- <td><input class="btn"type="submit" value="confirm" ></td> -->
            </tr>
           </table>
       <?php
            }
        }
    ?>
    </div>
    
</body>
</html>