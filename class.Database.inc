<?php

class Database {
	
  private $_connection;

  private static $_instance;

  public static function getInstance(){
    if(!self::$_instance){
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  public function __construct() {
    $this->_connection = new mysqli('localhost','root','','cd-travel');
    
    if(mysqli_connect_error()){
      trigger_error('Nem sikerült az adatbázis csatlakozás'. mysqli_connect_error(),E_USER_ERROR);
    }
  }
  
  public function getConnection(){
    return $this -> _connection;
  }
}