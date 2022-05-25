<!-- fetchs lecturer messages -->
					<form action="{{url('admin/complains/reply/'.$data->user_id)}}" method="post">
					@csrf
				<div class="form-group">
					
					<p style="text-align: center!important;"><label >Reponse</label></p>
					<textarea name="response" class="form-control">
						
					</textarea>
					
					 @error('response')
                    <span class="" role="alert" style="margin-top: 5px;color:red;margin-bottom: 5px">
                        <strong>{{ $message }}</strong>
                    </span>
               		 @enderror
				</div>
				<div class="col text-center ">
				<button type="submit" class="btn btn-success">Reply</button>
				</form>
			</div>
<?php 
require '../include_classes.php';
if ($_REQUEST['action'] == 'SendMessage') {
	// fetch messages of chats from database;
	$msg = $_GET['msg'];
	$id = $_GET['id'];
	User::insertchats($id,$msg);
	//echo($msg);
}
if ($_REQUEST['action'] == 'getChat') {
	$id = $_GET['id'];
	//prin $ids = User::getname($id);
	$msgs = User::fetchchats($id);
	//echo $msgs;
	if ($msgs == false) {
		echo("begin chat by sending a message");
	}else{

	//print_r($msgs);
	foreach ($msgs as $row) {
		$sender = User::getname($row['sender_id']);

		$receiver = User::getname($row['reciever_id']);
		$message = $row['message'];
		$timeago = strtotime($row['time']);
		//$time = User::timeago($row['time']);
		$time = date('h:i a', $timeago);
		//$yrs = User::timeago("2019-01-05 09:09:09");
		if ($row['sender_id'] == $_SESSION['id'] ) {
			echo "<p><div style='background-color: #c83;color:black;text-align:right; padding:10px; display: inline-block;float:right;clear:both;margin-bottom:10px'><b>".$sender[0]['username'].":</b> $message <small><em>$time </em></small></div></p><br>";
		}else{
			echo "<p  ><div style='background-color: #ad2;color:black;padding:10px;display:inline-block;clear:both;margin-bottom:10px' ><b>".$sender[0]['username'].":</b> $message <small><em>$time </em></small> </div></p><br>";
		}
		
		
}
	}

}
 ?>
 	@foreach($view as $data)
					
				<div class="d-flex" id="flex">
					<div class="avatar ">
						<img class="avatar-title rounded-circle border border-white bg-info" src="{{ asset($data->user->profile_pics )}}">
					</div>
					<div class="flex-1 ml-3 pt-1">
						<h6 class="text-uppercase fw-bold mb-1">{{$data->user->name}} </h6>
						<span class="text-muted"><small style="color: #ddd">Message:</small>{{$data->message}}</span><br>
						<small class="text-muted badge badge-light">{{$data->created_at->diffForHumans()}}</small><br>
						
					</div>
					
				</div>

			
				
				
					
					
				</div>
				@endforeach
				