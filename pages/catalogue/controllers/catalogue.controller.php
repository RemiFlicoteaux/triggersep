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
$table_data_count = 0;
$b_extension = false;
$b_noms_colones = false;
$b_fichier_ok = false;
$b_format_fichier = false;
$b_nombre_lignes_vides = 0;
$b_nombre_lignes_ok = 0;
$file_name_destination = '';
$historique_catalogue = ORM::for_table('historique_catalogue')->select('*')->where('id_projet', $b_id_projet)->distinct()->find_array();
/**
 * Lecture du Fichier Excel et enregistrement des données dans la base Mysql
 * Afichage des données dans un tableau
 */

if (isset($_POST['Upload'])) {
	if (strlen($_FILES['file']['name']) > 1) {
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		if (strtoupper($extension) == 'XLSX' or strtoupper($extension) == 'XLS') {
			$b_extension = true;
			$file_name_destination = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME) . '_' . date('Y-m-d H:i:s') . '.' . $extension;
			move_uploaded_file($_FILES['file']['tmp_name'], PATH_DATA . $file_name_destination);
			$inputFileType = PHPExcel_IOFactory::identify(PATH_DATA . $file_name_destination);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load(PATH_DATA . $file_name_destination);
			$objPHPExcel->setActiveSheetIndex('0');
			$objWorksheet = $objPHPExcel->getActiveSheet();
			$highestRow = $objWorksheet->getHighestRow();
			$colone1 = $objWorksheet->getCellByColumnAndRow(0, 1)->getValue();
			$colone2 = $objWorksheet->getCellByColumnAndRow(1, 1)->getValue();
			$colone3 = $objWorksheet->getCellByColumnAndRow(2, 1)->getValue();
			$colone4 = $objWorksheet->getCellByColumnAndRow(3, 1)->getValue();
			$objPHPExcel->disconnectWorksheets();
			unset($objReader, $objPHPExcel);
			if ((strtoupper($colone1) == 'VARIABLE' && strtoupper($colone2) == 'DESCRIPTION') && (strtoupper($colone4) == 'TYPE' && strtoupper($colone3) == 'UNITE')) {
				$b_noms_colones = true;
				$b_fichier_ok = true;
			}
		}

		$b_format_fichier = true;
		$table_data = ORM::for_table('catalogue')->where('id_projet', $b_id_projet)->order_by_asc('nom_variable')->find_array();
		if (empty($table_data)) {
			$infos['message'] = 'Aucun données dans cataloque.';
			$infos['type'] = 'danger';
		}
	}
	else {
		$table_data = ORM::for_table('catalogue')->where('id_projet', $b_id_projet)->order_by_asc('nom_variable')->find_array();
		$infos['message'] = 'Aucun fichier a été sélèctionné!';
		$infos['type'] = 'danger';
	}
}
else {
	$details_projet = ORM::for_table('projets')->where('id', $b_id_projet)->find_one();
	$table_data = ORM::for_table('catalogue')->where('id_projet', $b_id_projet)->order_by_asc('nom_variable')->find_array();
	if (empty($table_data)) {
		$infos['message'] = 'Aucun données dans cataloque.';
		$infos['type'] = 'danger';
	}
}
