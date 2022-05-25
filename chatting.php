<?php 
require_once 'include_classes.php';
include 'include/admin_header.php';
	 include 'include/admin_navbar.php';
	   ?>
		<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<b><?php 
							$ownername =  User::getname($_SESSION['id']);
							$photo = $ownername[0]['photo'];
							$friend = User::getname($_GET['id']);
							$friendphoto = $friend[0]['photo'];
							
						?></b>
						<h2 class="page-title" style="margin-top:4%">Chat <small><?php echo $ownername[0]['username'];?></small> <img style="border-radius: 50%" src="<?php if (strlen($photo) > 0): echo $photo; endif;?>"
					  width="10%" height="60px" >

							<span class="pull-right"><a class=" btn btn-danger" style="margin-right: 10px" href="#">Report</a><a class=" btn btn-warning" href="chats.php">Back</a></span></h2>

						<?php 
						
						?>
					<div>
										<div class="row">
					<div class="col-md-12">
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<b><?php echo strtoupper($_GET['user']) ?></b>
								<?php if ($friendphoto != ""): ?>
									
								
								<img class="pull-right" style="border-radius: 50%;margin-top: -11px;" src="<?php if (strlen($photo) > 0): echo $friendphoto; endif;?>"width="8%" height="45px" alt="No photo Available">
								<?php endif ?>
							</div>
							<div class="panel-body">
							
								
							<div class="msg" style="margin-bottom: 10px;padding-bottom:  50px"></div>
							<center>
								<div class="form-group" style="width: 50%; margin-top: 5px;margin-bottom: -13px">
  
  <textarea class="form-control rounded-0 sm" id="txtmsg" name="msg" placeholder="Enter your message" rows="2" style="border-radius: 15px"></textarea>
</div>
							</center><br>	

							<center><button class="btn btn-success" id="send">Send</button> </center> 
							
							<div class="hidden">
								<input type="text" name="id" id='id' value="<?php echo $_GET['id'] ?>">
							</div>
							
					
								
							</div>
						</div>

					
					</div>
				</div>
					</div>

			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
		<?php include 'include/scripts.php'; ?>
		<script type="text/javascript">
	$(document).ready(function(){
		loadChat();
		// when user clicks on send button
		$("button").click(function(e){
			e.preventDefault();
		var message = $('#txtmsg').val();// gets users message	
		var id = $('#id').val();// gets id of the reciever
 
			function sendMessage(){
				$.post('handlers/chat.handler.php?action=SendMessage&msg='+message+'&id='+id, function(response){
					//alert(response);
					$('#txtmsg').val('');// clears the input field
				});
				}

		sendMessage();	
	
						
				});
			

		
		/*$('#txtmsg').keyup(function(e){
			var message = $(this).val();
			var id = $('#id').val();
		
			//var send = $('#send').click();
			//checks if the enter button was pressed
			//if(e.which == 13 ){
				
					function sendMessage(){
				$.post('handlers/chat.handler.php?action=SendMessage&msg='+message+'&id='+id, function(response){
					alert(response);
					$('#txtmsg').val('');
				});
				}
				//})
			//}
			
		});*/
	});// close ready function	
			
		function loadChat(){
			var id = $('#id').val();
			$.post('handlers/chat.handler.php?action=getChat&id='+id,function (response) {
				$('.msg').html(response);
			});
		}
	
	// to load message dynamially with timer
	setInterval(function(){
		loadChat();
	}, 2000);

	</script> 