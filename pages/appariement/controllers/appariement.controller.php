<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 14 Sept 2015
 */
extract($_GET, EXTR_PREFIX_ALL, 'get');


$infos['message'] = '';
$infos['type'] = null;
$table_data = [];
$table_variables = [];
$table_data_count = 0;
$etude_data_final_tab = [];
$nom_etude = '';
$id_etude = '';
$etude = [];
$var_id_patient = '';
$table_vars_reconnus = array();
$table_vars_inconnus = array();
$b_extension = false;
$extension_fichier_data = false;
$b_noms_colones = false;
$b_fichier_ok = false;
$b_format_fichier = false;
$file_name_destination = '';
$class_insertion_variables = '';
$class_insertion_data = '';
$indice_date_j0 = '';
$separateur = ';';
$pg = isset($_GET['pg']) ? $_GET['pg'] : '';
$liste_etudes = ORM::for_table('etudes')
        ->select('id')
        ->select('nom_etude')
        ->where('id_projet', $b_id_projet)
        ->distinct()
        ->find_array();
$get_etape = isset($get_etape) && false === empty($get_etape) ? $get_etape : 1;
$allowed_step = [
    1 => true,
    2 => true,
    3 => false,
    4 => false
];
$file_data_was_uploaded = false;
$first_line_tab = [];

/**
 * Lecture du Fichier Excel et enregistrement des données dans la base Mysql
 * Affichage des données dans un tableau
 */
if (isset($_POST['Verifier'])) {
    $id_etude = $_POST['id_etude'];
    $historique_data = ORM::for_table('historique_data')->where('id_etude', $id_etude)->find_one();
    if (strlen($historique_data['fichier']) > 1 && $_POST['etude']) {
        $nom_etude = $_POST['etude'];
        $class_insertion_data = 'tab-pane fade in active';
        $file_path = PATH_DATA . $historique_data['fichier'];
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);

        $etude = ORM::for_table('etudes')->select('id')->select('nom_etude')->select('encodage')->select('format')->where('nom_etude', $_POST['etude'])->where('id_projet', $b_id_projet)->find_one();
        $id_patients = ORM::for_table('variables')->where('id_etude', $etude->id)->where('cle', 'ID_PATIENT')->find_one();
        $date_j0 = ORM::for_table('variables')->where('id_etude', $etude->id)->where('cle', 'J0')->find_one();
        $variables_etude = ORM::for_table('variables')->raw_query('SELECT * FROM variables where id_etude = "' . $etude->id . '"')->find_array();
      
        
        
        switch ($extension) {
            case 'xls':
            case 'xlsx':
                // transformation en fichier csv
                $inputFileType = PHPExcel_IOFactory::identify($file_path);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader -> setReadDataOnly(false);
                $objPHPExcel = $objReader->load($file_path);
                
                $objPHPExcel->setActiveSheetIndex('0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

                $tmp_filename = pathinfo($historique_data['fichier'], PATHINFO_FILENAME) . '.csv';
                $file_path = PATH_DATA . $tmp_filename;
                $objWriter->save($file_path);
                break;
        }

        $extension_fichier_data = true;
        $separateur = !empty($_POST['separateur']) ? $_POST['separateur'] : ';';
        $file_name_destination = pathinfo($historique_data['fichier'], PATHINFO_FILENAME) . '.' . $extension;
        //move_uploaded_file($_FILES['file']['tmp_name'], PATH_DATA . $_FILES['file']['name']);
        $ref = array();
        $row = 0;
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            $line = fgets($handle);
            $delimiter = try_detect_csv_delimiter($line);
            $separateur = $delimiter ? $delimiter : $separateur;
            $variables_etude_to_compare = [];

            foreach ($variables_etude as $variable) {
                $variables_etude_to_compare[$variable['variable']] = $variable['variable'];
            }
            rewind($handle);

            while (($data_line = fgets($handle)) !== FALSE) {
                if (null == $etude['encodage'] || $etude['encodage'] === 'ISO-8859-1') {
                    $data_line = utf8_encode($data_line);
                }
                $data = explode($separateur, $data_line);

                $num = count($data);
                //format 1
                if ($row == 0 || 2 == $etude['format'] || 3 == $etude['format']) {
                    $data = str_replace('"', '', $data);
                    for ($c = 0; $c < $num; $c++) {
                        if (isset($variables_etude_to_compare[$data[$c]])) {
                            $table_vars_reconnus[$data[$c]] = $data[$c];
                        }
                    }
                }

                $row++;
            }

            $table_vars_inconnus = array_diff($variables_etude_to_compare, $table_vars_reconnus);
            $b_fichier_ok = true;

            //$variables_etude


            fclose($handle);
        }
    }
}

