<?php

include('database.inc.php');
if (isset(($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['phone'];
$subject=$_POST['subject'];
$message=$_POST['message'];

}

mysqli_query($con,"insert into contact_us(name,email,phone,subject,message,) values('$name','$email','$mobile','$subject','$message')");
$msg= "Thank you for conatcting with us ";

?>
 