<?php
require_once 'include_classes.php';
?>

	<?php include('include/admin_header.php');
			include('include/admin_navbar.php');?>

	<div class="ts-main-content">
			<?php include('include/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top: 2%">Access Log</h2>
						<div class="panel panel-default">
							<div class="panel-heading"><b>Login and Logout Details</b>
								
							</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>User Id</th>
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
											<th>User Id</th>
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
$userLog = $user->fetchUserLog($userid);
$cnt = 1;
foreach ($userLog as $row):
	  	?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $row['userId'];?></td>
<td><?php echo $row['userEmail'];?></td>
<td><?php echo $row['userIp'];?></td>
<td><?php echo $row['city'];?></td>
<td><?php echo $row['country'];?></td>
<td><?php echo $row['loginTime'];?></td>
<td><?php echo $row['logout_time'];?></td>
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

</body>

</html>
