<?php

  class Session{
    private $logged_in=false;
    public $user_id;

    function __construct(){
      session_start();
      $this->check_login();
    }

    public function is_logged_in(){
      return $this->logged_in;
    }

    public function login($user){
      if($user){
        $this->user_id = $_SESSION['uI'] = $user->id;
        $this->logged_in=true;
      }
    }

    public function logout(){
      unset($_SESSION['uI']);
      unset($this->user_id);
      $this->logged_in = false;
    }

    private function check_login(){
      if(isset($_SESSION['user_id'])){
        $this->user_id=$_SESSION['uI'];
        $this->logged_in=true;
      }else{
        unset($this->user_id);
        $this->logged_in = false;
      }
    }
  }

  $session = new Session();
?>
