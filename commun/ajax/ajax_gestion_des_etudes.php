<?php

/**
 * PHP @version 5.5.12
 * 
 * @author :AOUEY Yesser
 * @date : 23 sept. 2015
 */
if ((isset($_GET['form_data']) && false === empty($_GET['form_data']) ) || $_GET['operation'] === 'delete') {
    if (isset($_GET['form_data'])) {
        parse_str($_GET['form_data'], $form_data);
    }
    $operation = $_GET['operation'];


    if ($operation === 'insert') {

        $nom_etude = $form_data['nom_etude'];
        $is_existe = ORM::for_table('etudes')->where_equal('nom_etude', $nom_etude)->find_one();
        if (!$is_existe) {
            $description = $form_data['description'];
            $id_projet = $form_data['id_projet'];

            $etude = ORM::for_table('etudes');
            $etude->create();
            $etude->nom_etude = $nom_etude;
            $etude->type = null;
            $etude->description = $description;
            $etude->login = $_SESSION['utilisateur']['login'];
            $etude->id_projet = $id_projet;
            $etude->save();
            $id_etude = ORM::for_table('etudes')->where_equal('nom_etude', $nom_etude)->find_one();
            $date = ORM::for_table('format_date')->create();
            $date->format = 'd/m/YYYY';
            $date->id_etude = $id_etude['id'];
            $etude->save();
            $_SESSION['utilisateur']['liste_des_etudes'] = ORM::for_table('etudes')->where('id_projet', $id_projet)->find_array();
        } else {
            error :
            $b_ajax['error'] = true;
            $b_ajax['message'] = "Une étude portant le même nom a déja été ajoutée.";
        }
    } else if ($operation === 'update' && isset($form_data['id_etude'])) {
        $id = $form_data['id_etude'];
       
        $id_projet = $form_data['id_projet'];
        $description = $form_data['description'];
        $etude = ORM::for_table('etudes')->find_one($id);
        $etude->description = $description;
        $etude->login = $_SESSION['utilisateur']['login'];
        $etude->save();
        $date = ORM::for_table('format_date')->create();
        $date->format = 'd/m/YYYY';
        $date->id_etude = $id;
        $etude->save();
        $_SESSION['utilisateur']['liste_des_etudes'] = ORM::for_table('etudes')->where('id_projet', $id_projet)->find_array();

        $b_ajax['error'] = false;
        $b_ajax['message'] = "Modification enregistré";
    } else if ($operation === 'delete') {

        $id = $_GET['id_etude'];
        $id_projet = $_GET['id_projet'];
        $delete_etude = ORM::for_table('etudes')->find_one($id)->delete();
        $delete_variables = ORM::for_table('variables')->where_equal('id_etude', $id)->delete_many();
        $cn = new MongoClient();
        $db = $cn->selectDB("bd_patients");
        $collection = $db->selectCollection('Patients');
        $collection->remove(array(
            "nom_etude" => $_GET['nom_etude']
        ));
        $_SESSION['utilisateur']['liste_des_etudes'] = ORM::for_table('etudes')->where('id_projet', $id_projet)->find_array();
        
        
        
        
        $b_ajax['error'] = false;
        $b_ajax['message'] = "Etude supprimée";
    }
} else {
    header('Location:./');
    exit(1);
}
