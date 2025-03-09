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
   <link rel="stylesheet" href="css\style.css">
   <style>
    .input
    {
        width: 25%;
        height: 15%%;
        display:flex;
        /* background:  #303f9f ; */
        border: none;
        border: 3px solid  #303f9f;
        border-radius:10px;
        font-size:20px ;
        color: black;
        padding: 10px 25px 10px 10px;
    }
    .btn{    margin-left:50px ;
            width: 75%;
            height: 45px;
            background-color: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 18px;
            color: #303f9f;
            font-weight: 600;
    }
     .table-container table {
        width: 100%;
        height: 80%;
        margin: 2px;
        padding: 2px;
        align-items: center;
    }
    table{
        position:relative;
        text-align: center;
        border: 8px solid #333;
        border-color: #333;
    }
    th{
       background-color: #303f9f;
       color: #fff;
       
    }
    td{
       width: 100px;
    } 
   </style>
    <title>Document</title>
</head>
<body>
    <?php 
          include('assects/header.php'); 
          include('assects/config.php');
    ?>
    <br> 
    <center><H1 style="color:yellow;background-color:#303f9f;">Registered vehicals</H1></center>
            <br>
    <div class="table-container">
                <table border="8" CELLSPACING ="2" CELLPADING ="2">
                    <tr>
                        <th>sl no.</th>
                        <th>Owner Name</th>
                        <th>Father Name</th>
                        <th>Date Of Birth</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Chassis no</th>
                        <th>Engine no</th>
                        <th>Vehical type</th>
                        <th>Fuel type</th>
                        <th>Company</th>
                        <th>Reg no</th>
                        <th>Reg Date / Exp date</th>
                        <th>Vehical Status download RC</th>
                    </tr>
                    <!-- Accessing data from table registration -->
                    <?php
                    include('assects/config.php');
                    $data =$con->query("SELECT *FROM vehical JOIN registration ON registration.v_id = vehical.v_id JOIN customer ON registration.r_no = customer.r_no ");
                    //if start to check data is exists or not
                    if($data->num_rows != 0)
                    {
                        $i=0;
                            //while for geting from data base and storing on array 
                            while($row=$data->fetch_assoc())
                            {
                                $i++;
                    ?>   
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['father_name'];?></td>
                            <td><?php echo $row['dob'];?></td>
                            <td><?php echo $row['age'];?></td>
                            <td><?php echo $row['gender'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['chassis_no'];?></td>
                            <td><?php echo $row['engine_no'];?></td>
                            <td><?php echo $row['v_type'];?></td>
                            <td><?php echo $row['fuel_type'];?></td>
                            <td><?php echo $row['manufacturer'];?></td>
                            <td><?php echo "KA 06 TK ".$row['r_no'];?></td>
                            <td><?php echo $row['r_date']."\n".$row['re_date'] ?></td>
                            <td><?php echo $row['vehical_status']; $reg_no = $row['r_no']; echo " \n<a href= 'preview.php?id=$reg_no'> Download </a>" ;?></td>
                        </tr>
                        <?php
                       
                            }
                            //end while
                            $reg_no="";

                    }
                    // end if 
                    else
                    { 
                        ?>
                        <tr>
                            <td colspan="14"><center><?php echo "no data found "; ?> </center></td>
                           
                        </tr>
                   <?php
                    }
                $con->close()
                    ?>
                </table>
    </div>
                <br>
                <?php include('C:\xampp\htdocs\project1\assects\footer1.php');?>
</body>
</html>