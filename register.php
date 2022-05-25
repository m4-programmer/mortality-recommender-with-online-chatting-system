<?php
	require 'class/Db.php';
	require 'class/User.php';
	session_start();
	$user = new User;

	if (isset($_SESSION['id'])) {
		header('location: ./? you are logged in');
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username=Db::check_input($_POST['username']);
		$password = Db::check_input($_POST["password"]);
		$fpassword=md5($password);
		$fname = Db::check_input($_POST["name"]);
		$gender = Db::check_input($_POST["gender"]);
		$number = Db::check_input($_POST["number"]);
		$email = Db::check_input($_POST["email"]);
		$genders = strlen($gender);
		$checkEmail = $user->CheckIfEmailIsTaken($email);
		
		if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
			$msg = $_SESSION['sign_msg'] = "<span style='color:red'>Username should not contain space and special characters!</span>"; 
			//header('location: signup.php');
		}elseif(empty($username) or empty($password) or empty($fname)){
			$msg = "<span style='color:red'><b>Please fill in all the fields </b></span>";
		}elseif($genders > 6  ){
			$msg = "<span style='color:red'><b>Please Select Your Gender</b></span>";
		}
		elseif ( $user->CheckIfUsernameIsTaken($username) == true ) {
			$msg = "<span style='color:red'><b>Username already Taken, Please Select a new username </b></span>";
		}
		
		else{
		// checks if username is already taken
		
		if ($checkEmail == true) {
			$msg = "<span style='color:red'><b>Email is already taken, Please Select another Email</b></span>";
		
		}else{
			$user->register($fname,$username,$fpassword,$gender,$number,$email);
			$successmsg = $_SESSION['msgs'] = "<span style='color:black'><b>Sign up successful. You may login now!</b></span>"; 
	
		
			}
		}
	}
?>
<?php 
require_once 'include/header.php';
require_once 'include/navbar.php';
 ?>
 <div class="wrapper">
	 <div class="typing-element"></div>
	   <div class="login fadeInUp animated animated_5">
		    <div class="login_left_combo_parent">
			     <div class="carousel slide carousel-fade" data-ride="carousel">
				      <div class="carousel-inner" role="listbox">
					       <div class="item active" style="background-image: url(img/backgrounds/login3.jpg)"></div>
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
			<form id="login" class="fadeInUp animated animated_9" method="post">
				<p class="title">Register</p>
				<div class="errors"></div>
				<div class="wow_form_fields">
					<label for="username">Name</label>
					<input id="username" name="name" type="text" value="<?php echo @$fname; ?>" autocomplete="off" autofocus required>
				</div>
				<div class="wow_form_fields">
					<label for="username">Username</label>
					<input id="username" name="username" value="<?php echo @$username; ?>" type="text" autocomplete="off" autofocus required>
				</div>
				<div class="wow_form_fields">
					<label for="password">Password</label>
					<input id="password" name="password" type="password" value="<?php echo "" ?>"   required>
				</div>
				<div class="wow_form_fields">
					<label for="password">Gender</label>
					<select name="gender">
						<option>Select Gender</option>
						<option value="Male" <?php if (@$gender == "Male") {
							echo "selected";
						} ?>>Male</option>
						<option value="Female" <?php if (@$gender == "Female") {
							echo "selected";
						} ?>>Female</option>
					</select>
				</div>
				<div class="wow_form_fields">
					<label for="Phone Number">Phone Number</label>
					<input id="number" name="number" type="text" value="<?php echo @$number; ?>"  autocomplete="off" minlength="11">
				</div>
				<div class="wow_form_fields">
					<label for="email">Email</label>
					<input id="Email" name="email" type="Email" value="<?php echo @$email; ?>"  autocomplete="off" required>
				</div>
				
				
				<div class="login_signup_combo">
					<div class="login__">
						<button type="submit" class="btn btn-main btn-mat btn-mat-raised add_wow_loader">Register</button>
					</div>
					<div class="signup__">
					<p>Have an account already? <a class="dec" href="index.php"><u>Login</u></a></p>
							</div>
				</div>
								
			</form>
		</div>
	</div>
</div>

<?php 
require_once 'include/pop_up.php';
 ?>