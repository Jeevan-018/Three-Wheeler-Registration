<?php

class {
    public $chassis_no,$engine_no,$manufacturer,$vehical_type,$model_no;
    public function __construct($c_no,$e_no,$v_type,$m,$fuel,$m_no)
    {
        $this->chassis_no  = $c_no;
        $this->engine_no = $e_no;
        $this->manufacturer = $m;
        $this->vehical_type = $v_type;
        $this->fuel_type = $fuel;
        $this->model_no = $m_no;
    }
    public function v_u()
    {
        include('assects/config.php');
        try
        {
             $sql1 = "INSERT INTO vehical(chassis_no, engine_no, v_type, fuel_type, manufacturer,model_no)VALUES('$this->chassis_no', '$this->engin_no', '$this->vehical_type', '$this->fuel_type', '$this->manufacturer','$this->model_no')";
             if($con->query($sql1)==TRUE)
             {
                $sql2 = "select v_id from vehical where chassis_no = '$c_no'";
                $data = mysqli_fetch_array(mysqli_query($con,$sql2));
                $v_id = $data['v_id'];
                echo"<script>alert('data is sucessfully submited your vehical id is: $v_id');</script>";
                echo"<script>document.forms['vehical-details'].reset();</script>";
                //  echo"<script>document.forms['vehical-details'].reset();document.location='preview.php?id= $regno';</script>";
             }
             else
             {
                 echo"<script>alert('vehical details is not saved');</script>";
             }
        }
        catch(Exception $e)
        {
            echo"<script>alert('message :' $e->getMessage()) </script>";
        }
    }
};
class insert_cmr_reg {
    public  $owner_name , $father_name , $age ,$dob , $gender ,$address,$c_no,$e_no ;
    public function insert_c_v($v_id,$owner_name,$father_name,$age,$dob,$gender,$address,$phone_no)
    {
        $this->v_id =$v_id;
        $this->owner_name = $owner_name;
        $this->father_name = $father_name;
        $this->dob = $dob;
        $this->age = $age;
        $this->gender= $gender;
        $this->address= $address;
        $this->phone = $phone_no;
        $e_t_s = strtotime('+15 years');
        $re_date = date('Y-m-d',$e_t_s);
        include('assects/config.php');
        try
        {
            
             $sql1 = "INSERT INTO registration(v_id,chassis_no,engin_no,re_date)VALUES('$this->v_id','$this->chassis_no','$this->engine_no',$re_date)";
             $sql2 = "INSERT INTO customer (owner_name, father_name, age, dob, gender, address, phone) VALUES('$this->owner_name', '$this->father_name', $this->age, '$this->dob', '$this->gender', '$this->address', '$this->phone')";
            
             if($con->query($sql1)==TRUE)
             {
                
                if($con->query($sql2)==TRUE)
                {
                    $sql3 = "select r_no from registration where chassis_no = '$c_no'";
                    $data = mysqli_fetch_array(mysqli_query($con,$sql3));
                    $r_no = $data['r_no'];
                    echo"<script>alert('data is sucessfully submited your registration number is $r_no');</script>";
                    //echo"<script>document.forms['reg_form'].reset();document.location='preview.php?id=$regno';</script>";
                    
                }
             }
             else
             {
                 echo"<script>alert('data is not saved');</script>";
             }
        }
        catch(Exception $e)
        {
            echo"<script>alert('message :' $e->getMessage()) </script>";
        }
    }
};
// class update_crm{
//     public $reg_no , $new_name , $fathername ,$dob , $gender , $age ,$address,$phone;
//     function update_crm_data($reg_no , $new_name , $fathername ,$dob , $gender , $age ,$address,$phone) {
//       //  echo"<script> alert('sucessfully entered dboperations ');</script>";
//         $this->reg_no = $reg_no;
//         $this->new_name = $new_name;
//         $this->fathername = $fathername;
//         $this->dob = $dob;
//         $this->gender  = $gender ;
//         $this->age = $age;
//         $this->address = $address;
//         $this->phone = $phone;
//         // including database and updating data  
//         include_once('assects/config.php');
//         $result= mysqli_query($con,"select * from registration where reg_no= $reg_no");
//         // checking if given reg_no vehical is exists or not
//         if($result->num_rows > 0)
//         {
//             //update
//             $res = $con->query("update registration set owner_name = '$new_name', father_name ='$fathername',age ='$age' ,dob =' $dob',gender ='$gender' ,address ='$address', phone ='$phone' where reg_no ='$reg_no'; ");
//                 if($res==TRUE)
//                 {
//                     echo"<script> alert('data sucessfully updated');</script>";
//                     echo"<script>document.forms['update_form'].reset();document.location='preview.php?id=$reg_no';</script>";
//                 } 
//                 else
//                 {
//                     echo"<script> alert('data can not be updated');</script>";
//                 }   
//         }
//         else{
//             echo"<script> alert('no such vehical registred on $reg_no this number');</script>";
//         }
//     }

// };

?>