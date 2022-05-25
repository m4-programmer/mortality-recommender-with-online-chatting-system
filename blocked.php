<?php 
require_once 'include_classes.php';
include 'include/admin_header.php';
	 include 'include/admin_navbar.php';
	 if (isset($_SESSION['successmsg'])) {
	 	$successmsg = $_SESSION['successmsg'];
	 }
	 if (isset($_SESSION['block_status'])) {
	 	$successmsg = $_SESSION['block_status'];
	 }
 
 
?>


<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					<h2 class="page-title" style="margin-top:5px">Blocked Users</h2>

					<div>
										<div class="row">
					<div class="col-md-12">
						
						<div class="panel panel-default">
							<div class="panel-heading">All users</div>
							<div class="panel-body">
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


$a = $user->blockedusers(); 
$cnt=1;
foreach($a as $row)
	  {
	  	$fetch  = $user->getname($row['friend_id']);
	  	$name = $fetch[0]['uname'];
	  	$uname = $fetch[0]['username'];
	  	$photos = $fetch[0]['photo'];
	  	?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $name;?></td>
<td><?php echo $uname;?></td>
<?php $photo = $photos; ?>
<td>
	<center><img style="border-radius: 50%" src="<?php if (strlen($photo) > 0): echo $photo; endif;?>"
					  width="60%" height="80px" ></center>
</td>

<td>
	<?php //foreach ($b as $friend): ?>
		
	<form action="handlers/block.handler.php" method="post">
		<input type="hidden" name="id" value="<?php echo $row['friend_id']; ?>">
		<button class="btn btn-primary" name="unblock" > Unblock User</button>
		</form>
		
		
	
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
	</div>

	<!-- Loading Scripts -->
	<?php require 'include/Scripts.php'; ?>
	<?php require 'include/pop_up.php'; ?>