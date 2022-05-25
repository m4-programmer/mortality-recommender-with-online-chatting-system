<?php 

/**
 * 
 */
class User extends Db
{
	public $db; 
	public function __construct()
	{
		 $this->db = parent::__construct();
		  
	} 
	public  static function login($fusername,$fpassword){
		$db =new Db;
		$user =  $db->fetch('user','','username = ? AND password = ?',array( $fusername,$fpassword),'','','');

		$uip=$_SERVER['REMOTE_ADDR'];
		$ldate=date('d/m/Y h:i:s', time());

		if (count($user) > 0 ) {
			$uid = $_SESSION['id'] = $user[0]['userid'];
			$uemail = $user[0]['email'];
			$loginTime = date('Y-m-d h:i:s a');
			unset($_SESSION['username']);
			$ip=$_SERVER['REMOTE_ADDR'];
			$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
			$addrDetailsArr = @unserialize(file_get_contents($geopluginURL));
			$city = @$addrDetailsArr['geoplugin_city'];
			$country = @$addrDetailsArr['geoplugin_countryName'];
			// updates users log
			$db->insert('userlog',array('userId', 'userEmail', 'userIp','city','country','loginTime'),array($uid,$uemail,$ip,$city,$country,$loginTime));
			// fetch userlog and assign login time to session
			$logged = $db->fetch('userlog','','userId = ? AND loginTime = ?',array( $uid,$loginTime),'','','');
			$_SESSION['login_time'] = $logged[0]['loginTime'];
		}
					
		return $user;
	}
	public function Logout_Log($uid){
		// first select the last entry in the database for the user.
		$res = $this->fetch('userlog','','userId = ?',$uid,'loginTime DESC','','');
		$no = $res[0]['id'];
		$logout_time = date('Y-m-d h:i:s a', time());
		$this->query('UPDATE userlog SET logout_time = :now Where userId = :uid and loginTime = :login_time ');
		$this->bind(':uid', $uid );
		$this->bind(':now', $logout_time );
		$this->bind(':login_time', $_SESSION['login_time']);
		$this->execute();
		//unset($_SESSION['login_time']);
		return $res;
	}
		public function fetchProfileDetails($userid){
			 $res=$this->fetch('user','','userid = ?',$userid,'','','');
			 return $res;
		}
		public function fetch_password($userId,$oldpass){
			$username = $this->getname($userId);
			$fusername = $username[0]['username'];
			$user =  $this->fetch('user','','username = ? AND password = ?',array( $fusername,$oldpass),'','','');
			return $user ;						
		}
		public function change_password($np,$update,$userId,$oldpass){
			//$con="update user set password=?  where id=? and password = ?";
			$this->query("UPDATE user set password= :a,password_update_time=:b where userid=:c and password=:d");
			$this->bind(':a', $np);
			$this->bind(':b', $update);
			$this->bind(':c', $userId);
			$this->bind(':d', $oldpass);
			$this->execute();
			
		}

