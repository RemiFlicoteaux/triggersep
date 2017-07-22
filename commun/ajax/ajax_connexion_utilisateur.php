<?php

if (get_value('login', false) && get_value('password_local', false)) {
  extract($_GET, EXTR_PREFIX_ALL, 'form');
  sleep(1);
  if (false === isset($_COOKIE['controle_local' . $form_login])) {
    setcookie('controle_local' . $form_login, serialize([ 'tentative' => 0,
        'time' => '']), LIMIT_COOKIE);
  } else {
    $h_data_controle_local = $_COOKIE['controle_local' . $form_login];
    $h_controle_local_data = unserialize($h_data_controle_local);
  }

  $utilisateur = ORM::for_table($b_table_utilisateur);
  $verif_utilisateur = $utilisateur
      ->where('identifiant', $form_login)
      ->where('mot_de_passe', $form_password_local)
      ->find_one();

  //on vérifie que le mdp est correct
  if ($verif_utilisateur) {

    //si le temps imparti est passé, on lui remet ses cookies à 0 s'il a réussi à se connecter à ldap
    setcookie('controle_local' . $form_login, serialize([ 'tentative' => 0,
        'time' => '']), LIMIT_COOKIE);

    //on vérifie que l'utilisateur est bien actif
    if ($verif_utilisateur->active) {
      $udate_user = $utilisateur->find_one($form_login)
          ->set_expr('nombre_connexion', 'nombre_connexion + 1')
          ->set_expr('derniere_connexion', 'NOW()')
          ->save();
      $_SESSION['utilisateur']['identification'] = 1;
      $_SESSION['utilisateur']['role'] = $verif_utilisateur->role;
      $_SESSION['utilisateur']['latest_password_update'] = $verif_utilisateur->date_mise_a_jour_mdp;
      log_rip($form_login, $b_ip, 'CONNEXION', 'Connexion réussie.');
      //sinon message d'erreur
    } else {
      $b_ajax['message'] = 'Votre compte est désactivé.';
      $b_ajax['type'] = 'info';
      $b_ajax['error'] = true;
    }
  } else {

    //si le mdp est incorrect, on incrémentente le nb de tentative de connexion
    setcookie('controle_local' . $form_login, serialize(['tentative' => ++$h_controle_local_data['tentative'], 'time' => '']), LIMIT_COOKIE);


    //si on arrive à la limite du nb de tentative, on lance le compteur de temps
    $max_tentative = get_option('ADMIN', 'controle_local_limit_tentatives') ? get_option('ADMIN', 'controle_local_limit_tentatives') : LIMIT_TENTATIVE;
    if ($h_controle_local_data['tentative'] == $max_tentative) {
      setcookie('controle_local' . $form_login, serialize(['tentative' => $max_tentative,
          'time' => time()]), LIMIT_COOKIE);
      $b_ajax['fail'] = true;
      log_rip($form_login, $b_ip, 'TENTATIVE_CONNEXION', 'Nombre de tentatives autorisées atteintes : Utilisateur bloqué.');

      //sinon on lui retourne le nb de tentative qu'il lui reste
    } else {
      $tries_left = $max_tentative - $h_controle_local_data['tentative'];
      $tentative = ($tries_left == 1) ? $tries_left . " tentative restante" : $tries_left . " tentatives restantes";
      $b_ajax['message'] = "Mot de passe incorrect. " . $tentative;
      $b_ajax['type'] = 'danger';
      $b_ajax['error'] = true;
      log_rip($form_login, $b_ip, 'TENTATIVE_CONNEXION', ' Mauvais mot de passe local.');
    }
  }
}
