<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <link rel="stylesheet" href="css/style.css">
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
    td {
        width: 100px;
    }
   </style>
    <title>Document</title>
</head>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<body>
    <?php 
          include('assects/header.php'); 
          include('assects/config.php');
    ?>
    <br><br>
    <form method="POST">
        <center>
            <input type="text" name="reg_no" placeholder="enter the reg_no" class="input" required>
            <br>
            <input type="submit" value="submit" name = "disp-data" class="btn">
        </form>

        
        <?php
           if (isset($_POST['disp-data'])== "POST")
            {
                $reg_no=test_input($_POST['reg_no']);
        ?>
        <div class="table-container">
                    <h3>Registered Customer</h3> <br>
                <table border="15" CELLSPACING ="2" CELLPADING ="2">
                    <tr>
                        <th>Owner Name</th>
                        <th>Father Name</th>
                        <th>Date Of Birth</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Chasis no</th>
                        <th>Engin no</th>
                        <th>Reg_no</th>
                        <th>Reg Date</th>
                        <th>Download RC.</th>
                    </tr>
                    <!-- Accessing data from table registration -->
                <?php
                    include('assects/config.php');
                    $data =$con->query("SELECT * FROM registration JOIN customer ON registration.r_no = customer.r_no WHERE registration.r_no = '$reg_no'");
                    //if start to check data is exists or not
                    if($data->num_rows != 0)
                    {

                            //while for geting from data base and storing on array 
                            while($row=mysqli_fetch_array($data))
                            {
                ?>   
                    
                        <tr>
                            
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['father_name'];?></td>
                            <td><?php echo $row['dob'];?></td>
                            <td><?php echo $row['age'];?></td>
                            <td><?php echo $row['gender'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['chassis_no'];?></td>
                            <td><?php echo $row['engin_no'];?></td>
                            <td><?php echo "KA 06 TK ".$row['r_no'];?></td>
                            <td><?php echo $row['r_date'] ?></td>
                            <td><?php echo "<a href= 'admin/preview.php?id=$reg_no'> Download </a>"?></td>
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
                            <td colspan="15"><center><?php echo "no data found "; ?> </center></td>
                           
                        </tr>
                   <?php
                    }
            }
                    ?>
                </table>

        </div>
                <br><br>
                <?php include('C:\xampp\htdocs\project1\assects\footer1.php');?>
</body>

</html>