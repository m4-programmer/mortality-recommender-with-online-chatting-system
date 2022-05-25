<?php  require 'include/repeated.php';?>

<div class="ts-main-content">
			<?php include('include/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top: 2%">Access Log</h2>
						<div class="panel panel-default">
							<div class="panel-heading">users log
								
							</div>
							<div class="panel-body">
								<table id="zctb" class="display table-responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>Username</th>
											<th>User Email</th>
											<th>IP</th>
											<th>City</th>
											<th>Country</th>
											<th>Login Time</th>
											<th>Logout Time</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Username</th>
											<th>User Email</th>
											<th>IP</th>
											<th>City</th>
											<th>Country</th>
											<th>Login Time</th>
											<th>Logout Time</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$userid=$_SESSION['id'];
$userLog = $admin->fetchlog();
$cnt = 1;

foreach ($userLog as $row):
	$login = date('Y/M/D h:m a',strtotime($row['loginTime']));
	if (is_null($row['logout_time'])) {
		$logout = '<center>-</center>';
	}else{
	$logout = date('Y/M/D h:m a',strtotime($row['logout_time']));
}
	  	?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $admin->getUsername($row['userId']);?></td>
<td><?php echo $row['userEmail'];?></td>
<td><?php echo $row['userIp'];?></td>
<td><?php echo $row['city'];?></td>
<td><?php echo $row['country'];?></td>
<td><?php echo $login;?></td>
<td><?php echo $logout;?></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 endforeach; ?>
											
										
									</tbody>
								</table>

								
							</div>
						</div>

					
					</div>
				</div>

			

			</div>
		</div>
	</div>

	<?php require 'include/repeated_scripts.php'; ?>