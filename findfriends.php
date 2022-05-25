<?php 
require_once 'include_classes.php';
include 'include/admin_header.php';
	 include 'include/admin_navbar.php';
	 if (isset($_GET['action']) and isset($_GET['id'])) {
	 		$uname = User::getname($_GET['id']);
	 		$friend_username = $uname[0]['username'];
	 		$add = User::addFriend($friend_username); // add friends
	 		
	 		if ($add == true) {	
	 			
	 			header("location:  findfriends.php?successmsg=". $_SESSION['successmsg']);	
	 		
	 			
	 		}else{
	 			$message  = "You are already friends with <b>$friend_username</b>.";
	 			header("location:  findfriends.php?msg=". $message);
	 			;
	 		}

	 }
	 //$successmsg = "hello";
	 if (isset($_GET["msg"])) {
	 			$msg  = $_GET['msg'];
	 			
	 		}
	 		
	 		if (isset($_GET['successmsg'])) {
	 			$successmsg = $_SESSION['successmsg'];

	 		}

	   ?>
		<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title" style="margin-top:4%">Find Friends</h2>
						<?php 
			
						?>
				

			</div>
							<div class="row">
					<div class="col-md-11" style="margin-left: 10px">
						
						<div class="panel panel-default">
							<div class="panel-heading">All users</div>
							<div class="panel-body">
								<?php   ?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>Name</th>
											<th>Username</th>
											<th>Photo </th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Name</th>
											<th>Username</th>
											<th>Photo </th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
<?php	


$a = User::findfriends(); 
$cnt=1;
foreach($a as $row)
	  {

	  	?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $row['uname'].' ';?></td>
<td><?php echo $row['username'];?></td>
<?php $photo = $row['photo']; ?>
<td>
	<center><img style="border-radius: 50%" src="<?php if (strlen($photo) > 0): echo $photo; endif;?>"
					  width="60%" height="80px" ></center>
</td>

<td>
	<?php //foreach ($b as $friend): ?>
		

		<a class="btn btn-primary" id="add" href="findfriends.php?action=add&id=<?php echo $row['userid']; ?>"> Add Friend</a>
		
	
		<?php //endforeach ?>

</td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>

								
							</div>
						</div>

					
					</div>
				</div>

			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	
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
<?php unset($msg);

  } ?>

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
		unset($_SESSION['successmsg']);
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
				<?php //include 'include/scripts.php'; ?>
	