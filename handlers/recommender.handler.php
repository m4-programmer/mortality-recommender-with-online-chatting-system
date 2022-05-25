<?php 
require '../include_classes.php';
if ($_REQUEST['action'] == 'recommended') {
	
$a = $user->blockAlert($_SESSION['id']); 
$cnt=1;
// if block recommender does return a value do the code in the if statement
if ($a != false) { ?>
	<?php
foreach($a as $row):
	  	$id = $row['friend_id'];
	  	$users = User::getname($id);
	  	//to use for loop where i = 0 to i <= total blocked user 
	  	if ($row['block'] == '0' ) {
	  		
	  	
	  ?>
	  <tr>
<td><?php echo $cnt;?></td>
<td><?php echo $user = $users[0]['username'];?></td>
<td>
		<form method="post" action="handlers/block.handler.php">
				<button class="btn btn-warning" name="block" >Block</button>
				<input type="hidden" class="form-control" name="reported" value="<?php echo $id;  ?>">
		</form>
<!-- to call modal box when the block button is clicked -->
</td>

	</tr>									
									
				<?php	$cnt=$cnt+1;
				}
			
				
endforeach;
	$b = $user->CountBlocked();
if ($b == true) {
					echo('<tr class="odd"><td colspan="5" class="dataTables_empty" valign="top">All recommended Users has been blocked by you</td></tr>');
				}
				}// end of if statement checking if a!=false
				else{ ?>
				<tr class="odd"><td colspan="5" class="dataTables_empty" valign="top">No data available in table</td></tr>
		<?php }
				}
		
		  ?>
		 <?php //include 'include/scripts.php'; ?>
									 
