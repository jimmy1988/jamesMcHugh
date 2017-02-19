<?php
  if(!isset($_SESSION)){
    session_start();
  }

  function getValueOfKey($key){
    return $_SESSION[$key];
  }

  function setSessionKey($key, $value){
    $_SESSION[$key]=$value;
  }

  function unsetSessionKey($key){
    $_SESSION[$key]="";
    $_SESSION[$key]=null;
    unset($_SESSION[$key]);
  }

  function destroySession(array $variables){
    for ($i=0; $i < count($variables); $i++) {
      unsetSessionVariable($variables[$i]);
    }

    //fallback in case this does not work
    session_unset();
    session_destroy();
  }

  function resetSession($mins){
    if(isset($_SESSION['exp'])){
      $_SESSION['exp']=time()*$mins*60;
    }
  }

  function sessionExpired(){
    //has session expiry been set
    if(isset($_SESSION['exp'])){
      //has the session expired or does the session expire
      if(time() < $_SESSION['exp'] || $_SESSION['exp'] == "No Expiry"){
        //session has not expired
        return false;
      }else{
        //session has expired
        return true;
      }
    }else{
      //session expiry was not set
      return true;
    }
  }
?>
