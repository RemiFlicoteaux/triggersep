<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 21 avril 2015
 */
//headers
header('x-ua-compatible: ie=edge');

/**
 * nom de l'application :
 * 
 * @const APPLICATION_NAME
 */
define('APPLICATION_NAME', 'DB-REPOSITORY');

/**
 * mode developpement :
 * 
 * @const DEV
 */
define('DEV', true);

/**
 * mode online/offline :
 * permet de passer le projet en mode maintenance
 * 
 * @const ONLINE
 */
define('ONLINE', true);

/**
 * acces au projet locale  :
 * 
 * @const LOCAL
 */
define('LOCAL', $_SERVER['REMOTE_ADDR'] === '127.0.0.1');

/**
 * Timeout :
 * 
 * @const TIMEOUT
 */
define('TIMEOUT', 60 * 30);

/**
 * chemin du dossier config_general  :
 * 
 * @const PATH_CONF_GENERAL
 */
define('PATH_CONF_GENERAL', PHP_OS === 'WINNT' ? '../config_general/conf/' : './config_general/conf/');

/**
 * chemin du dossier commun  :
 * 
 * @const PATH_JS
 */
define('PATH_COMMON', './commun/');

/**
 * chemin du dossier include qui contient les classes  :
 * 
 * @const PATH_CLASS
 */
define('PATH_CLASS', PATH_COMMON . 'include/');

/**
 * chemin du dossier helpers  :
 * 
 * @const PATH_HELPERS
 */
define('PATH_HELPERS', PATH_COMMON . 'helpers/');

/**
 * chemin du dossier functions  :
 * 
 * @const PATH_FUNCTION
 */
define('PATH_FUNCTION', PATH_COMMON . 'functions/');

/**
 * chemin du dossier commun  :
 * 
 * @const PATH_AJAX
 */
define('PATH_AJAX', PATH_COMMON . 'ajax/');

/**
 * chemin du dossier javascript  :
 * 
 * @const PATH_JS
 */
define('PATH_JS', PATH_COMMON . 'js/');

/**
 * Chemin du dossier swf  :
 * 
 * @const PATH_SWF
 */
define('PATH_SWF', PATH_COMMON . 'swf/');

/**
 * chemin du dossier images  :
 * 
 * @const PATH_IMG
 */
define('PATH_IMG', PATH_COMMON . 'images/');

/**
 * chemin du dossier css  :
 * 
 * @const PATH_CSS
 */
define('PATH_CSS', PATH_COMMON . 'styles/');

/**
 * chemin du dossier pages (modules)  :
 * 
 * @const PATH_PAGES
 */
define('PATH_PAGES', 'pages/');

/**
 * chemin du dossier elements  :
 * 
 * @const PATH_ELEMENT
 */
define('PATH_ELEMENT', 'elements/');

/**
 * chemin du dossier templates  :
 * 
 * @const PATH_TEMPLATE
 */
define('PATH_TEMPLATE', PATH_COMMON . 'templates/');

/**
 * chemin du dossier layout  :
 * 
 * @const PATH_LAYOUT
 */
define('PATH_LAYOUT', PATH_COMMON . 'layout/');


/**
 * Chemin du dossier data  :
 * 
 * @const PATH_DATA
 */
define('PATH_DATA', 'data/');

/**
 * Taille mot de passe :
 * 
 * @const PASSWORD_LENGTH
 */
define('PASSWORD_LENGTH', 6);

/**
 * Role administrateur :
 * 
 * @const ADMIN_ROLE
 */
define('ADMIN_ROLE', 1);


/**
 * Role utilisateur :
 * 
 * @const USER_ROLE
 */
define('USER_ROLE', 2);

/**
 * Mail par défaut si pas d'admin
 * 
 * @const ADMIN_MAIL_DEFAULT
 */
define('ADMIN_MAIL_DEFAULT', "mail_default@default.com");

/**
 * Format de l'intervalle de recherche par défaut
 * 
 * @const DATE_FORMAT_INTERVAL_DEFAUT
 */
define('DATE_FORMAT_INTERVAL_DEFAUT', "week");

/**
 * Valeur de l'intervalle de recherche par défaut
 *
 * @const  DATE_INTERVAL_DEFAUT
 */
define('DATE_INTERVAL_DEFAUT', "8");


/**
 * Nombre de secondes de blocage d'un utilisateur qui s'est trompé de mot de passe 3 fois
 * 
 * @const FAIL_CONNECT
 */
define('FAIL_CONNECT', 1);

/**
 * Durée de vie d'un cookie
 * 
 * @const LIMIT_COOKIE
 */
define('LIMIT_COOKIE', time() + (10 * 365 * 24 * 60 * 60));

/**
 * Limite de tentative de connexion locale à RIP avant échec
 * 
 * @const LIMIT_TENTATIVE
 * 
 */
define('LIMIT_TENTATIVE', 3);

/**
 * Nombre de jour de validité d'un mot de passe local RIP
 * 
 * @const LIMIT_PASSWORD_VALIDITY
 * 
 */
define('LIMIT_PASSWORD_VALIDITY', 60);

/**
 * Nombre de dernières connexion RIP affichées dans la page information
 * 
 * @const LIMIT_LAST_USERS
 * 
 */
define('LIMIT_LAST_USERS', 5);

/**
 * Nombre de caractères minimal du mot de passe RIP
 * 
 * @const LIMIT_LENGTH_PASSWORD_MIN
 * 
 */
define('LIMIT_LENGTH_PASSWORD_MIN', 4);

/**
 * Nombre de caractères maximal du mot de passe RIP
 * 
 * @const LIMIT_LENGTH_PASSWORD_MAX
 * 
 */
define('LIMIT_LENGTH_PASSWORD_MAX', 6);

/**
 * Nombre de résultats maximums retourné par les requêtes SQL de RIP
 * 
 * @const LIMIT_RESULT_SQL
 * 
 */
define('LIMIT_RESULT_SQL', 100);

/**
 * Lien vers l'aide du projet
 * 
 * @const LINK_HELP
 */
define('LINK_HELP', 'https://docs.google.com/document/d/1puUbbVhxvRVzFQQsBeWcC5CZhDR6MeawFS5FhpLT9Vk/edit');