if (isset($_GET['nom_etude']) || (isset($_POST['Upload']) || isset($_POST['Envoyer'])) || (isset($_POST['file_variables'])) || (isset($_POST['file_data']))) {
    $nom_etude = isset($_GET['nom_etude']) ? $_GET['nom_etude'] : $_POST['etude'];
    if (strlen($nom_etude) > 1) {
        $etude = ORM::for_table('etudes')
                ->select('*')
                ->select_expr('DATE_FORMAT(date_creation, "%d/%m/%Y %H:%i:%s") AS date_creation')
                ->select_expr('DATE_FORMAT(date_modification, "%d/%m/%Y %H:%i:%s") AS date_modification')
                ->where('nom_etude', $nom_etude)
                ->where('id_projet', $b_id_projet)
                ->find_one();
        $var_id_patient = ORM::for_table('variables')->where('cle', 'ID_PATIENT')->where('nom_etude', $nom_etude)->find_one();
        $id_etude = $etude["id"];
        $historique_data = ORM::for_table('historique_data')->where('id_etude', $id_etude)->find_one();
        $variables_etude = ORM::for_table('variables')->where('id_etude', $id_etude)->find_array();
        $allowed_step[3] = (false === empty($variables_etude));
        $allowed_step[4] = (false === empty($var_id_patient));
        $format_fichier_data = $etude["format"];
        $req_main = ORM::for_table('catalogue')->table_alias('cat')->left_outer_join('variables', "var.id_var_catalogue = cat.id AND var.id_etude='" . $id_etude . "'", 'var');
        $req_main->select_many_expr("cat.id as id_var_cat,
         cat.nom_variable as var_catalogue,
         cat.description,
         cat.unites,            
         var.id,
         var.id_etude,
         var.variable,
         var.temps,
         var.libelle,
         var.type,
         var.id_var_catalogue");
        $data_etude = $req_main->where('id_projet', $b_id_projet)->find_array();
        $table_variables = ORM::for_table($b_table_variables)
                ->raw_query('SELECT * FROM variables WHERE variables.id_etude="' . $id_etude . '" AND variables.id_var_catalogue is NULL ORDER BY variable ASC')
                ->find_array();
        $format_date = ORM::for_table('format_date')->where('id', $id_etude)->find_one();


        $file_path = PATH_DATA . $historique_data['fichier'];
        $extension = pathinfo($historique_data['fichier'], PATHINFO_EXTENSION);
        if ((isset($_POST['Upload']) || isset($_POST['Envoyer'])) || (isset($_POST['file_variables'])) || (isset($_POST['file_data']))) {

            switch ($extension) {
                case 'xls':
                case 'xlsx':
                    // transformation en fichier csv
                    $inputFileType = PHPExcel_IOFactory::identify($file_path);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($file_path);
                    $objPHPExcel->setActiveSheetIndex('0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

                    $tmp_filename = pathinfo($historique_data['fichier'], PATHINFO_FILENAME) . '.csv';
                    $file_path = PATH_DATA . $tmp_filename;
                    $objWriter->save($file_path);
                    break;
            }
        }


        if (in_array($extension, ['xls', 'xlsx'])) {
            $tmp_filename = pathinfo($historique_data['fichier'], PATHINFO_FILENAME) . '.csv';
            $file_path = PATH_DATA . $tmp_filename;
        }
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            $line = str_replace('"', '', fgets($handle));
            $delimiter = try_detect_csv_delimiter($line);
            $separateur = $delimiter ? $delimiter : $separateur;
            $first_line_tab = array_flip(explode($separateur, $line));
        }

        $id = null;
        foreach ($data_etude as $key => $data) {
            if (isset($etude_data_final_tab[$data['id_var_cat']])) {
                $etude_data_final_tab[$data['id_var_cat']]['variable'][$data['id']] = $data['variable'];
                $etude_data_final_tab[$data['id_var_cat']]['temps'][$data['id']] = $data['temps'];
                $etude_data_final_tab[$data['id_var_cat']]['libelle'][$data['id']] = $data['libelle'];
                $etude_data_final_tab[$data['id_var_cat']]['type'][$data['id']] = $data['type'];
            } else {
                $etude_data_final_tab[$data['id_var_cat']] = $data;
                $etude_data_final_tab[$data['id_var_cat']]['variable'] = [$data['id'] => $data['variable']];
                $etude_data_final_tab[$data['id_var_cat']]['temps'] = [$data['id'] => $data['temps']];
                $etude_data_final_tab[$data['id_var_cat']]['libelle'] = [$data['id'] => $data['libelle']];
                $etude_data_final_tab[$data['id_var_cat']]['type'] = [$data['id'] => $data['type']];
            }
        }
    }
}

if (isset($_POST['file_variables']) && $allowed_step[$get_etape]) {
    $_nom_etude = $_POST['etude'];
    $file = $_FILES['file']['name'];
    $class_insertion_variables = 'tab-pane fade in active';
    $format_fichier_data = isset($_POST['format_fichier']) ? $_POST['format_fichier'] : "1";
    if (strlen($_FILES['file']['name']) > 1) {
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (strtoupper($extension) == 'XLSX' or strtoupper($extension) == 'XLS') {
            $b_extension = true;
            $file_name_destination = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME) . '_' . date('Y-m-d H:i:s') . '.' . $extension;
            move_uploaded_file($_FILES['file']['tmp_name'], PATH_DATA . $file_name_destination);
            $inputFileType = PHPExcel_IOFactory::identify(PATH_DATA . $file_name_destination);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader -> setReadDataOnly(false);
            $objPHPExcel = $objReader->load(PATH_DATA . $file_name_destination);
            $objPHPExcel->setActiveSheetIndex('0');
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow();
            $etude = ORM::for_table('etudes')->where_equal('nom_etude', $_nom_etude)->where('id_projet', $b_id_projet)->find_one();


            $colone1 = $objWorksheet->getCellByColumnAndRow(0, 2)->getValue();
            $colone2 = $objWorksheet->getCellByColumnAndRow(1, 2)->getValue();
            $colone3 = $objWorksheet->getCellByColumnAndRow(2, 2)->getValue();
            $colone4 = $objWorksheet->getCellByColumnAndRow(3, 2)->getValue();
            $objPHPExcel->disconnectWorksheets();
            unset($objReader, $objPHPExcel);
            if ((strtoupper($colone1) == 'VARIABLE' && strtoupper($colone2) == 'DESCRIPTION') && (strtoupper($colone4) == 'TYPE' && strtoupper($colone3) == 'UNITE')) {
                $b_noms_colones = true;
                $b_fichier_ok = true;
            }
        }

        $b_format_fichier = true;
    } else {
        $infos['message'] = 'Aucun fichier a été sélèctionné!';
        $infos['type'] = 'danger';
    }
    $variables_etude = ORM::for_table('variables')->where('nom_etude', $_nom_etude)->find_array();
    //header("Location: " . "?p=appariement&nom_etude=$_nom_etude");
}

