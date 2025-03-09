<?php
error_reporting();
session_start();
include('assects\config.php');
// include('assects/dboperations.php');

if(!isset($_SESSION['user_id']))
{
    echo"<script>document.location ='index.php';</script>";
}
if($con->connect_error)
{
    echo"<script>alert('connection is failed');</script>";
}
if(isset($_POST['submit']))
{
    $chassis_no = test_input($_POST['chassis_no']);
    $engine_no  = test_input($_POST['engine_no']);
    $fuel=test_input($_POST['fuel']);
    $vehical_type=test_input($_POST['vehical_type']);
    $manufacturer=test_input($_POST['manufacturer']);
    $model_no =test_input($_POST['model_no']);
    $v_id = $r_no ="";

    $owner_name=test_input($_POST['name']);
    $father_name=test_input($_POST['father_name']);
    $gender=test_input($_POST['gender']);
    $dob=test_input($_POST['dob']);
    $age=age($dob);
    $aadhar_no =test_input($_POST['aadhar']);
    $dl_no = test_input($_POST['dl_no']);
    $address=test_input($_POST['address']);
    $phone_no=test_input($_POST['phone']);

    $expireYears = 15;
    $sql="select * from vehical where chassis_no = '$chassis_no' and engine_no = '$engine_no'";
    $data = mysqli_query($con,$sql);
    if(mysqli_num_rows($data) > 0)
    {
        echo"<script>alert('The given vehical details is exist');</script>";
    }
    else{
        // vehical details registration 
        $sql1 = "INSERT INTO vehical(chassis_no, engine_no, v_type, fuel_type, manufacturer,model_no)VALUES('$chassis_no', '$engine_no', '$vehical_type', '$fuel', '$manufacturer','$model_no')";
        if($con->query($sql1)==TRUE)
        {
            $sql2 = "select v_id from vehical where chassis_no = '$chassis_no'";
            $v_id_data = mysqli_fetch_array(mysqli_query($con,$sql2));
            $v_id = $v_id_data['v_id'];
        }
        else{
            die("<script>alert('ERROR : $con->error_reporting');</script>");
        }

        //vehical registration process and checking veather vehical details id saved or not 
        $sql2="select * from vehical where v_id = '$v_id'";
        $v_data= mysqli_query($con,$sql2);

        if(mysqli_num_rows($v_data) > 0)
        {        
            $sql3 = "INSERT INTO registration(v_id,chassis_no,engin_no,re_date)VALUES('$v_id','$chassis_no','$engine_no',DATE_ADD(NOW(), INTERVAL $expireYears YEAR))";
            //query execution
            if($con->query($sql3)==TRUE)
            {
                echo"<script>alert('vehical registration is sucessfull');</script>";
                $sql4 = "select r_no from registration where chassis_no = '$chassis_no'";
                $r_no_data = mysqli_fetch_array(mysqli_query($con,$sql4));
                $r_no = $r_no_data['r_no'];
            }
            else{
                echo"<script>alert('ERROR : $con->error');</script>";
            }
            
        }
        else{
            echo"<script>alert('vehical is not exists');</script>";
        }
        // customer details registration and checkin weather vehical is registerd or not
        $sql5="select * from registration where v_id = '$v_id'";
        $v_data= mysqli_query($con,$sql2);
        if(mysqli_num_rows($v_data) > 0)
        {
            $sql6 = "INSERT INTO customer(name, father_name, gender, dob, age, aadhar_no, address, dl_no, phone, r_no)VALUES('$owner_name', '$father_name', '$gender','$dob','$age','$aadhar_no', '$address','$dl_no','$phone_no','$r_no')";
            if($con->query($sql6)==TRUE)
            {
                echo"<script>alert('customer details and vehical registration is sucessfully completed your Reg_no is : $r_no');</script>";
            }
            else{
                echo"<script>alert('ERROR : $con->error');</script>";
            }

        }
    }
}
   // echo"<script>alert('connection is sucessfull');</script>";
// if(isset($_POST['sub-crm']))
// {
//     //data access from registration form
//     $v_id = test_input($_POST['v_id']);
   
//     // sql command to fetch data from table to check the given data is allready exesist or not 
//     $data = mysqli_query($con,"select * from Registration where v_id='$v_id'");
//     if(mysqli_num_rows($data)  > 0)
//     {
//         echo"<script>alert('the given data [vehical id ] is allready registerd');</script>";
//     }
//     else //inserting data into a table when regno is not exist in the table
//     {
//         $e_t_s = strtotime('+15 years');
//         $re_date = date('Y-m-d',$e_t_s);
//         $c_no = $GLOBALS['chassis_no'];
//         $e_no = $GLOBALS['engine_no'];
//         try
//         {
           
//              $sql1 = "INSERT INTO registration(v_id,chassis_no,engin_no,re_date)VALUES('$v_id','$c_no','$e_no','$re_date')";
//              $sql2 = "INSERT INTO customer (owner_name, father_name, age, dob, gender, address, phone) VALUES('$owner_name', '$father_name', '$age', '$dob', '$gender', '$address', '$phone_no')";
            
