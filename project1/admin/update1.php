<?php
session_start();
// $_SESSION['reg_no']= test_input($_GET['reg_no']);
if(!isset($_SESSION['user_id']))
{
    echo"<script>document.location ='index.php';</script>";
}

include('C:\xampp\htdocs\project1\assects\config.php');
if(isset($_POST['update-submite'])=="POST")
{
    $reg_no = $_SESSION['r_no'];
    $new_name = test_input($_POST['name']);
    $father_name = test_input($_POST['father_name']);
    $dob = test_input($_POST['dob']);
    $gender = test_input($_POST['gender']);
    $aadhar_no = test_input($_POST['aadhar_no']);
    $dl_no =test_input($_POST['dl_no']);
    $age = age($dob);
    $address = test_input($_POST['address']);
    $phone =test_input($_POST['phone']);
    $sql_1 = "UPDATE customer SET name = '$new_name',father_name = '$father_name',gender='$gender',dob='$dob',aadhar_no='$aadhar_no',address='$address',dl_no='$dl_no',phone='$phone' where r_no = '$reg_no'";
    if($con->query($sql_1)==TRUE)
    {
        echo "<script>alert('vehical sucessfully trnfer/update');</script>";
        $_SESSION['r_no']=NULL;
    }
    else{
        echo "<script>alert('vehical data were not trnfered/update \n $con->error');</script>";
    }
    
    // else{
    //     echo "<script>alert('Please enter proper details');</script>";
    // }
}
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = ucfirst($data);
    return $data;
}
function age($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}
?>
<html>
<head>
    <title>Three Wheeler Registration</title>
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
            width: 80%;
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
        .table-container  {
            width: 100%;
            height: 80%;
            margin: 2px;
            padding: 2px;
            align-items: center;
        }
        .table  {
            /* position:; */
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
            width: 400px;
            text-align :center;
        }
    
    </style>
</head>
<body>
    <?php include('assects/header.php');?>
    <br><br>
   <center>
    <H1 style="color:yellow;background-color:#303f9f;"> Update Owner Details</H1> 

    <form  method="get">
        <table cellspacing="40" cellpading="45">
            <br>
            <tr><input type="text" name="reg_no" placeholder="REG_NO." class="input" required></tr> 
            <br>
            <tr><input type="submit" name="check" value="submit" class="btn"></tr>
        </table>
        <br>
<?php 
if(isset($_GET['check'])=="get")
{
    // if($result->num_rows > 0)
    // //if(TRUE)
    // { ?>
        <div class="table-container">
        <table border="8" CELLSPACING ="2" CELLPADING ="2">
            <tr>
                <th>Owner Name</th>
                <th>Father Name</th>
                <th>Date Of Birth</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Aadhaar No</th>
                <th>Dl No</th>
                <th>Phone</th>
                <th>Chassis_No</th>
                <th>Engine_No</th>
                <th>Reg No</th>
                <th>Reg Date</th>
             
            </tr>
            <!-- Accessing data from table registration -->
   <?php
    include('assects/config.php');
    $reg_no = $_SESSION['r_no']= test_input($_GET['reg_no']);
    global $reg_no;
    $c_data= $con->query("SELECT * FROM registration JOIN customer ON registration.r_no = customer.r_no WHERE registration.r_no = '$reg_no'");
    // $r_data = $con->query("select * from registration where r_no = '$reg_no'");
   if(mysqli_num_rows($c_data) != 0)
   { 
    //while for geting from data base and storing on array 
   while($row=mysqli_fetch_array($c_data))
   {
   ?>   
    <br>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['father_name'];?></td>
                    <td><?php echo $row['dob'];?></td>
                    <td><?php echo $row['age'];?></td>
                    <td><?php echo $row['gender'];?></td>
                    <td><?php echo $row['address'];?></td>
                    <td><?php echo $row['aadhar_no'];?></td>
                    <td><?php echo $row['dl_no'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['chassis_no'];?></td>
                    <td><?php echo $row['engin_no'];?></td> 
                    <td><?php echo "KA 06 TK ".$row['r_no'];?></td>
                    <td><?php echo $row['r_date'];?></td>
                
                </tr>
                <br>
        </div>
   <?php
   }
    //end while
    ?>
     <!-- form start  -->
     </form>
    <form name="update_form" action="" method="POST">
        <table CELLSPACING="40" CELLPADING="45">        
            <tr>
                <td><input type="text" name="reg_no" placeholder="REG_NO" class="input" required></td>
            </tr>
            <tr>
                <td><input type="text" name="name" placeholder="NEW OWNER NAME" class="input" required></td>
                <td><input type="text" name="father_name" placeholder="FATHER NAME" class="input" required> <td>
            </tr>
            <tr>
                <td><input type="date" name="dob" class="input" required></td> 
                <td>GENDER <BR><br>
                    <INPUT TYPE="RADIO" NAME="gender" value="male" required> Male 
                    <INPUT TYPE="RADIO" NAME="gender" value="female"> Female 
                    <INPUT TYPE="RADIO" NAME="gender" value="other"> Other
                </td>
            </tr>
            <tr>
                <td>
                   <input type="text" name="aadhar_no" class="input" placeholder ="AADHAR_no" required>
                </td>
                <td>
                <input type="text" name="dl_no" class="input" placeholder ="DL_no" required>
                </td>
            </tr>
                <tr>
                    <td> <textarea name="address" placeholder="ADDRESS" class="input" required></textarea></td>
                </tr>
                <tr>
                    <td><input type="text" name="phone" placeholder="PHONE NO" minlength="10" maxlength="10" class="input" required></td>
                </tr>
                <tr>
                  <td><input type="submit" value="submit" name="update-submite" class="btn"></td>
            </tr>
   </form>
<?php
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
}
    ?>
        </table>

</body>
<?php include('assects/footer.php'); ?>
</html>