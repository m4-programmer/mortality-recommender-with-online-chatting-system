<?php 
require 'include/repeated.php';
$user = new User;// initializes the user Class
$user->check_login();
date_default_timezone_set('Africa/Lagos');

$user->check_login(); // verifies if user has login and redirect them back to homepage if they have not

$userid=$_SESSION['id'];
if(isset($_POST['update']))
{

$fname=$_POST['fname'];
$uname=$_POST['uname'];
$gender=$_POST['gender'];
$number=$_POST['number'];
$udate = date('d-m-Y h:i:s a', time());
$imageName = $_FILES["image"]['name'];
$imageTmp = $_FILES["image"]['tmp_name'];
$target_location = '../upload/' . basename($_FILES["image"]["name"]);
$imageType = strtolower(pathinfo($target_location,PATHINFO_EXTENSION));
 $check = getimagesize($imageTmp);
 //print_r($check);
// first check if file is an image
if ($check == true) {
	
// then check if file already exist
	//then update profile, but do not move file to upload folder
if (file_exists($target_location)) {
	
	$user->update_profile($fname,$uname,$gender,$number,$udate,$userid,$target_location);
	$_SESSION['profile_success'] = 'Profile updated Succssfully';
	 
	return header('location: my-profile.php');
}
//else if pics do not exist already, update profile and move the pics
else{

//then move file to folder
if (move_uploaded_file($imageTmp, $target_location)) {
	//if it is move then update the other input of the users
	$user->update_profile($fname,$uname,$gender,$number,$udate,$userid,$target_location);
	 $_SESSION['profile_success'] = 'Profile updated Succssfully';
	
	return header('location: my-profile.php');
}else{
	$msg = $_SESSION['profile'] = "Failed to upload image";
	return header('location: my-profile.php');
	}
}// end of pics do no exist
}else{
	$_SESSION['profile'] = "Please upload an Image";	
	return header('location: my-profile.php');
}


//
//
}
//set alerts display
if (isset($_SESSION['profile_success'])) {
	$successmsg = $_SESSION['profile_success'];

}
if (isset($_SESSION['profile'])) {
	$msg = $_SESSION['profile'];
}
?>

<div class="ts-main-content">
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">
	<?php	
$userid=$_SESSION['id'];
$udate = date('d-m-Y h:i:s', time());
	$result = $user->fetchProfileDetails($userid); // fetches users information
	 //$cnt=1;
	   foreach ($result as $row):
	  	?>	
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title"><?php echo $row['uname']?>'s&nbsp;Profile </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">

Last Updation date : &nbsp; <?php echo @$row['updationDate'];?> 
</div>
									

<div class="panel-body">
<form method="post" enctype="multipart/form-data" action="" name="registration" class="form-horizontal">		
<div class="form-group">
<label class="col-sm-2 control-label">Full Name : </label>
<div class="col-sm-8">
<input type="text" name="fname" id="fname"  class="form-control" value="<?php echo $row['uname'];?>"   required="required" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">User Name : </label>
<div class="col-sm-8">
<input type="text" name="uname" id="uname"  class="form-control" value="<?php echo $row['username'];?>"  >
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Gender : </label>
<div class="col-sm-8">
<select name="gender" class="form-control" required="required">
<option value="<?php echo $row['gender'];?>"><?php echo $row['gender'];?></option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="others">Others</option>

</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Phone Number : </label>
<div class="col-sm-8">
<input type="text" name="number" id="number"  class="form-control" maxlength="11" value="<?php echo $row['number'];?>" required="required">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Email id: </label>
<div class="col-sm-8">
<input type="email" name="email" id="email"  class="form-control" value="<?php echo $row['email'];?>" readonly>
<span id="user-availability-status" style="font-size:12px;"></span>
</div>
</div>
<div class="form-group">
		<label for="image" class="col-sm-2 control-label">Image</label>
		<div class="col-sm-8">
		<input onclick="triggerClick()" onchange="displayImage(this)" id="image" clas="form-control" name="image" type="file" value="<?php echo @$img; ?>"  autocomplete="off" >
		<div class="text-center">
		  <img src="<?php echo $row['photo'] ?>" id="newimage" class="img-fluid img-thumbnail" style="border-radius: 50%; height: 300px; width: 50%" id="profileDisplay" alt="Upload Profiles Pics">
		</div>
	
		</div>
	</div>
<?php endforeach;

 ?>

						



<div class="col-sm-6 col-sm-offset-4">

<input type="submit" name="update" Value="Update Profile" class="btn btn-primary">
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
	</div>
	<?php require 'include/repeated_scripts.php'; ?>
	<script type="text/javascript">
		function triggerClick() {
			document.querySelector('#image').click();
		}
		function displayImage(e){
			if (e.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e){
					document.querySelector('#newimage').setAttribute('src', e.target.result);
				}
				reader.readAsDataURL(e.files[0]);
			}
		}
	</script>