if (isset($_POST['file_data']) && $allowed_step[$get_etape]) {
    if (strlen($_FILES['file_data']['name']) > 1) {
        $extension = strtolower(pathinfo(PATH_DATA . $_FILES['file_data']['name'], PATHINFO_EXTENSION));
        $allowed_extension = ['csv', 'xls', 'xlsx', 'txt'];
        $file_data_was_uploaded = true;

        if (in_array($extension, $allowed_extension)) {
            $extension_fichier_data = true;
            $nom_etude = isset($_GET['nom_etude']) ? $_GET['nom_etude'] : $nom_etude;
            $etude = ORM::for_table($b_table_etudes)->where('nom_etude', $nom_etude)->where('id_projet', $b_id_projet)->find_one();
            $file = $_FILES['file_data']['name'];
            move_uploaded_file($_FILES['file_data']['tmp_name'], PATH_DATA . $_FILES['file_data']['name']);
            $file_path = PATH_DATA . $file;
            $class_details_etude = 'tab-pane fade in active';
            $format_fichier_data = isset($_POST['format_fichier']) ? $_POST['format_fichier'] : "1";
            $nbr_lignes = 0;
            $nbr_colones = 0;
            $row = 0;
            $etude_variables_from_data_file = [];

            switch ($extension) {
                case 'xls':
                case 'xlsx':
                    // transformation en fichier csv
                    $inputFileType = PHPExcel_IOFactory::identify($file_path);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objReader -> setReadDataOnly(false);
                    $objPHPExcel = $objReader->load($file_path);
                    
                    $objPHPExcel->setActiveSheetIndex('0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
                    $tmp_filename = pathinfo($file, PATHINFO_FILENAME) . '.csv';
                   // $tmp_filename = uniqid() . '.csv';
                    $file_path = PATH_DATA . $tmp_filename;
                    $objWriter->save($file_path);
                    break;
            }

            if (($handle = fopen($file_path, "r")) !== FALSE) {
                $line = fgets($handle);
                $delimiter = try_detect_csv_delimiter($line);
                $separateur = $delimiter ? $delimiter : $separateur;

                rewind($handle);
                while (($data = fgetcsv($handle, 0, $separateur)) !== FALSE) {
                    if (0 === $row) {
                        $etude_variables_from_data_file = $data;
                    }
                    $nbr_colones = count($data);
                    $row++;
                }

                $variables_from_etudes = ORM::for_table($b_table_variables)
                        ->select('variable')
                        ->where('nom_etude', $nom_etude)
                        ->find_array();

                $etude_variables = [];
                $missing_variables = [];
                $available_variables = 0;

                foreach ($variables_from_etudes as $etude_val) {
                    $etude_variables[$etude_val['variable']] = $etude_val['variable'];
                }

                foreach ($etude_variables_from_data_file as $etude_variables_from_data_file_val) {
                    if (false === isset($etude_variables[$etude_variables_from_data_file_val])) {
                        $missing_variables[$etude_variables_from_data_file_val] = $etude_variables_from_data_file_val;
                    } else {
                        $available_variables++;
                    }
                }

                $nbr_lignes = $row;
                fclose($handle);
            }
            $historique_data = ORM::for_table('historique_data')->where('id_etude', $id_etude)->find_one();
            if ($historique_data) {
                $historique_data->fichier = $file;
                $historique_data->nb_colone = $nbr_colones;
                $historique_data->nb_ligne = $nbr_lignes;
                $historique_data->login = $_SESSION['utilisateur']['login'];
                $historique_data->save();
            } else {
                $insert_file_data = ORM::for_table('historique_data')->create();
                $insert_file_data->id_etude = $id_etude;
                $insert_file_data->fichier = $file;
                $insert_file_data->nb_colone = $nbr_colones;
                $insert_file_data->nb_ligne = $nbr_lignes;
                $insert_file_data->login = $_SESSION['utilisateur']['login'];
                $insert_file_data->save();
            }
        } else {
            $infos['message'] = "Type de fichier ($extension) non pris en charge.";
            $infos['type'] = 'danger';
        }

        //header("Location: ./?p=appariement&nom_etude=$nom_etude");
    } else {
        $infos['message'] = "Aucun fichier n'a été sélectionné";
        $infos['type'] = 'danger';
    }
}

if (false === $allowed_step[$get_etape]) {
    header('Location: ./?' . make_query_string(['etape' => 1]));
}
