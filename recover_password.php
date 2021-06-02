<?php
include ('header.php');
include ('database.inc.php');
if(isset($_POST['submit'])){

$email=$_POST['email'];
$emailquery="select * from user where email='$email'";
$query=mysqli_query($con,$emailquery);
$emailcount=mysqli_num_rows($query);
if($emailcount){
  $userdata=mysqli_fetch_assoc($query);
  $username=$userdata['name'];
  $usertoken=$userdata['token'];
  $subject="Password Reset";
  $body="Hi , $username.Click here to reset your password http://localhost/phpbasic/recover_password.php?token=$usertoken";
  $sender_email="From: onlinefoodordering11@gmail.com";
  if(mail($email,$subject,$body,$sender_email)){
    $_SESSION['msg']="check your mail to to reset your password $email";
    header('location:login_register.php');
  }else{
    echo"Email not registred...";
  }
}


}

?>
<style>
    .login-form-container {
  background: transparent none repeat scroll 0 0;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
  padding: 80px;
  text-align: left;
}
.login-text {
  margin-bottom: 30px;
  text-align: center;
}
.login-text h2 {
  color: #444;
  font-size: 30px;
  margin-bottom: 5px;
  text-transform: capitalize;
}
.login-text span {
  font-size: 15px;
}
.login-form-container input {
  background-color: transparent;
  border: 1px solid #ebebeb;
  color: #666;
  font-size: 14px;
  height: 50px;
  margin-bottom: 30px;
  padding: 0 15px;
}
.login-form-container input::-moz-placeholder {
  color: #666;
  opacity: 1;
}
.login-form-container input::-webkit-input-placeholder {
  color: #666;
  opacity: 1;
}
.login-toggle-btn {
  padding: 10px 0 19px;
}
.login-form-container input[type="checkbox"] {
  height: 15px;
  margin: 0;
  position: relative;
  top: 1px;
  width: 17px;
}
.login-form-container label {
  color: #242424;
  font-size: 15px;
  font-weight: 400;
}
.login-toggle-btn > a {
  color: #242424;
  float: right;
  font-size: 15px;
  transition: all 0.3s ease 0s;
}
.login-toggle-btn > a:hover {
  color: #e02c2b;
}
.login-register-tab-list {
  display: flex;
  justify-content: center;
  margin-bottom: 40px;
}
.login-register-tab-list.nav a h4 {
  font-size: 25px;
  font-weight: 700;
  margin: 0 20px;
  text-transform: capitalize;
  transition: all 0.3s ease 0s;
}
.login-register-tab-list.nav a {
  position: relative;
}
.login-register-tab-list.nav a::before {
  background-color: #454545;
  bottom: 5px;
  content: "";
  height: 18px;
  margin: 0 auto;
  position: absolute;
  right: -2px;
  transition: all 0.4s ease 0s;
  width: 1px;
}
.login-register-tab-list.nav a:last-child::before {
  display: none;
}
.login-register-tab-list.nav a.active h4,
.login-register-tab-list.nav a h4:hover {
  color: #e02c2b;
}
.login-form button {
  border: medium none;
  cursor: pointer;
}
.button-box button {
  background-color: #f2f2f2;
  border: medium none;
  border-radius: 3px;
  color: #242424;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  line-height: 1;
  padding: 11px 30px;
  text-transform: uppercase;
  transition: all 0.3s ease 0s;
}
.button-box button:hover {
  background-color: #e02c2b;
  color: #fff;
}
 </style>
<div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                              
                                    <h4> Recover Password </h4>
                                   
                               
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form  action="" method="post" >
                                            
                                            <?php if (isset($_GET['error'])){?>
                                             <p class="p-10 mb-2 " style=" color:#ff0000; "><?php echo $_GET['error'];?></p>
                                            <?php } ?>
                                             <p class="text-center">Enter Resgister Email Id</p>
                                                <input type="email" name="user_email" placeholder="Email" required>
                                               
                                                <div class="button-box">
                                                    
                                                    <button type="submit" name="submitl">Send Mail</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
include ('footer.php');
?>