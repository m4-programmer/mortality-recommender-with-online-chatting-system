<?php
session_start();
require_once 'include_classes.php';

date_default_timezone_set('Africa/Lagos');


$userId=$_SESSION['id'];
// code for change password
if(isset($_POST['changepwd']))
{
  
  $password = Db::check_input($_POST["oldpassword"]);
    $oldpass=md5($password);
  	$np=md5($_POST['newpassword']);
	$update=date('d-m-Y h:i:s', time());

	//check if old password is correct
	$result = $user->fetch_password($userId,$oldpass);
	   
	if(count($result) > 0)
	{
		//if old password is correct, update it with new password
		$user->change_password($np,$update,$userId,$oldpass);
		$successmsg = $_SESSION['msg']="Password Changed Successfully !!";
	}
	else
	{
		$msg = $_SESSION['msg']="Old Password not match. !!";
	}	
	

}
?>

	<title>Change Password</title>
	


<?php 
require_once 'include_classes.php';
include 'include/admin_header.php';
	 include 'include/admin_navbar.php';
	   ?>
		<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Change Password </h2>
	
<div class="row">

<div class="col-md-10">
<div class="panel panel-default">
	<div class="panel-heading">


	 <b>Update Password</b> </div>
	<div class="panel-body">
<form method="post" class="form-horizontal" name="changepwd" id="change-pwd" onSubmit="return valid();">
<?php            if(isset($_POST['changepwd']))
{ ?>
			<p style="color: red"><?php echo @htmlentities($msg); ?></p>
			<p style="color: green"><?php echo @htmlentities($successmsg); ?></p>
            <?php } ?>
			<div class="hr-dashed"></div>
			<div class="form-group">
				<label class="col-sm-4 control-label">old Password </label>
				<div class="col-sm-8">
<input type="password" value="" name="oldpassword" id="oldpassword" class="form-control" onBlur="" required="required">
	 <span id="password-availability-status" class="help-block m-b-none" style="font-size:12px;"></span> </div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label">New Password</label>
				<div class="col-sm-8">
			<input type="password" class="form-control" name="newpassword" id="newpassword" value="" required="required">
				</div>
			</div>
<div class="form-group">
	<label class="col-sm-4 control-label">Confirm Password</label>
	<div class="col-sm-8">
<input type="password" class="form-control" value="" required="required" id="cpassword" name="cpassword" >
				</div>
			</div>


							<div class="col-sm-6 col-sm-offset-4">
													<button class="btn btn-default" type="submit">Cancel</button>
													<input type="submit" name="changepwd" Value="Change Password" class="btn btn-primary">
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
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
<script type="text/javascript">
function valid()
{

if(document.changepwd.newpassword.value!= document.changepwd.cpassword.value)
{
alert("Password and Re-Type Password Field do not match  !!");
document.changepwd.cpassword.focus();
return false;
}
return true;
}
</script>

<link rel="stylesheet" href="css/popup_style.css">
  <?php if(!empty($msg)) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong> 
    </h1>
    <p><?php echo $msg; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($msg);  } ?>

<?php if(!empty($successmsg)) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong> 
    </h1>
    <p><?php echo $successmsg ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($successmsg);  
} ?>
 <script>

      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>

</body>

</html>