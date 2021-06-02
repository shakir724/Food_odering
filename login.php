<?php
ob_start();
include ("header.php");
include ("function.inc.php");
include ('database.inc.php');
session_start();



if(isset($_POST['user_email']) && isset($_POST['user_password'])){
$email=$_POST['user_email'];
$password=$_POST['user_password'];

 $query=mysqli_query($con,"select * from user where email='$email' and password='$password'");
 $check = mysqli_num_rows($query);
 if($check>0){
     $row=mysqli_fetch_assoc($query);//here we store the data we get from login page in $row
    $status=$row['status'];//here we store the status value to verify user suold be active
     if($status==1){
         $_SESSION['FOOD_USER_ID']=$row['id'];//here we creating seesion varble and store the value og user id
         $_SESSION['FOOD_USER_NAME']=$row['name'];
         header("location:shop.php");
    }else{
        header("location:login_register.php?error=Your Account Has Been Deactivated");
        exit();
 }

}else{

    header("location:login_register.php?error=Please Enter Valid Login Credentials ");
    exit();
}
}

?> 