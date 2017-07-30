<?php

/**
 * Fichier contenant des fonctions communes aux projets
 * 
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 31 mars 2015
 */

/**
 * affiche des 'templates'
 * 
 * @param String $tpl
 * @param Array|String $message
 * @param String|null $type //danger,success,info,warning
 * @return boolean
 */
function display_template_message($tpl, $message, $type = null) {
  $t_path = PATH_TEMPLATE . $tpl . '.tpl.php';
  if (file_exists($t_path)) {
    if (is_array($message)) {
      extract($message);
    }
    include $t_path;
    return true;
  }
  return false;
}

/**
 * retourne la liste des projets sous forme de tableaux
 * @return Array 
 */
function get_list_projets() {
  $projets =ORM::for_table('projets')->find_array();
  if ($projets) {
    return ($projets);
  }
  return null;
}

/**
 * fonction qui retourne le code de projet //a revoir
 * 
 * @param String nom de projet
 * @return String 
 */
function get_code_pj($short_name) {
  $short_name = strtoupper($short_name);
  $list_hp = get_list_hp();
  foreach ($list_hp as $code_hp => $data) {
    if (is_array($data) && array_key_exists($short_name, $data)) {
      return $code_pj;
    }
  }
  return null;
}

/**
 * fonction qui supprime les accents
 * 
 * @param String 
 * @return String 
 */
function removeAccents($str) {
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
  return str_replace($a, $b, $str);
}

/**
 * fonction qui permet de convertir un fichier CSV en tableau PHP a deux dimension (pour un fichier a 3 colonnes seulement)
 * 
 * @param String $csv chemin vers le fichier csv
 * @return Array $final_tab ou null si une erreur se produit lors de l'ouverture du CSV
 */
function csv_to_array($csv) {
  if (file_exists($csv)) {
    $final_tab = array();
    $handle = fopen($csv, "r");
    if ($handle) {
      while (($line = fgets($handle)) !== false) {
        $tab = explode(';', $line);
        $final_tab[$tab[0]] = array($tab[1] => $tab[2]);
      }
      fclose($handle);
    } else {
      return null;
    }
    return $final_tab;
  }
}

/**
 * fonction de template permet de remplacer toutes les occurences du fichier $tpl sous la forme {{nom_de_la_variable}}
 * @param String $tpl nom du fichier de template
 * @param Array $tab_var tableau contenant le nom des variable a remplacer avec leur valeurs
 * @return String le contenu du template modifié
 */
function set_tpl_var($tpl, $tab_var) {
  if (file_exists($tpl)) {
    $tab_var_search = array();
    $content = file_get_contents($tpl);
    $tab_var_key = array_keys($tab_var);
    foreach ($tab_var_key as $k => $v) {
      $tab_var_search[$k] = "{{{$v}}}";
    }

    $content = str_replace($tab_var_search, $tab_var, $content);
    return $content;
  }
  return null;
}

/**
 * Permet de selectionner l'element actuelle dans une liste déroulante
 * @param String $option1
 * @param String|Array $option2
 * @return boolean
 */
function selected($option1, $option2 = null) {
  if (is_array($option2)) {
    return in_array($option1, $option2);
  }
  return $option1 == $option2;
}

/**
 * fonction qui deplace touts les fichiers d'un dossier vers un autre
 * cette fonction efface les fichier dans le dossier de déstination si il existe déja
 * 
 * @param String $from dossier source sous la forme nom_du_dossier/
 * @param String $to dossier destination sous la forme nom_du_dossier/
 * @return boolean renvoie false si le dossier de destination n'existe pas
 */
function move_file($from, $to) {
  $files = scandir($from);
  if (file_exists($to)) {
    foreach ($files as $fname) {
      $extension = pathinfo($fname);
      if (file_exists($to . $fname)) {
        @chmod('0755', $fname);
        @unlink($to . $fname);
      }
      if ($fname != '.' && $fname != '..' && $extension['extension'] == 'php') {
        rename($from . $fname, $to . $fname);
      }
    }
    return true;
  }
  return false;
}

