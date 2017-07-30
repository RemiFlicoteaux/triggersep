<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 28 juin 2017
 */
//mise a jour des informations utilisateur
if (isset($_GET['data'])) {

    parse_str($_GET['data'], $form_data);

    $is_existe = ORM::for_table($b_table_projets)->where('nom_projet',$form_data['nom_projet'])->find_one();

    if($is_existe)
    {
      $b_ajax['error'] = true;
      $b_ajax['message'] = 'Nom de projet existe déja!';

    }else{
      $projet_insert = ORM::for_table($b_table_projets);
      $projet_insert->create();
      $projet_insert->nom_projet = $form_data['nom_projet'];
      $projet_insert->description = $form_data['description'];
      $projet_insert->login = $_SESSION['utilisateur']['login'];
      $projet_insert->createur = $_SESSION['utilisateur']['nom'];
      
      if ($projet_insert->save() !== true) {
          goto error;
        } else {

          $projet = ORM::for_table($b_table_projets)->where('nom_projet',$form_data['nom_projet'])->find_one();
          $_SESSION['utilisateur']['id_projet'] = $projet['id'];
          $_SESSION['utilisateur']['name_projet'] = $projet['nom_projet'];
          $_SESSION['utilisateur']['liste_des_etudes']=ORM::for_table('etudes')->where('id_projet',$projet['id'])->find_array();

          //message d'alerte
          if (isset($_COOKIE['display_alert'])) {
            setrawcookie('display_alert', '', -1);
          }
     
          $b_ajax['message'] = 'Insertion réussite et Le changement de projet a bien été pris en compte';
        }

    }
}else {

 error :
    $b_ajax['error'] = true;
    $b_ajax['message'] = 'Une erreur s\'est produite merci de réessayer';
}