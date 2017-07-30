<?php
/**
 * PHP @version 5.5.12
 *
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 14 Sept 2015
 */
$infos['message'] = '';
$infos['type'] = null;
$table_data = array();
$table = array();
$Patients = array();
$catalogue = array();
$etudes = array();
$nom_etude = null; 
$id_etude = null;
$nbr_variables = null;
$nbr_patients = null;
$liste_etudes = ORM::for_table('etudes')->select('id')->select('nom_etude')->where('id_projet', $b_id_projet)->distinct()->find_array();


  $form_affichage = 'synthese';
  $etudes = ORM::for_table('etudes')->select('id')->select('nom_etude')->where('id_projet', $b_id_projet)->distinct()->find_array();
  $catalogue = ORM::for_table('catalogue')->where('id_projet', $b_id_projet)->find_array();
  for ($k = 0; $k < count($etudes); $k++) {
    $table_data[$etudes[$k]['id']] = ORM::for_table('catalogue')->table_alias('cat')->select_many_expr("  
                cat.nom_variable,
                cat.id as id_var_cat,
                var.id_etude,
                var.variable,
                var.id as id_var_var,
                var.id_var_catalogue")->left_outer_join('variables', ['cat.id', '=', 'var.id_var_catalogue'], 'var')->where('var.id_etude', $etudes[$k]['id'])->find_array();
    $nbr_variables[$k] = ORM::for_table('variables')->select('id_var_catalogue')->where_not_null('id_var_catalogue')->where('id_etude', $etudes[$k]['id'])->count();
    $cn = new MongoClient();
    $db = $cn->selectDB($b_m_db_name);
    $collection = $db->selectCollection($b_m_col_name);
    $docs = $collection->find(array(
      'nom_etude' => $etudes[$k]['nom_etude']
    ))->count();
    $nbr_patients[$k] = $docs;
  }
