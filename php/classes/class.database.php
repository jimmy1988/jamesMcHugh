<?php
  require_once("php/components/database/config.php");

  class MySQLDatabase{
    private $connection;
    public $last_query;
    private $magic_quotes_active;
    private $real_escape_string_exists;

    function __construct(){
      $this->open_connection();
      $this->magic_quotes_active=get_magic_quotes_gpc();
      $this->real_escape_string_exists = function_exists("mysqli_real_escape_string");
    }

    public function open_connection(){
      $this->connection=mysqli_connect(DBHOST, DBUSER, DBPASSWORD,DB_NAME);
    	if(!$this->connection){
    		die("Database connection failed: " .mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
    	}
    }

    public function close_connection(){
      if(isset($this->connection)){
        	mysqli_close($this->connection);
          unset($this->connection);
      }
    }

    public function query($sql){
      $this->last_query=$sql;
      $result=mysqli_query($this->connection, $sql);
      $this->confirm_query($result);
      return $result;
    }

    public function fetch_assoc($result){
      return mysqli_fetch_assoc($result);
    }

    public function fetch_array($result){
      return mysqli_fetch_array($result);
    }

    public function num_rows($result){
      return mysqli_num_rows($result);
    }

    //get the last id inserted
    public function insert_id(){
      return mysqli_insert_id($this->connection);
    }

    public function affected_rows(){
      return mysqli_affected_rows($this->connection);
    }

    private function confirm_query($result){
      if(!$result){
        die("Database query failed: " . mysqli_error() . "<br>Last Query ran: " . $this->last_query);
      }
    }

    public function escape_value($value){
      if($this->real_escape_string_exists){
        if($this->magic_quotes_active){
          $value=stripslashes($value);
        }
        $value=mysqli_real_escape_string($this->connection, $value);
      }else{
        if(!$this->magic_quotes_active){
          $value = addslashes($value);
        }
      }
      return $value;
  	}

  	private function generateSalt($length){
  		$unique_random_string = md5(uniqid(mt_rand(), true));
  		$base64_string= base64_encode($unique_random_string);
  		$modified_base64_string=str_replace("+",".", $base64_string);
  		$salt = substr($modified_base64_string, 0, $length);
  		return $salt;
  	}

  	public function securePassword($password){

  		//encrypt
  		$hash_format="$2y$10$";
  		$salt=generateSalt(22);

  		$format_and_salt=$hash_format . $salt;

  		$hash=crypt($password, $format_and_salt);

  		return $hash;

  		//decrypt

  		/* $hash2=crypt($password, $hash); */
  	}

  }

  $database=new MySQLDatabase();
  $db =& $database;
?>
