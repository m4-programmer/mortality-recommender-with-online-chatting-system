<?php 

/**
 * 
 */
class Admin extends Db
{
	
	function __construct()
	{
		$this->db = parent::__construct();
	}
	public function fetchusers(){
		return $this->fetch('user','','','','','','');

	}
	public function blockuser($id){
		$this->query('UPDATE user set status = 1 where userid = :id');
		$this->bind(':id', $id);
		$this->execute();
	}
	public function unblockuser($id){
		$this->query('UPDATE user set status = 0 where userid = :id');
		$this->bind(':id', $id);
		$this->execute();
	}
	public function reports()
	{
		return $this->fetch('reports','','','','','','');
	}
	public function blockedusers(){
		// if status == 0 user has been flag for blocking by Admin
		return $this->fetch('user','','status = ?','1','','','');
	}
	public function fetchlog(){
		return $this->fetch('userlog','',' ', '',' logout_time ','','');
	}
	public function getUsername($user)
	{
		$this->query("SELECT * from user where userid=:id");
		$this->bind(':id', $user);
		$res = $this->fetchresult();
		$username = $res[0]['username']; 
		return $username;
	}
}

 ?>