		public function update_profile($fname,$uname,$gender,$number,$udate,$userid,$pics){
			$this->query("UPDATE user set username=:a,uname=:b,gender=:c,number=:d,updationDate=:e,photo =:f where userid=:g");
			$this->bind(':a', $uname);
			$this->bind(':b', $fname);
			$this->bind(':c', $gender);
			$this->bind(':d', $number);
			$this->bind(':e', $udate);
			$this->bind(':f', $pics);
			$this->bind(':g', $userid);
			$this->execute();
			
		}
	public function check_login(){
		
			if(!isset($_SESSION['id']))
				{	
					$host = $_SERVER['HTTP_HOST'];
					$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
					$extra="index.php";		
					$_SESSION["id"]="";
					header("Location: http://$host$uri/$extra");
					exit();
				}
	}
	public function CheckIfUsernameIsTaken($uname){
		return $this->fetch('user','','username = ? ', $uname,'','','');
	}
	public function CheckIfEmailIsTaken($email){
		$email =  $this->fetch('user','','email = ? ', $email,'','','');
		if (count($email) > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function fetchUserLog($userid){
		return $this->fetch('userlog','','userId = ? ', $userid,'','','');
	}
	public function register($fname,$username,$fpassword,$gender,$number,$email){
		// register users
		$register = $this->insert('user',array('uname', 'username', 'password','gender','number','email','access'),array($fname,$username,$fpassword,$gender,$number,$email, 2));
		// fetch register user details
		 $regsteredUser = $this->fetch('user','','username = ? AND password = ?',array( $username,$fpassword),'','','');

			 $_SESSION['username'] = $regsteredUser[0]['username'];

			
			 return header("location: index.php");
	}
	public static function findfriends(){
		$db =new Db;
		$db->query('SELECT * FROM user where userid != :id and access = :access ');
		$db->bind(':access','2');
		$db->bind(':id',$_SESSION['id']);
		$fetch = $db->fetchresult();
		return $fetch;
	}
	public static function conn(){
		$db =new Db;
		return $db;
	}
	public static function addFriend($friend_username){
		$db = User::conn();
		if (isset($_GET['action']) and isset($_GET['id'])) {
			// check if user is already friend
			$result = $db->fetch('friends','','user_id = ? AND friend_id = ?',array( $_SESSION['id'],$_GET['id']),'','','');
			if (count($result) > 0) {
				return false;
				// if it returns false then insert friend id to friends table else don't
				}else{
					// else add user as friend
		 	$db->insert('friends',array('id','user_id','friend_id','date'),array('',$_SESSION['id'],$_GET['id'],date("Y/m/d h:i:s a") ));
		 	$_SESSION['successmsg'] = "<b>$friend_username</b> added successfully";

		 	return true;
				}
		
			
		 } 
	}
	public static function myfriends(){
		$db = new Db;
		$db->query('SELECT * FROM `user` INNER JOIN friends ON userid = friends.user_id where userid = :id');
		$db->bind(':id', $_SESSION['id']);
		$res = $db->fetchresult();
		if (count($res) < 1) {
			return false;
		}else{
			return $res;
		}
		
	}

	public static function checkfriends(){
		$db = new Db;
		$res = $db->fetch('friends','','user_id = ?',$_SESSION['id'] ,'','','');
		//$res = $db->fetch('friends','','user_id = ? and friend_id = ?',array($_SESSION['id'], $friend_id ),'','','');
		return $res;
	}
	public static function insertchats($id,$msg){
		// fetch messages
		$db = new Db;
		
		// insert messages
		$msg = $db->insert('chatting',array('chatid','sender_id','reciever_id','message','time','status'),array('', $_SESSION['id'], $id,$msg, date('Y-m-d h:i:sa'),''));	
		}
	public static function fetchchats($id){
		// fetch messages
		$db = new Db;
		$res = $db->fetch('chatting','','sender_id = ? and reciever_id = ? || sender_id = ? and reciever_id = ?',array($_SESSION['id'],$id,$id,$_SESSION['id']) ,'','','');
		if (count($res) == 0) {
			return false;
		}else{
		return $res;
	}
}
	public static function getname($id){
		// fetch messages
		$db = new Db;
		$db->query("SELECT * from user where userid=:id");
		$db->bind(':id', $id);
		$res = $db->fetchresult();
		return $res;
		}

	public static function timeago($curr_time){
			$time = strtotime($curr_time);
			// converts timestamp to time ago
			//calculates the difference btw current current time and given timestamp in seconds
			$diff = time() - $time;
			//echo time().' diff is:'.$diff.' dbtime is:'.$time;
			// time difference in seconds
			$sec = $diff;
		

			// convert time difference in minues
			$min = round($diff/60);
			// convert time difference in hours
			$hrs = round($diff / 3600);

			// convert time difference in days
			$days = round($diff/86400);

			// convert time difference in weeks
			$weeks = round($diff/604800);
			// convert time difference in months
			$mnths = round($diff/2600640);

			// convert time difference in yrs
			$yrs = round($diff/31207680);

			//check for seconds
			if ($sec <= 60) {
				return "$sec seconds ago";
			}elseif ($min <=60) {
				if ($min == 1) {
					return "one minute ago";
				}else{
					return "$min minutes ago";
				}
			}
			// chec for hours
			elseif ($hrs <= 24) {
				if ($hrs == 1) {
					return("an hour ago");
				}else{
					return("$hrs hours ago");
				}
			}
			//check for days
			elseif ($days <= 7) {
				if ($days == 1) {
					return("yesterday");
				}else{
					return("$days days ago");
				}
			}
			// check for weeks
			elseif ($weeks <= 4.3) {
				if ($weeks == 1) {
					return("a week ago");
				}else{
					return("$weeks weeks ago");
				}
			}
			//check for months
			elseif ($mnths <= 12) {
				if ($mnths == 1) {
					return("a month ago");
				}else{
					return("$mnths months ago");
				}
			}
			// check for years
			else{
				if ($yrs == 1) {
					return "one year ago";
				}else{
					return "$yrs years ago";
				}
			}
		} 
	public function report($reporter,$reported, $case)
	{
		// check if case has been reported before by checking that the reporter and reported id,
		$check = $this->fetch('reports','','reporter = ? and reported = ? ',array($reporter,$reported) ,'','','');
		if(count($check) > 0){
			return false;
		}else{
		return $this->insert('reports',
			array('id','reporter','reported','cases','time_reported'),
			array('',$reporter,$reported,$case, date('Y-m-d h:i:sa') )
										);
		}	
	}
	public function blockAlert($user_id)
	{
		// it will fetch all block recommendation for the right user, i.e it will only show you block alert for those that are your friends
		$this->query("SELECT * FROM friends INNER JOIN user on friend_id = userid where user_id = :id and STATUS = 1");
		$this->bind(":id", $user_id);
		$res = $this->fetchresult();
		if (count($res) < 1) {
			return false;
		}else{
			return $res;
		}
	}
	public function Blocker($friend_id)
	{
		$this->query("UPDATE friends set block = :block where user_id = :user and friend_id = :friend");
		$this->bind(":block", '1');
		$this->bind(":user", $_SESSION['id']);
		$this->bind(":friend",$friend_id);
		$this->execute();
		return true;
	}
	public function blockedusers(){
		// if status == 0 user has been flag for blocking by Admin
		return $this->fetch('friends','','user_id = ? and block = ?',array( $_SESSION['id'],'1'),'','','');
	}
	public function UnBlocker($friend_id)
	{
		$this->query("UPDATE friends set block = :block where user_id = :user and friend_id = :friend");
		$this->bind(":block", '0');
		$this->bind(":user", $_SESSION['id']);
		$this->bind(":friend",$friend_id);
		$this->execute();
		return true;
	}
	//counts number of recommender friends a user has blocked
	public function CountBlocked()
	{
		$this->query("SELECT * FROM friends INNER JOIN user on friend_id = userid where user_id = :id and STATUS = 1 and block = :block");
			$this->bind(":block", '0');
			$this->bind(":id", $_SESSION['id']);
			$res = $this->fetchresult();
			$total = count($res);
			if ($total > 0) {// if number of people that has not been blocked is zero return true
				return false;
			}else{
				return true;
			}
	}
	

}
 ?>