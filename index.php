<?php
 
  require 'class/Db.php';
  require 'class/User.php';
  session_start();
  $db = new Db;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username=Db::check_input($_POST['username']);
    if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
      $msg = $_SESSION['msg'] = "<b>Username should not contain space and special characters!</b>"; 
    }
    else{
    $fusername=$username;
    $password = Db::check_input($_POST["password"]);
    $fpassword=md5($password);
    $row = User::login( $fusername,$fpassword);
    if(count($row) == 0){
      $msg = $_SESSION['msg'] = "<span style='color:red'><b>Login Failed, Incorrect Username or Password! </b></span>";
    }
    else{
      
      if ($row[0]['access'] == 1) {
        $_SESSION['id']=$row[0]['userid'];
        $successmsg = '<b>Login Success, Welcome Admin!</b>';
        ?>
        <script>
           window.location.href='admin/';
        </script>
        <?php
      }
      else{
        $_SESSION['id']=$row[0]['userid'];
        $successmsg = '<b>Login Success, Welcome User!</b>';
        //update Access Log
        ?>
        <script>
          window.location.href='dashboard.php?';
        </script>
        <?php
      }
    }
    
    }
  }
?>
<?php require 'include/header.php';
      require_once 'include/navbar.php';
 ?>  
<!-- body and login section -->
  <div class="wrapper">
	 <div class="typing-element"></div>
	   <div class="login fadeInUp animated animated_5">
		    <div class="login_left_combo_parent">
			     <div class="carousel slide carousel-fade" data-ride="carousel">
				      <div class="carousel-inner" role="listbox">
					       <div class="item active" style="background-image: url(img/backgrounds/login2.jpg)"></div>
        					<div class="item" style="background-image: url(img/backgrounds/login2.jpg)"></div>
        				  <div class="item" style="background-image: url(img/backgrounds/login3.jpg)"></div>
				      </div>
			     </div>
			    <div class="login_left_combo">
				    <div class="fadeInUp animated animated_9">
					     <h1>Welcome!</h1>
					     <p>Share what&#039;s new and life moments with your friends.</p>
						</div>
			   </div>
		    </div>
		<div class="col-md-6">
     <div style="color: red; font-size: 15px;">
      <center>
      <?php
        
        if(isset($_SESSION['msgs'])){
          $successmsg = $_SESSION['username'];
          $successmsg = $_SESSION['msgs'];
            unset($_SESSION['msgs']);
        }
      ?>
      </center>
    </div>			<form id="login" class="fadeInUp animated animated_9" method="post">
				<p class="title">Login</p>
				<div class="errors"></div>
				<div class="wow_form_fields">
					<label for="username">Username</label>
					<input id="username" name="username" value="<?php echo @$_SESSION['username']; ?>" type="text" autocomplete="off" required autofocus>
				</div>
				<div class="wow_form_fields">
					<label for="password">Password</label>
					<input id="password" name="password" value="" type="password" required >
				</div>
				<div class="forgot_password">
					<a href="#">Forgot Password?</a>
				</div>
				<div class="login_signup_combo">
					<div class="login__">
						<button type="submit" class="btn btn-main btn-mat btn-mat-raised add_wow_loader">Login</button>
					</div>
            <?php 
        if (!isset($_SESSION['id'])):
         ?>
					<div class="signup__">
												<p>Don&#039;t have an account? <a class="dec" href="register.php">Register</a></p>
											</div><?php endif; ?>
                     
				</div>
								
			</form>
		</div>
	</div>
</div>


<?php 
require_once 'include/pop_up.php';
 ?>