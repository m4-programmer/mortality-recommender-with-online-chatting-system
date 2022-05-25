<?php 
require 'include/repeated.php';
@$successmsg = $_SESSION['successmsg']; 
?>

<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					<h2 class="page-title" style="margin-top:5px">All Users</h2>

					<div>
										<div class="row">
					<div class="col-md-12">
						
						<div class="panel panel-default">
							<div class="panel-heading">All users</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped  table-hover" cellspacing="0" width="100%">
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


$a = $admin->fetchusers(); 
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
	
		
<form action="handler/Blockhandler.php" method="post">
		<input type="hidden" name="id" value="<?php echo $row['userid']; ?>">
		<button class="btn btn-danger" name="Block" > Block User</button>
		</form>
		
	
		

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

	<?php require 'include/repeated_scripts.php'; ?>