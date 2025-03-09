<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    echo"<script>document.location ='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>vehical Deregistration</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
         body{
        font-family:Arial, sans-serif ;
        }
   
        .btn{
        margin-left:50px ;
        width: 75%;
        height: 45px;
        background-color: #303f9f;
        border: none;
        outline: none;
        border-radius: 40px;
        cursor: pointer;
        font-size: 18px;
        color: yellow;
        font-weight: 600;
        }

        .input
        {
            width: 100%;
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
        .table-container table  {
            width: 100%;
            height: 80%;
            margin: 2px;
            padding: 2px;
            align-items: center;
        }
        .table  {
            position:relative;
            text-align: center;
            margin: 4px;
            padding: 4px;
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
</head>
<body>
<header>
<?php include('assects/header.php');?>
</header>   
    <br>
    <center><H1 style="color:yellow;background-color:#303f9f;">Deregistration</H1>
    <br>

    <table CELLSPACING="40" CELLPADING="45">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <tr>
            <td><input type="text" name="reg_no" placeholder="REG_NO" class="input" required></td>
        </tr>
        <TR>
            <td><input type="submit" value="SUBMIT" class="btn"></td>
        </TR>
        </form>
    </table>
    </center>

<!--data table displaying after submiting reg_no number  -->
<?php if($_SERVER['REQUEST_METHOD']=="POST")
   
 {?>
    <center>
                <table class="table" border="10" CELLSPACING ="2" CELLPADING ="2">
                    <tr>
                        <th>sl no.</th>
                        <th>Owner Name</th>
                        <th>Father Name</th>
                        <th>Date Of Birth</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Chasis no</th>
                        <th>Engine no</th>
                        <th>Vehical type</th>
                        <th>Fuel type</th>
                        <th>Company</th>
                        <th>Reg no</th>
                        <th>Remove</th>
                    </tr>
                    <!-- Accessing data from table registration -->
                    <?php
                        include('assects/config.php');
                        $reg_no=test_input($_POST['reg_no']);
                        $data =$con->query("SELECT *FROM vehical JOIN registration ON registration.v_id = vehical.v_id JOIN customer ON registration.r_no = customer.r_no  WHERE registration.r_no = '$reg_no'");
                        //if start to check data is exists or not
                        if($data->num_rows != 0)
                        {
                            $i=0;
                                //while for geting from data base and storing on array 
                                while($row=mysqli_fetch_array($data))
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
                                        <td><?php echo $row['engin_no'];?></td>
                                        <td><?php echo $row['v_type'];?></td>
                                        <td><?php echo $row['fuel_type'];?></td>
                                        <td><?php echo $row['manufacturer'];?></td>
                                        <td><?php echo "KA 06 TK ".$row['r_no'];?></td>
                                        <td><?php $reg_no = $row['r_no']; echo "<a href= 'remove.php?id=$reg_no'> Deregister</a>" ;?></td>
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
 }?>
                </table>
                <br>

                
    </center>
</body>
<footer>
<?php include('assects/footer.php');?>
</footer>
</html>
<?php 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>