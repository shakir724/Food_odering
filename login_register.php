<?php
include ('header.php');

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
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>
                                <a data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form  action="login.php" method="post" >
                                            
                                            <?php if (isset($_GET['error'])){?>
                                             <p class="p-10 mb-2 " style=" color:#ff0000; "><?php echo $_GET['error'];?></p>
                                            <?php } ?>
                                                <input type="email" name="user_email" placeholder="Email" required>
                                                <input type="password" name="user_password" placeholder="Password" required>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <a href="recover_password.php">Forgot Password?</a>
                                                    </div>
                                                    <button type="submit" name="submitl">Login</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form  action="register.php" method="post" >
                                                <input type="text" name="name" placeholder="Name" id="name" required>
												<input name="email" id="email" placeholder="Email" type="email" required>
									
                                                <input type="password" name="password" placeholder="Password" id="password" required>
                                                <input type="password" name="cpassword" placeholder="Confirm Password" id="password" required>
                                                <input type="text" name="mobile" placeholder="Mobile" id="mobile" required>
                                                <div class="button-box">
                                                    <button type="submit" name="submit" id="register_submit">Register</button>
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