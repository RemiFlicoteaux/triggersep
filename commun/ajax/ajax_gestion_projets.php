<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 28 juin 2017
 */
//mise a jour des informations utilisateur
if (isset($_GET['operation'])) {

  if(isset($_GET['form_data'])){
    parse_str($_GET['form_data'], $form_data);}
  $operation=$_GET['operation'];
  
  if ($operation==='update'){

    $projet_update = ORM::for_table('projets')->find_one($form_data['id_projet']);

    if ($projet_update) {

       
        $projet_update->nom_projet = $form_data['nom_projet'];
        $projet_update->description = $form_data['description'];

        if ($projet_update->save() !== true) {
          goto error;
        } else {
          $b_ajax['message'] = 'Mise à jour réussi';
        }

    } else {

      $b_ajax['error'] = true;
      $b_ajax['message'] = 'Une erreur s\'est produite merci de réessayer';
    }

  }elseif ($operation==='insert') {

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
          $b_ajax['message'] = 'Insertion réussite';
        }

    }
  }
}elseif (isset($_GET['delete']) && isset($_GET['id']) && ($id = intval($_GET['id']))) {
  
  $projet = ORM::for_table($b_table_projets)->find_one($_GET['id'])->delete();
  $b_ajax['message'] = 'Le Projet à été supprimé';

}else {

 error :
    $b_ajax['error'] = true;
    $b_ajax['message'] = 'Une erreur s\'est produite merci de réessayer';
}