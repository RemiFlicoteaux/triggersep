<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 13 mai 2015
 */
if (isset($_POST) && !empty($_POST)) {

  $primaryKey = 'login';

  $columns = array(
    array('db' => 'u.login', 'dt' => 0, 'field' => 'login'),
    array('db' => 'u.nom', 'dt' => 1, 'field' => 'nom'),
    array('db' => 'u.prenom', 'dt' => 2, 'field' => 'prenom'),
    array('db' => 'l.modified', 'dt' => 3, 'formatter' => function( $d, $row ) {
        return date('d/m/Y H:i', strtotime($d));
      }, 'field' => 'modified'),
    array('db' => 'l.tache', 'dt' => 4, 'field' => 'tache')
  );

  $join = "FROM $b_table_utilisateur u JOIN $b_table_log l on (u.login = l.user_login)";
  $data = SSP::simple($_POST, $b_mysql_connect, $b_table_utilisateur, $primaryKey, $columns, $join);

  $b_ajax = $data;
}