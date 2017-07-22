<?php

if(isset($_GET['file_name'])){

	$nom_fichier = $_GET['file_name'];
	$boutton = $_GET['boutton'];	
	$nombre_lignes_ok = 0;
	$nombre_lignes_vides = 0;

	$inputFileType = PHPExcel_IOFactory::identify(PATH_DATA.$nom_fichier);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load(PATH_DATA.$nom_fichier);
	$objPHPExcel->setActiveSheetIndex('0');
	$objWorksheet=$objPHPExcel->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow(); 
	$colone1=$objWorksheet->getCellByColumnAndRow(0, 1)->getValue();
	$colone2=$objWorksheet->getCellByColumnAndRow(1, 1)->getValue();
	$colone3=$objWorksheet->getCellByColumnAndRow(2, 1)->getValue();
	$colone4=$objWorksheet->getCellByColumnAndRow(3, 1)->getValue();


	if($boutton == 'delete'){				

		$catalogue = ORM::for_table('catalogue')->select('id')->where('id_projet',$b_id_projet)->find_array();
		foreach ($catalogue as $key) {
			$id=$key['id'];
			$update_variable=ORM::for_table('variables')->raw_query("UPDATE variables SET id_var_catalogue = NULL where id_var_catalogue=$id");
		}
		$delete_catalogue= ORM::for_table('catalogue')->where('id_projet',$b_id_projet)->delete_many();

		for ($row = 2; $row <= $highestRow; $row++) {
			$variable=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
			$description=$objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
			$unite=$objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
			$type=$objWorksheet->getCellByColumnAndRow(3, $row)->getValue();

			if($variable){
				$var = ORM::for_table('catalogue')
				->where_equal('nom_variable',$variable)
				->where_equal('id_projet',$b_id_projet)
				->find_one();
				if($var == true){
					$var->id_projet=$b_id_projet;
					$var->description=$description;
					$var->unites=$unite;
					$var->type=$type;
					$var->save();
				}else{	
					$var = ORM::for_table('catalogue');
					$var->create();
					$var->nom_variable=$variable;
					$var->id_projet=$b_id_projet;
					$var->description=$description;
					$var->unites=$unite;
					$var->type=$type;
					$var->save();
				}	 
				$nombre_lignes_ok++;
			}else{

				$nombre_lignes_vides++;
			}			
		}

		$historique_catalogue = ORM::for_table('historique_catalogue')->where_equal('id_projet',$b_id_projet)->find_one();

		if($historique_catalogue){
			$historique_catalogue->nom_fichier=$nom_fichier;
			$historique_catalogue->login=$_SESSION['utilisateur']['login'];
			$historique_catalogue->save();
		}else{
			$historique_catalogue = ORM::for_table('historique_catalogue');
			$historique_catalogue->create();
			$historique_catalogue->id_projet=$b_id_projet;
			$historique_catalogue->nom_fichier=$nom_fichier;
			$historique_catalogue->login=$_SESSION['utilisateur']['login'];
			$historique_catalogue->save();
		}

		$b_ajax['message'] = "Le nouveau catalogue est enregistré." ;
		$b_ajax['message'] .= " Nombre des lignes inserées :".$nombre_lignes_ok;
		$b_ajax['message'] .= " Nombre des lignes vide :".$nombre_lignes_vides;
		$b_ajax['error'] = false;

	}elseif($boutton == 'update'){

		for ($row = 2; $row <= $highestRow; $row++) {

			$variable=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
			$description=$objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
			$unite=$objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
			$type=$objWorksheet->getCellByColumnAndRow(3, $row)->getValue();

			if($variable or $description){

				$var = ORM::for_table('catalogue')
				->where_equal('nom_variable',$variable)
				->where_equal('id_projet',$b_id_projet)
				->find_one();

				if($var == true){
					$var->id_projet=$b_id_projet;
					$var->description=$description;
					$var->unites=$unite;
					$var->type=$type;
					$var->save();

				}else{	
					$var = ORM::for_table('catalogue');
					$var->create();
					$var->nom_variable=$variable;
					$var->id_projet=$b_id_projet;
					$var->description=$description;
					$var->unites=$unite;
					$var->type=$type;
					$var->save();
				}
                            $nombre_lignes_ok++;
                        }else{
                            
                           $nombre_lignes_vides++;
                           
                        }	
		}
		$historique_catalogue = ORM::for_table('historique_catalogue')->where_equal('id_projet',$b_id_projet)->find_one();
		if($historique_catalogue){
			$historique_catalogue->nom_fichier=$nom_fichier;
			$historique_catalogue->login=$_SESSION['utilisateur']['login'];
			$historique_catalogue->save();
		}else{
			$historique_catalogue = ORM::for_table('historique_catalogue');
			$historique_catalogue->create();
			$historique_catalogue->id_projet=$b_id_projet;
			$historique_catalogue->nom_fichier=$nom_fichier;
			$historique_catalogue->login=$_SESSION['utilisateur']['login'];
			$historique_catalogue->save();
		}
		$b_ajax['message'] = "Le catalogue est mis a jour." ;
		$b_ajax['message'] .= " Nombre des lignes inserées ou mis à jours :".$nombre_lignes_ok;
		$b_ajax['message'] .= " Nombre des lignes vide :".$nombre_lignes_vides;
		$b_ajax['error'] = false;	

	}
	            
	$table_data = ORM::for_table('catalogue')->where('id_projet',$b_id_projet)->order_by_asc('nom_variable')->find_array();

	$b_ajax['results']=$table_data;
}else{
	$b_ajax['message'] = "Erreur d'insertion :";
	$b_ajax['error'] = true;
}