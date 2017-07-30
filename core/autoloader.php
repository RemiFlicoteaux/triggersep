<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 21 avr. 2015
 */

require PATH_FUNCTION.'functions.php';

/**
 * fonction qui charge toutes les classes du dossier commun/include 
 * @param String $class
 */
function autoloader($class) {
   $class_name_vendors = strtolower($class);
  if(is_file(PATH_COMMON.'include/Class'.$class.'.php')){
	$class_path = PATH_COMMON.'include/Class'.$class.'.php';
  } else if(is_file($class_path = PATH_COMMON.'include/vendors/'.$class_name_vendors.'.class.php')) {
    $class_path = PATH_COMMON.'include/vendors/'.$class_name_vendors.'.class.php';
  } else {
    return false;
  }
	
	require_once $class_path;
}

spl_autoload_register('autoloader');

//special require 
require_once PATH_COMMON.'include/vendors/export-data.class.php';
require_once PATH_COMMON.'include/vendors/PHPExcel/IOFactory.php';
require_once PATH_COMMON.'include/vendors/subdocument.php';
require_once PATH_COMMON.'include/vendors/database.php';
require_once PATH_COMMON.'include/vendors/collection.php';
require_once PATH_COMMON.'include/vendors/document.php';
require_once PATH_COMMON.'include/vendors/triggersep.php';
require_once PATH_COMMON.'include/vendors/Stringy.php';

