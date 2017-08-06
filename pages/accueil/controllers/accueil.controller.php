<?php

$project = null;
$all_projects = null;

if (isset($_POST['id_project']) && false === empty($_POST['id_project'])) {
    $_SESSION['utilisateur']['id_projet'] = $_POST['id_project'];
    $_SESSION['utilisateur']['name_projet'] = get_projet_name_by_id($_POST['id_project']);
    $_SESSION['utilisateur']['liste_des_etudes'] = ORM::for_table($b_table_etudes)->where_equal('id_projet', $_POST['id_project'])->find_array();
    header("Refresh:0");
}

if ($b_session_utilisateur['name_projet']) {
    $project = ORM::for_table($b_table_projets)
            ->select('*')
            ->select_expr('DATE_FORMAT(date_creation, "%d/%m/%Y %H:%i:%s") AS date_creation')
            ->where_equal('nom_projet', $b_session_utilisateur['name_projet'])
            ->find_one();
} else {
    $all_projects = ORM::for_table($b_table_projets)->find_many();
}