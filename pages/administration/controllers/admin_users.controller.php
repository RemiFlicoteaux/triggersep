<?php

$message = null;
$identifiant_admin = get_option('ADMIN', 'admin_identifiant');

//role du membre
if (isset($_POST['user']) && false === empty($_POST['user']) && false === isset($_POST['active'])) {
  extract($_POST, EXTR_PREFIX_ALL, 'form');

  foreach ($form_user as $key => $infos) {

    if (isset($infos['role']) || isset($infos['mot_de_passe'])) {
      $user = ORM::for_table($b_table_utilisateur)
          ->find_one($key);
      if ($infos['mot_de_passe'] !== $infos['ancien_mot_de_passe']) {
        $user->set('mot_de_passe', $infos['mot_de_passe']);
        $user->set_expr('date_mise_a_jour_mdp', 'NOW()');
        //log_rip($b_session_utilisateur['identifiant'], $b_ip, 'ADMIN', "Modification du mot de passe du " . $key);

        $message = "Les utilisateurs ont été mis à jour avec succés.";
        $type = "success";
      }
      if (isset($infos['role'])) {
        if ($infos['role'] !== $infos['ancien_role']) {
          if ($infos['role'] == ADMIN_ROLE) {
            $user->set('active', 1);
          }
          $role_nom = $infos['role'] === 2 ? "Utilisateur" : "Administrateur";
          $user->set('role', $infos['role']);
          //log_rip($b_session_utilisateur['identifiant'], $b_ip, 'ADMIN',"Modification du rôle du " . $key);

          $message = "Les utilisateurs ont été mis à jour avec succés.";
          $type = "success";
        }
      }
      $user->save();
      //log_rip($b_session_utilisateur['identifiant'], $b_ip, 'ADMIN', "Modification d'un/de plusieurs rôle(s) utilisateur(s)");
    }
  }
}

//activité du membre
if (post_value('active')) {
  $identifiant = ORM::for_table($b_table_utilisateur)
      ->select('*')
      //ADMIN
      ->where_not_equal('role', ADMIN_ROLE)
      ->where('identifiant', post_value('active'))
      ->find_one();
  if ($identifiant) {
    ORM::for_table($b_table_utilisateur)
        ->find_one($identifiant->identifiant)
        ->set_expr('active', '!active')
        ->save();

    //$new_statut = ORM::for_table($b_table_utilisateur)
  }
}

//récupération des dernières informations
$users = ORM::for_table($b_table_utilisateur)
    ->select('*')
    ->order_by_desc('identifiant');

$data_users = $users->find_array();

//on vérifie que le "super-admin" est encore admin
$super_admin_id = get_option('ADMIN', 'admin_identifiant');

$verif_super_admin_id = ORM::for_table($b_table_utilisateur)
    ->where_equal('identifiant', $super_admin_id)
    ->where_equal('role', ADMIN_ROLE)
    ->find_one();
if (false === $verif_super_admin_id) {
  delete_option('ADMIN', 'admin_identifiant');
  set_option('ADMIN', 'admin_identifiant', 'defaut');
}