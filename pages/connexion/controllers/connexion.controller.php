<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 19 mai 2016
 */
$infos['message'] = '';
$infos['type'] = null;

if (isset($_POST['login']) && isset($_POST['password'])) {
    if (empty($_POST['login']) === false && empty($_POST['password']) === false) {
        extract($_POST);

        $utilisateur_infos = null;

        //authentification de l'utilisateur 
        $authentif = ORM::for_table('utilisateur')->where('login', $login)->where('password', md5($password))->find_one();

        if ($authentif) {
            $utilisateur_infos['login'] = $login;
            $utilisateur_infos['id'] = isset($authentif['id']) ? strtoupper($authentif['id']) : '';
            $utilisateur_infos['nom'] = isset($authentif['nom']) ? strtoupper($authentif['nom']) : '';
            $utilisateur_infos['prenom'] = isset($authentif['prenom']) ? ucfirst($authentif['prenom']) : '';
            $utilisateur_infos['email'] = isset($authentif['email']) ? $authentif['email'] : '';
            $utilisateur_infos['profile'] = isset($authentif['profile']) ? $authentif['profile'] : '';
            $projet_par_defaut = isset($authentif['default_projet']) ? $authentif['default_projet'] : '';
            $project_name = null;
            if (1 === preg_match('/^https?:\/\/(([a-z]+)\.).*/', $b_full_requested_url, $match)) {
                $project_name = $match[2];
            }
            $b_db_connexion_name = 'connection';

            $b_table_utilisateur = 'utilisateur';
            $b_table_utilisateur_droits = 'user_droits';
            $b_table_log = 'log';


            /**
             * se connecter même si leur compte est desactivé et on les droits administrateur.
             * 
             */
            $utilisateur = ORM::for_table('utilisateur');
            $get_user = $utilisateur->find_one($login);

            if ($get_user->get('etat') == 0) {
                $infos['message'] = 'Votre compte est désactivé<br>';
                $infos['message'] .= ',<br>veuillez contacter votre responsable pour activer votre compte.';
                $infos['type'] = 'info';
            } else {
                $redirect_page = null;
                $get_user->set_expr('last_access', 'NOW()');
                if ($get_user->save()) {
                    $_SESSION['utilisateur']['id'] = $utilisateur_infos['id'];
                    $_SESSION['utilisateur']['nom'] = $utilisateur_infos['nom'];
                    $_SESSION['utilisateur']['prenom'] = $utilisateur_infos['prenom'];
                    $_SESSION['utilisateur']['login'] = $utilisateur_infos['login'];
                    $_SESSION['utilisateur']['profile'] = $utilisateur_infos['profile'];
                    $_SESSION['utilisateur']['id_projet'] = $projet_par_defaut; //$authentif->get('default_projet');
                    $_SESSION['utilisateur']['name_projet'] = $project_name;
                    $_SESSION['utilisateur']['liste_des_etudes'] = get_liste_des_etudes($projet_par_defaut);

                    $liste_projets = get_list_projets();
                    $b_id_projet = $projet_par_defaut;

                    switch ($get_user->get('default_page')) {
                        case 'appariement' :
                            $redirect_page = 'appariement';
                            break;
                        case 'gestion_variable' :
                            $redirect_page = 'gestion-variable';
                            break;
                        case 'data' :
                            $redirect_page = 'synthese';
                            break;
                    }
                    $redirect_page = 'accueil';
                    //logs
                    Logs::set_user($_SESSION['utilisateur']);
                    Logs::setConnectionName($b_db_connexion_name);
                    Logs::setLog_table_name($b_table_log);
                    Logs::user_log("Connexion depuis l'IP:" . $_SERVER['REMOTE_ADDR']);
                    header('Location:./?p=' . $redirect_page);
                } else {
                    //goto error;
                }
            }
        } else {
            $infos['message'] = 'Identifiants incorrect';
            $infos['type'] = 'danger';
        }
    } else {
        $infos['message'] = 'L\'identifiant et le mot de passe sont obligatoire';
        $infos['type'] = 'danger';
    }
}
mysql_db_not_exist:

//recriture d'url
if (isset($_GET) && empty($_GET) === false) {
    header('Location:./');
}