//              if($con->query($sql1)==TRUE)
//              {
                
//                 if($con->query($sql2)==TRUE)
//                 {
//                     $sql3 = "select r_no from registration where chassis_no = '$c_no'";
//                     $data = mysqli_fetch_array(mysqli_query($con,$sql3));
//                     $r_no = $data['r_no'];
//                     echo"<script>alert('data is sucessfully submited your registration number is $r_no');</script>";
//                     echo"<script>document.forms['reg_form'].reset();document.location='preview.php?id=$r_no';</script>";
//                 }
//              }
//              else
//              {
//                  echo"<script>alert('data is not saved');</script>";
//              }
//         }
//         catch(Exception $e)
//         {
//             echo"<script>alert('message :' $e->getMessage()) </script>";
//         }
//     }
// }

function test_input($data) {
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<style>
    body{
        font-family:Arial, sans-serif ;
        /* background-color: #c5e1a5; */
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
        width: 75%;
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
</style>
<body>
    <?php include('assects\header.php');?><br>
    <center>
    <table  CELLSPACING="40" CELLPADING="45"><br>
      <H1 style="color:yellow;background-color:#303f9f;"> NEW REGISTRATION DETAILS </H1> 
    <!-- vehical details form start -->
      <form name="vehical-details" method="POST">
            <tr>
                <td>CHASISS NUMBER</td>
                <TD><INPUT TYPE="TEXT" class="input"NAME="chassis_no" minlength="9" maxlen="9" required></TD>
                <td>ENGINE NUMBER</td>
                <TD><INPUT TYPE="TEXT"class="input" NAME="engine_no" minlength="9" maxlen="9" required></TD>
            </tr>
            </tr>
                <td>FUIL TYPE </td>
                <TD>
                    <SELECT NAME="fuel" class="input" required>
                        <OPTION >fuel-type</OPTION>
                        <OPTION value="LPG ">LPG </OPTION>
                        <OPTION value="PETROL">PETROL</OPTION>
                        <option value="ELECTRIC">ELECTRIC</option>
                    </SELECT>
                </TD>
                <TD>Manufacturer</TD>
                <TD>
                    <SELECT NAME="manufacturer" class="input" required>
                        <OPTION SELECTED VALUE="">SELECT COMPANY</OPTION>
                        <OPTION value="Bajaj">BAJAJ</OPTION>
                        <OPTION value="Piaggio">Ape-Piaggio </OPTION>
                        <option value="Mahindra">Mahindra</option>
                        <option value="TVS Auto">TVS Auto</option>
                        <option value="ATUL Auto">ATUL Auto</option>
                    </SELECT>
                </td>
            <tr>
            <tr>
                <td>Vehical Type</td>
                <td>
                    <select name="vehical_type" class="input" required>
                        <option value="Passenger">Passenger</option>
                        <option value="Goods">Goods</option>
                    </select>
                </td>
                <td>Model Number</td>
                <td><input type="text" name="model_no" class="input" requried></td>
            </tr>
            <tr>
                <tD>OWNER NAME </tD>
                <TD><INPUT TYPE="TEXT"class="input" NAME="name" required></TD>
                <TD>DATE OF BIRTH </td>
                <TD><INPUT TYPE="date"class="input" NAME="dob" required></TD>
            </tr>
            
            <TR>
                <td> FATHER NAME</td>
                <TD><INPUT TYPE="TEXT"class="input" NAME="father_name" required></TD>
            </TR>
            <TR>
                <TD>GENDER</TD>
                    <td><INPUT class="Rbtn" TYPE="RADIO" NAME="gender" value="Male" required> Male <br>
                        <INPUT class="Rbtn" TYPE="RADIO" NAME="gender" value="Female"> Female <br>
                        <INPUT class="Rbtn" TYPE="RADIO" NAME="gender" value="Other"> Other</td>
            </TR>
            <tr>
                <td>Aadhaar number</td>
                <td><input type="text" name="aadhar" class="input" required></td>
                <td>Dl number</td>
                <td><input type="text" name="dl_no" class="input" required></td>
            </tr>
            <TR>
                <td>ADDRESS</td>
                <TD><TEXTarea name="address" class="input" required></TEXTarea></TD>
            </TR>

            <TR>
                <td>PHONE NUMBER</td>
                <TD><INPUT TYPE="TEXT"class="input" NAME="phone"  required minlength="10" maxlen="10"></TD>
              
                </TD>
            </TR>
            
            <tr>
            <td colspan ="2"><input class="btn" type="reset"  value="clear"></td>
                <td colspan = "2">
                    <input type="submit" value="Submit Vehical Details" name="submit" class="btn">
                </td>
                
            </tr>
        </form>
    </table>
    </center>
    <BR>

    <?php include('assects\footer.php');?>
</body>
</html>