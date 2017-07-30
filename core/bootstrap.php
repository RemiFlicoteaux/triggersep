<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 21 avr. 2015
 */


/* Limite de résultats
 * 
 */
define('LIMIT', 100);

/*
 * chargement de la configuration generale
 * - base de donnees
 *   - SIMPA (Oracle)
 *   - Gilda (Oracle)
 *   - MYSQL
 * - serveur d'authentification LDAP    
 */
$b_page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
$b_is_lock_page = ($b_page === 'lock');

/**
 * variables de configuration PHP
 */
ob_start();
ini_set('error_reporting', DEV ? -1 : 0);
ini_set('display_errors', DEV ? 1 : 0);
ini_set('date.timezone', 'Europe/Paris');

LOCAL || $b_is_lock_page ? null : ini_set('session.gc_maxlifetime', TIMEOUT);
LOCAL || $b_is_lock_page ? null : session_set_cookie_params(TIMEOUT);
session_name(APPLICATION_NAME);
session_start();


$b_id_projet = isset($_SESSION['utilisateur']['id_projet']) ? $_SESSION['utilisateur']['id_projet'] : '1';
$b_name_projet = isset($_SESSION['utilisateur']['name_projet']) ? $_SESSION['utilisateur']['name_projet'] : 'REPOSITORY';
$b_liste_des_etudes=isset($_SESSION['utilisateur']['liste_des_etudes']) ? $_SESSION['utilisateur']['liste_des_etudes'] : 'accune etude';

define('ID_PROJET', $b_id_projet);


$b_mysql_config_path = PATH_CONF_GENERAL . "config_repository.php";
$b_mongo_config_path=PATH_CONF_GENERAL . "config_mongo.php";


require_once( $b_mysql_config_path );
require_once( $b_mongo_config_path);

//toutes les variables declarer ici doivent etre prefixe d'un b ex : $b_[ma_variable]

//base de donnees
$b_db_name = $DBName;
$b_db_user_dev = $DBUser;
$b_db_pass_dev = $DBPassword;
$b_db_host_dev = $DBHost;
$b_db_user = DEV ? $b_db_user_dev : $DBUser;
$b_db_pass = DEV ? $b_db_pass_dev : $DBPassword;
$b_db_host = DEV ? $b_db_host_dev : $DBHost;
$b_mysql_connect = [
  'user' => $b_db_user,
  'pass' => $b_db_pass,
  'db' => $b_db_name,
  'host' => $b_db_host
];

// Base de donnees MongoDB

$b_m_db_name = $MDBName;
$b_m_db_user_dev = $MDBUser;
$b_m_db_pass_dev = $MDBPassword;
$b_m_db_host_dev = $MDBHost;
$b_m_col_name = $MCOLName;

//correspondance des profiles utilisateurs
$b_profiles_utilisateurs = [
  'ADMIN' => 'Administrateur',
  'USER' => 'Utilisateur'
];

//utilisateur
$liste_projets='';
$b_is_connected = (isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur']));
$b_session_utilisateur = $b_is_connected ? $_SESSION['utilisateur'] : null;
$b_is_admin = in_array($b_session_utilisateur['profile'], ['ADMIN']);
$b_inscription_page_name = 'inscription';
$b_connexion_page_name = 'connexion';
$b_deconnexion_page_name = 'deconnexion';
$b_acces_interdit_page_name = 'acces-interdit';
$b_acces_interdit_message = 'Vous n\'avez pas les droits nécessaires pour effectuer cette opération.';
$b_ajax_connection_page = 'ajax_connexion_utilisateur';
$b_ip = $_SERVER["REMOTE_ADDR"];

//configuration generale
$b_page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
//$b_site_code = isset($CodeHopital) ? $CodeHopital : null;
$b_ajax = ['error' => false, 'message' => ''];
$b_is_ajax_file = (preg_match('/^ajax_/', $b_page) == 1);
$b_display_html = !$b_is_ajax_file & $b_is_connected;


//Nom des tables
$b_table_catalogue = 'catalogue';
$b_table_etudes = 'etudes';
$b_table_variables = 'variables';
$b_table_mapping = 'mapping';
$b_table_utilisateur = 'utilisateur';
$b_table_options = 'options';
$b_table_log = 'log';
$b_table_projets = 'projets';

//tableau des droits utilisateur
$b_user_rights = [
    '*' => [
        $b_connexion_page_name,
        $b_deconnexion_page_name,
    ],
    'ADMIN' => [
        '*'

    ],
   'USER' => [
        //general
        'synthese',
        'gestion_variables',
        'gestion_des-etudes',
        'appariement',
        'utilisateurs',
        'ajax_changer_projet',
        'catalogue'
    ],
];

$b_user_has_right = check_user_right($b_user_rights, $b_session_utilisateur['profile'], $b_page);
//logs
//
//session time
(LOCAL === false & $b_is_lock_page === false & $b_is_connected) ? setcookie(session_name(), session_id(), time() + TIMEOUT, '/') : null;

