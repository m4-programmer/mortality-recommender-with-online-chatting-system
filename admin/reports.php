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
					<h2 class="page-title" style="margin-top:10px">All Reports <a href="users.php" class="btn btn-warning pull-right">Block a User</a></h2>


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
											<th>Reporter</th>
											<th>Reported</th>
											<th>Case </th>
											
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Name</th>
											<th>Username</th>
											<th>Case </th>
											
										</tr>
									</tfoot>
									<tbody>

<?php	


$a = $admin->reports(); 
$cnt=1;
foreach($a as $row)
	  {
	  	$reporter = $admin->getUsername($row['reporter']);
	  	$reported = $admin->getUsername($row['reported']);
	  	?>
<tr><td><?php echo $cnt;?></td>
<td ><?php echo $reporter.' ';?></td>
<td><strong class="text-danger"><?php echo $reported;?></strong></td>
<?php $photo = $row['time_reported']; ?>
<td>
	<center> <div class="alert alert-danger bolder"><b>Mortality Case</b></div></center>
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
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap-select.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
	<script src="../js/dataTables.bootstrap.min.js"></script>
	<script src="../js/Chart.min.js"></script>
	<script src="../js/fileinput.js"></script>
	<script src="../js/chartData.js"></script>
	<script src="../js/main.js"></script>
	
<link rel="stylesheet" href="../css/popup_style.css">
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