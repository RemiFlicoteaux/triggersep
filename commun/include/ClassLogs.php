<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 26 mai 2015
 */
class Logs extends ORM {

  private static $_user;
  private static $_log_table_name;
  private static $_enabled;
  private static $_connectionName = null;

  /**
   * initialise la classe
   * 
   * @param String $table_name nom de la table
   * @param Array $session_user session avec les informations de l'utilisateur
   */
  public static function init($table_name, $session_user, $enabled) {
    self::$_log_table_name = $table_name;
    self::set_user($session_user);
    self::$_enabled = $enabled;
  }

  /**
   * enregistre les logs dans la table log
   * 
   * @param String $message
   */
  public static function user_log($message) {
    
    if (self::$_enabled) {
      if (self::$_connectionName) {
        $db = self::for_table(self::$_log_table_name, self::$_connectionName);
      } else {
        $db = self::for_table(self::$_log_table_name);
      }
      $db
          ->create()
          ->set('user_login', self::$_user['login'])
          ->set('tache', $message)
          ->save();
    }
  }

  static function set_user($_user) {
    self::$_user = $_user;
  }

  public static function getConnectionName() {
    return self::$_connectionName;
  }

  public static function setConnectionName($connectionName) {
    self::$_connectionName = $connectionName;
  }

  public static function getLog_table_name() {
    return self::$_log_table_name;
  }

  public static function setLog_table_name($log_table_name) {
    self::$_log_table_name = $log_table_name;
  }



}
