<?php 
require_once 'include_classes.php';
include 'include/admin_header.php';
	 include 'include/admin_navbar.php';
	 $successmsg = $_SESSION['block_status'];
	 
	   ?>
		<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title" style="margin-top:4%">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-danger text-dark">
												<div class="stat-panel text-center">
												<?php
												//$admin->count_no_of_booked_hostel();

												?>
													<div class="stat-panel-number h1 "><?php //echo $admin->count_no_of_booked_hostel;?></div>
													<div class="stat-panel-title text-uppercase"> Find Friends</div>
												</div>
											</div>
											<a href="findfriends.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-dark">
												<div class="stat-panel text-center">
												<?php $friends = $user->myfriends();?>										
							
													
													<div class="stat-panel-title text-uppercase"> My Friends</div>
													<div class="stat-panel-number p "><?php if ($friends == false): ?>
												<?php echo "0" ?>
							<?php endif ?>
							<?php if ($friends != false): ?>
												<?php echo count($friends) ?>
							<?php endif ?></div>
												</div>
											</div>
											<a href="chats.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-dark">
												<div class="stat-panel text-center">

				<?php $blockedfriends = $user->blockedusers();?>										
				
													<div class="stat-panel-title text-uppercase">Blocked blockedfriends </div>
																<div class="stat-panel-number p "><?php if ($blockedfriends == false): ?>
												<?php echo "0" ?>
							<?php endif ?>
							<?php if ($blockedfriends != false): ?>
												<?php echo count($blockedfriends) ?>
							<?php endif ?></div>
												</div>
											</div>
											<a href="blocked.php" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									
									
									
									
								</div>
								<div class="col-md-12">

										<div class="panel panel-default">
											
											<div class="panel-body  text-dark">
												<div class="stat-panel text-center">
												<div class="stat-panel-title page-title h4 text-uppercase">Recommended Friends to Block </div>

											<div class="stat-panel-number p ">
																<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
								
									<tbody class="msg">
										

											
										
									</tbody>
								</table>
											</div>
												</div>
											</div>
											
										</div>
									
									
									
								</div>
							</div>
						</div>

						<script type="text/javascript">
									
										

											var id = <?php echo $_SESSION['id'] ?>

												function loadRecommendedBlockedUsers(){
									$.post('handlers/recommender.handler.php?action=recommended',function (response) {
										$('tbody').html(response);
									});
								}
	
									// to load message dynamially with timer
									setInterval(function(){
										loadRecommendedBlockedUsers();
									}, 1000);
									
									

								
										</script>
						
						

					</div>
				</div>

			</div>
		</div>
	</div>
				<?php include 'include/scripts.php';
						include 'include/pop_up.php'; ?>