/**
 * permet d'afficher un 'element' (bloc html) et de lui passer des variables
 * 
 * @param type $element
 * @param array $vars
 * @param String $script parametre optionnel permet d'ajouter un script pour cette 'element' il suffit d'ecrire le nom du script ex: module-element
 * @return boolean
 */
function element($element, Array $vars = null, $script = null) {
  $e_path = PATH_ELEMENT . $element . '.php';
  $s_path = PATH_JS . $script . '.js';

  if (file_exists($e_path)) {
    if ($vars) {
      extract($vars);
    }
    include $e_path;
    if ($script) {
      echo "<script class='rm' src='$s_path'></script>";
    }
    return true;
  }
  return false;
}


/**
 * convertie une date en timestamp
 * 
 * @param type $date
 * @return type
 */
function reg_date_to_timestamp($date) {
  return strtotime(str_replace('/', '-', $date));
}

/**
 * fonnction a utilise avec la fonction array_walk_recursive convertie les elements d'un tableau en utf-8
 * 
 * @param type $item
 * @param type $key
 */
function encode_array_items_utf8(&$item, $key) {
  $item = utf8_encode($item);
}

/**
 * ajoute ou modifie des parametres de type 'GET' dans l'url courante a partir d'un tableau
 * 
 * @param array $query_params
 * @return String query
 */
function make_query_string(Array $query_params = []) {
  $tab = !empty($query_params);
  $query_string = $_SERVER['QUERY_STRING'];
  parse_str($query_string, $params);
  if ($tab) {
    foreach ($query_params as $k => $v) {
      if (array_key_exists($k, $params)) {
        $params[$k] = $query_params[$k];
      } else {
        $params[$k] = $v;
      }
    }
    return http_build_query($params);
  }
  return $query_string . ($tab ? '' : '&' . http_build_query($query_params));
}

/**
 * function qui permet de verifier les droits d'un utilisateur
 * pour un module.
 * 
 * @param array $rights
 * Le tableau des droits ex : 
 *    array( 
 *        '*' => array( 'nom des pages accesible a tous les utilisateurs' )
 *        'ADMIN' => array( '*' ), 
 *        'USER' => array( 'nom du module1', 'nom du module2'... ) 
 *    )
 *    les pages presente dans le tableau de l'utilisateur joker (*) seront accessible a tous les utilisateurs
 *    si un utilisateur possede le joker (*) dans son tableau il a acces par defaut a tous les modules sauf ceux specifier dans le tableau ex :
 *    'ADMIN' => array( '*', 'module non autoriser' )
 *    sinon tous les modules sont par defaut interdit a l'utilisateur sauf ceux specifie dans son tableau ex :
 *    'USER' => array( 'module autoriser1', 'module autoriser2' )
 *    - cette fonction permet aussi de tester l'existence  d'un type d'utilisateur en laissant a nulle le troisieme parametre
 * @param String $user_type le type d'utilisateur ex : ADMIN 
 * @param Array|String $module le nom du module
 * @return boolean retournera aussi false si l'utilisateur n'existe pas
 */
function check_user_right(Array $rights, $user_type, $module = null) {
  
  $joker = '*';
  $user_type = strtoupper($user_type);

  if ($module === null) {
    return true;
  }

  if (array_key_exists($joker, $rights)) {
    if (isset($rights[$user_type])) {
      if (in_array('*', $rights[$user_type]) === false) {
        foreach ($rights[$joker] as $right) {
          array_push($rights[$user_type], $right);
        }
      }
    } else {
      
      return in_array($module, $rights[$joker]);
    }
  }

  if (array_key_exists($user_type, $rights)) {
    if (in_array('*', $rights[$user_type])) {
      return !in_array($module, $rights[$user_type]);
    } else {
      return in_array($module, $rights[$user_type]);
    }
  }
  return false;
}

/**
 * parcours un dossier et retourne le nom des fichiers ou dossier qu'il contient dans un tableau
 * 
 * @param String $dir
 * @return Array
 */
function read_dir($dir) {
  $dirs = [];
  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
        if ($file === '.' || $file === '..') {
          continue;
        }
        $dirs[] = $file;
      }
      closedir($dh);
    }
  }

  return $dirs;
}

