<?php 
require_once 'include_classes.php';
include 'include/admin_header.php';
	 include 'include/admin_navbar.php';
	 if (isset($_SESSION['block_status'])) {
	 	$successmsg = $_SESSION['block_status'];
	 }
	 if (isset($_SESSION['report'])) {
	 	$successmsg = $_SESSION['report'];
	 }
	  
	 
	
	// error_reporting(0);
	   ?>
		<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
							<?php 
							$ownername =  User::getname($_SESSION['id']);
							
						?>
						<h2 class="page-title" style="margin-top:4%">Chats <small><?php echo $ownername[0]['username'];?></small></h2>

					<div>
										<div class="row">
					<div class="col-md-12">
						
						<div class="panel panel-default">
							<div class="panel-heading">All users</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-responsive-sm table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											
											<th>Username</th>
											
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Username</th>
												<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$a = User::myfriends(); 
$cnt=1;
if ($a != false) {
	

foreach($a as $row)
	  {
	  	$id = $row['friend_id'];
	  	$users = User::getname($id);
	  	if ($row['block'] == 0) {
	  		
	  	
	  	?>
<tr><td><?php echo $cnt;?></td>

<td><?php echo $user = $users[0]['username'];?></td>
<td>
<div style="display: flex;float: left;">
<a class="btn btn-primary" href="chatting.php?user=<?php echo $user; ?>&id=<?php echo $id; ?>&userid=<?php echo $_SESSION['id']; ?>">Chat</a>
<form method="post" action="handlers/report.handler.php">


<button class="btn btn-twitter" style="margin-left: 5px;" name="report" >Report</button>
<button class="btn btn-warning" style="margin-left: 5px;" name="block" >Block</button>
<!-- javascript will check when report has been clicked and hide the button -->
</div>
<input type="hidden" class="form-control" name="reporter" value="<?php echo $_SESSION['id'];  ?>">
<input type="hidden" class="form-control" name="reported" value="<?php echo $id;  ?>">
</form>
<!-- to call modal box when the block button is clicked -->
</td>

										</tr>
									<?php
$cnt=$cnt+1;}
}

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
	</div>

	<!-- Loading Scripts -->
		<?php require 'include/Scripts.php';
			include 'include/pop_up.php'; ?>
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