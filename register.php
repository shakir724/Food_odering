<?php
ob_start();
include ("header.php");
include ("function.inc.php");
include ('database.inc.php');
//prx($_POST);

if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$mobile=$_POST['mobile'];
$added_on=date('y-m-d h:i:s');
$status=1;
$token=bin2hex(random_bytes(15));//here we create random byte for ever user using this token we send mail for forget password

$query=mysqli_query($con,"select * from user where email='$email'");
$emailcount = mysqli_num_rows($query);
if(mysqli_num_rows(mysqli_query($con,"select * from user where email='$email'"))>0){
   
       
          header("location:login_register.php?error=Email Already Exist !");
    
  }else{
    if($password === $cpassword){
        mysqli_query($con,"insert into user (name,email,password,mobile,added_on,token,status) values('$name','$email','$password','$mobile','$added_on','$token','$status')");       
        
         header("location:login_register.php?error=Register Successfully Please Login");

        
       
    } else{
     
      ?>
        <br>
        <div class="p-10 mb-2 ">
        <h4 style="color:red;">Password Not Match</h4>
        </div>
        
        
        <?php
      
    }
  }
}
     
   



  // prx($_POST);


/*mysqli_query($con,"insert into contact_us(name,email,mobile,subject,message,added_on) values('$name','$email','$mobile','$subject','$message','$added_on')");
echo "Thank you for conatcting with us "*/
ob_end_flush();
?>


<?php
include ('footer.php');
?>

 