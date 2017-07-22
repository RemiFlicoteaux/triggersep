<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 11 mai 2015
 */

ORM::configure('mysql:host='.$b_db_host.';dbname='.$b_db_name);
ORM::configure('username', $b_db_user);
ORM::configure('password', $b_db_pass);
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
ORM::configure('logging', DEV);
ORM::configure('caching', true);
ORM::configure('caching_auto_clear', true);
ORM::configure('id_column_overrides', array(
    $b_table_utilisateur => 'login',
));



