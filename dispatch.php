<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 21 avr. 2015
 */


if ($b_is_connected === false) {
  $b_page = $b_connexion_page_name;
}

//s chemin des pages
$d_page_path = page_path($b_page);
$d_path_controller = $d_page_path . 'controllers/';
$d_path_view = $d_page_path . 'views/';

$d_controller = $d_path_controller. $b_page . '.controller.php';
$d_view = $d_path_view. $b_page . '.view.php';

if ($b_is_connected && $b_user_has_right === false) {
  if ($b_is_ajax_file) {
    ob_clean();
    $b_ajax = ['error' => true, 'message' => $b_acces_interdit_message];
    echo json_encode($b_ajax);
    exit(1);
  }
  $b_page = $b_acces_interdit_page_name;
  //e chemin des pages

}

switch ($b_page) {
  case null:
    require page_path('accueil') . 'views/accueil.view.php';
    break;
  case 'lock':
    ob_clean();
    include PATH_LAYOUT . 'lock.php';
    exit(0);
    break;
  case 'offline':
    include PATH_LAYOUT . 'offline.php';
    break;
  case 'acces-interdit':
    if (is_file($d_view) === false) {
      goto error_page;
    }
    include PATH_LAYOUT . $b_page . '.php';
    break;
  case 'deconnexion':
    $_SESSION = [];
    session_destroy();
    header('Location:./');
    exit(1);
    break;
  case $b_is_ajax_file:
    ob_clean();
    $ajax_path = PATH_AJAX . $b_page . '.php';
    if (is_file($ajax_path) === false) {
      $b_ajax = ['error' => true, 'message' => "La page ($b_page) que vous recherchez n'existe pas."];
    } else {
      include $ajax_path;
    }
    echo json_encode($b_ajax);
    exit(1);
  case $b_page:
    if (is_file($d_view) === false) {
      goto error_page;
    }
    is_file($d_controller) ? require $d_controller : '';
    require $d_view;
    
    break;
  default :
    error_page :
    include PATH_LAYOUT . '404.php';
}

ob_end_flush();

