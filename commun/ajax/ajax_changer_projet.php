<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 20 mai 2016
 */

if ((isset($_GET['data']) && !empty($_GET['data']) )or (isset($_GET['id_projet']) && !empty($_GET['id_projet'])) ) {
  

  if (isset($_GET['data']))  {
    parse_str($_GET['data'], $data);
    $id_projet = intval($data['projet']);
  }else{
    $id_projet = $_GET['id_projet'];
  }

      $b_name_projet = get_projet_name_by_id($id_projet);

      $_SESSION['utilisateur']['id_projet'] = $id_projet;
      $_SESSION['utilisateur']['name_projet'] = $b_name_projet;
      $_SESSION['utilisateur']['liste_des_etudes']=ORM::for_table('etudes')->where('id_projet',$id_projet)->find_array();

      $b_ajax['error'] = false;
      $b_ajax['message'] = 'Le changement de projet a bien été pris en compte (' . $b_name_projet . ').';

      //message d'alerte
      if (isset($_COOKIE['display_alert'])) {
        setrawcookie('display_alert', '', -1);
        }

}else {
  $b_ajax['error'] = true;
  $b_ajax['message'] = 'Vous n\'avez pas accés a cet projet';
}