/**
 * retourne le chemin d'une page si elle existe
 * une page est composer de deux elements une vues et un controller seul la vue est obligatoire
 * 
 * @param String $page_name
 * @return String|null
 */
function page_path($page_name) {
  $root = PATH_PAGES;
  
  $all_files_iterator = new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS);

  foreach ($all_files_iterator as $file) {
    $page = $file->getFilename();
    $page_path = $root . $page . '/';

    $views = $page_path . 'views/';
    $view_name = $page_name . '.view.php';

    if (is_dir($views) && in_array($view_name, read_dir($views))) {
      return $page_path;
    }
  }

  return null;
}

/**
 * 
 * 
 *
 */
function get_variable($variable,$params) {
  $table= array();
	$var_commun=Stringy::create($variable);
	$var_commun=$var_commun->toUpperCase();
  $var_commun=$var_commun->replace('_',' ');
  foreach ($params as $key => $value) {
    # code...
  	for($i=0;$i<9;$i++)
  	{
  		if($var_commun->contains($value.$i))
  		{
  			$pos=$var_commun->indexOf($value.$i);
  			$table['var_comm']=$var_commun->slice(0, $pos);
  			$table['temps']=$var_commun->slice($pos);
  		
  		}	
  	}
  }
if($table!=null)
{
return $table;
}else{
  $table['var_comm']=$variable;
  $table['temps']='J0';
  return $table;
}
  
}

function csvstring_to_array($string, $CSV_SEPARATOR = ';', $CSV_ENCLOSURE = '"', $CSV_LINEBREAK = "\r\n") {
    $array1 = array(); //va contenir les lignes
    $array2= array(); //va contenir les champs ("zat" ou zaze ou """azer" ...)
    $arrayfinal= array(); //va contenir nos champs, correctement traités, avec une dimension par ligne.
     
    $array1=preg_split('#'.$CSV_LINEBREAK.'#',$string);//on éclate la chaine par ligne en array (une ligne par ligne)
    for($i=0;$i<count($array1);$i++){//pour chaque ligne de notre chaine
        for($o=0;$o<strlen($array1[$i]);$o++){//pour chaque caractère de la ligne
            if(preg_match('#^'.$CSV_ENCLOSURE.'#',substr($array1[$i],$o))){//si sa commence par un ENCLOSURE
                //on enregistre le mot jusqu'a qu'on trouve un seul ENCLOSURE suivie d'un SEPARATOR (donc qui commence pas par un ENCLOSURE)
                if(!preg_match('#^"(([^'.$CSV_ENCLOSURE.']*('.$CSV_ENCLOSURE.$CSV_ENCLOSURE.')?[^'.$CSV_ENCLOSURE.']*)*)'.$CSV_ENCLOSURE.$CSV_SEPARATOR.'#i',substr($array1[$i],$o,strlen($array1[$i])),$mot)){
                    $mot[1]=substr(substr($array1[$i],$o,strlen($array1[$i])),1,-1);
                }$o+=2;
            }
            else{//sinon ...
                //on prend le mot (ne contenant pas SEPARATOR ou ENCLOSURE) jusqu'au prochain SEPARATOR
                if(!preg_match('#^([^'.$CSV_ENCLOSURE.$CSV_SEPARATOR.']*)'.$CSV_SEPARATOR.'#i',substr($array1[$i],$o,strlen($array1[$i])),$mot)){
                    $mot[1]=substr($array1[$i],$o,strlen($array1[$i]));
                }
            }
        $o=$o+strlen($mot[1]);//on avance dans la ligne jusqu'au prochain mot
        $array2[$i][]=str_replace($CSV_ENCLOSURE.$CSV_ENCLOSURE,$CSV_ENCLOSURE,$mot[1]);//on transforme les double ENCLOSURE par des simple
        }
    }
  return $array2;
}/*
function date_format_converter($date, $format) {
    
    switch ($format)
     {
      case 'JJ/MM/YYYY':
        # code...
        break;
      case 'JJ-MM-YYYY':
        # code...
        break;
      case 'JJMMYYYY':
        # code...
        break;
      case 'JJMONTHYYYY':
        # code...
        break;
      default:
        # code...
        break;
    }
  return $new_date;
}*/


