<?
class M_User{
  private static $validName = "user";
  private static $validPass = "password";
  public static function login($login, $pass){
    if (($login == self::$validName) && ($pass == self::$validPass)){
      return true;
    } 
    return false;
  }
  public static function getName(){
    return self::$validName;
  }
}