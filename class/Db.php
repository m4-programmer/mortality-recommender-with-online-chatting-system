<?php 

/**
 * 
 */
class Db
{
	private $dbhost = "localhost";
	private $dbuser = "root";
	private $dbname = "chat_system";
	private $dbpword = "";

	private $error;
	private $dbh;
	private $stmt;
	function __construct()
	{
		$conn = "mysql: host=".$this->dbhost.";dbname=".$this->dbname;
		$options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

		try {
			return $this->dbh = new PDO($conn, $this->dbuser,$this->dbpword,$options);
		} catch (PDOEception $e) {
			$this->error = $e->getMessage();
		}
	}
	public function database(){
				$conn = "mysql: host=".$this->dbhost.";dbname=".$this->dbname;
		$options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

		try {
			$this->dbh = new PDO($conn, $this->dbuser,$this->dbpword,$options);
		} catch (PDOEception $e) {
			$this->error = $e->getMessage();
		}
	}
	public function query($query){
		
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($params,$value, $type=null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				
				default:
					$type = PDO::PARAM_STR;
					break;
			}
		}
		$this->stmt->bindValue($params,$value,$type);
	}
	public function execute()
	{
		return $this->stmt->execute();
	}
	public function fetchresult(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function lastinsertid(){
		return $this->dbh->lastInsertId();
	}
	public function checkdata(){
		return $this->stmt->rowCount();
	}
	public function echosmth(){
		echo("echo something");
	}
	public static function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	// always use this method when fetching anything from your database
	public  function fetch($table=null, $columns=null,  $whereClause=null, $whereValue=null, $orderBy=null, $limit=null, $groupBy=null){
		if($limit == ""){
			$limit = ""; 
		} else {
			$limit = " LIMIT $limit "; 
		}
		if($orderBy == ""){
			$orderBy = "";
		} else {
			$orderBy = " ORDER BY $orderBy "; 
		}
		if($groupBy == ""){
			$groupBy = "";
		} else {
			$groupBy = "GROUP BY $groupBy"; 
		}
		//$con = self::connect(); 
		if($columns == ""){
			// select * from table where (email = ? AND data = ? or username = ? )
			$this->query("SELECT * FROM $table WHERE $whereClause $groupBy $orderBy $limit");

			if($whereValue != ""){
				if(is_array($whereValue)){
					$n = 0; 
					$countWhereValue = count($whereValue);
					while($n < $countWhereValue){
						$paramsCount = $n + 1; 
						$this->bind($paramsCount, $whereValue[$n]);
						$n++;
					}
				} else {
					$this->bind(1, $whereValue); 
				}
			} else {
				$this->query("SELECT * FROM $table  $groupBy $orderBy  $limit");
			}
			
			
		} else {
			// $query = $con->prepare("SELECT email, password.. FROM table $whereClause")
			// here means the columns are in array
			$sql = "SELECT "; 
			if(is_array($columns)){
				$colsCount = count($columns); 
				$start = 0; 
				while($start < $colsCount){
					$commas = $start + 1; 
					if($commas == $colsCount){
						$sql .= $columns[$start]." ";
					} else {
						$sql .= $columns[$start].", "; 
					}
					$start ++; 
				}
			} else {
				$sql .= "$columns ";
			}
			
			if($whereValue != ""){
				$sql .= "FROM $table WHERE $whereClause $groupBy $orderBy $limit"; 
				$this->query($sql); 
				if(is_array($whereValue)){
					$n = 0; 
					$countWhereValue = count($whereValue);
					while($n < $countWhereValue){
						$paramsCount = $n + 1; 
						$this->bind($paramsCount, $whereValue[$n]);
						$n++;
					}
				} else {
					$this->bind(1, $whereValue); 
				}	
			} else {
				$sql .= "FROM $table $groupBy $orderBy $limit"; 
				$this->query($sql); 
				//$query = $con->prepare("SELECT * FROM $table  $groupBy $orderBy  $limit");
			}
		}
		$query = $this->fetchresult(); 
		return $query; 
	}


	public  function insert($table, array $columns, array $colValues,$type="" ){
		// if type is set to distinct then table will only accept distinct data's
		try{
			
			$test = "INSERT INTO $table("; 
				foreach ($columns as $key => $value) {
					
					if($key == (count($columns) - 1)){
						$test.= $value; 
					} else {
						$test.= $value.", "; 
					}
				}
			
            $test.=	") VALUES("; 
			    foreach ($columns as $key => $value) {
			    	if($key == (count($columns) - 1)){
						$test.= "?"; 
					} else {
						$test.= "?, "; 
					}
			    }
			$test.= ") ";

             $this->query($test);

            $paramsCount = count($colValues); 

            $start = 0; 
			while($start < $paramsCount){
				$keyData = $start +1; 
				$lastKey = count($colValues) + 1; 

				if($start == count($colValues)){
					$this->bind($lastKey, $colValues[$start]);
				} else {
					$this->bind($keyData, $colValues[$start]);
				}

				$start ++; 
			} 

			



			$this->execute(); 
			return 1; // this means the data has been updated
		} catch(Exception $e){
			die($e->getMessage()); 
		}
	}
}
 ?>