/**
 * calcule la difference en jour depuis deux dates
 * 
 * @param String $d1
 * @param String $d2
 * @return Int
 */
function date_diff_day($d1, $d2) {
  return round(abs(strtotime($d1) - strtotime($d2)) / 86400);
}

/**
 * Retourne la valeur du post si elle existe sinon une chaîne de caractère vide.
 * Cette fonction peut aussi verifier que le 'post' ne soit pas vide.
 * 
 * @param String $post
 * @param boolean $empty
 * @return string|Array
 */
function post_value($post, $empty = true) {
  if (isset($_POST[$post])) {
    if (false === $empty && empty($_POST[$post])) {
      return false;
    }
    if(is_array($_POST[$post])){
      foreach ($_POST[$post] as $k => &$v){
        trim(htmlspecialchars($v));
      }
      return $_POST[$post];
    }
    return  trim(htmlspecialchars($_POST[$post]));
  }
  return '';
}

/**
 * Retourne la valeur du get si elle existe sinon une chaîne de caractère vide.
 * Cette fonction peut aussi verifier que le 'get' ne soit pas vide.
 * 
 * @param String $get
 * @param boolean $empty
 * @return string|Array
 */
function get_value($get, $empty = true) {
  if (isset($_GET[$get])) {
    if (false === $empty && empty($_GET[$get])) {
      return false;
    }
     if(is_array($_GET[$get])){
      foreach ($_GET[$get] as $k => &$v){
        trim(htmlspecialchars($v));
      }
      return $_GET[$get];
    }
    return trim(htmlspecialchars($_GET[$get]));
  }
  return '';
}

/**
 * Genere un mot de passe aléatoire
 * 
 * @param Int $length
 * @return string
 */
function generate_password($length) {
  $mdp = "";
  $numbers_letters = "12346789abcedfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $i = 0;
  while ($i < $length) {
    $caractere = substr($numbers_letters, mt_rand(0, strlen($numbers_letters) - 1), 1);
      $mdp .= $caractere;
      $i++;
  }
  return $mdp;
}

/**
 * Retire tous les caractéres 
 * qui ne sont pas alphanumeric d'une chaine ou d'un tableau
 * 
 * @param Array|String $data
 * @return String
 */
function alphanumeric_only($data) {
  $str = '';
  if (is_array($data)) {
    foreach ($data as $v) {
      $str .= $v;
    }
  } else {
    $str = $data;
  }
  return preg_replace('/[\W_]/', '', $str);
}


/**
 * retourne le trigramme d'un site a partir de son numéro
 * 
 * @param int $num
 * @return String|boolean
 */
function get_projet_name_by_id($id) {

  $id_projet = intval($id);
  
  if ($id_projet) {

  $projet_infos =ORM::for_table('projets')->find_one($id_projet);
      if ($projet_infos){
        return ($projet_infos->nom_projet);
      }

  }

  return false;
}

/**
 * @deprecated
 * NE PAS UTILISER (CODAGE UNIQUEMENT)
 * Si XDebug est désactivé
 * @param type $element
 */
function dump($element, $exit = false) {
  echo '<pre>', print_r($element, 1), '</pre>';
  if ($exit) {
    exit;
  }
}

// in_array Multidimension

function in_array_r($needle, $haystack) {
    $found = false;
    foreach ($haystack as $item) {
    if ($item === $needle) { 
            $found = true; 
            break; 
        } elseif (is_array($item)) {
            $found = in_array_r($needle, $item); 
            if($found) { 
                break; 
            } 
        }    
    }
    return $found;
}


//

function get_liste_des_etudes($id){

  $id_projet = intval($id);
  
  if ($id_projet) {

  $liste_des_etudes =ORM::for_table('etudes')->where('id_projet',$id_projet)->find_array();
      if ($liste_des_etudes){
        return $liste_des_etudes;
      }
  }

  return false;
}