<?php

if (isset($_GET) && !empty($_GET)) {

  $primaryKey = 'identifiant';

  $columns = array(
      array('db' => 'l.evenement', 'dt' => 0, 'formatter' => function($d) {
            switch ($d) {
              case "CONNEXION" :
                return "<span class='label label-info'>" . $d . "</span>";
              case "ADMIN" :
                return "<span class='label label-success'>" . $d . "</span>";
              case "RIP" :
                return "<span class='label label-warning'>" . $d . "</span>";
              case "TENTATIVE_CONNEXION" :
                return "<span class='label label-danger'>TENTATIVE DE CONNEXION</span>";
            }
          }
          , 'field' => 'evenement'),
      array('db' => 'u.identifiant', 'dt' => 1, 'field' => 'identifiant'),
      array('db' => 'u.nom', 'dt' => 2, 'field' => 'nom'),
      array('db' => 'u.prenom', 'dt' => 3, 'field' => 'prenom'),
      array('db' => 'l.created', 'dt' => 4, 'formatter' => function( $d, $row ) {
            return date('d/m/Y H:i', strtotime($d));
          }, 'field' => 'created'),
      array('db' => 'l.description', 'dt' => 5, 'field' => 'description')
  );

  $join = "FROM $b_table_utilisateur u JOIN $b_table_log l on (u.identifiant = l.login)";
  $where = "";
  if (isset($_GET['filter']) && !empty($_GET['filter'])) {
    $where = "l.evenement = '$_GET[filter]'";
  }
  $data = SSP::simple($_GET, $b_mysql_connect, $b_table_utilisateur, $primaryKey, $columns, $join, $where);
  $b_ajax = $data;
}

