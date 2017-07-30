<?php

if (strlen($_GET['file_name']) > 1 && isset($_GET['nom_etude']) && isset($_GET['id_projet'])) {
    $encodage=isset($_GET['encodage'])?$_GET['encodage']:'UTF-8';
    $separateur=isset($_GET['separateur'])?urldecode($_GET['separateur']):';';
    $etude = ORM::for_table('etudes')->select('id')->select('nom_etude')->select('format')->where('nom_etude', $_GET['nom_etude'])->where('id_projet', $_GET['id_projet'])->find_one();
    $b_id_patients = ORM::for_table('variables')->where('id_etude', $etude->id)->where('cle', 'ID_PATIENT')->find_one();
    $p = ORM::for_table('variables')->raw_query('SELECT * FROM variables where id_etude="' . $etude->id . '"')->find_array();
    $cn = new MongoClient();
    $db = $cn->selectDB("bd_patients");
    $collection = $db->selectCollection('Patients');
    $collection->remove(array(
          "nom_etude" => $etude['nom_etude']
        ) );
    foreach($p as $val) {
      $parametre[$val['variable']]['type'] = $val['type'];
      $parametre[$val['variable']]['temps'] = $val['temps'];
      $parametre['__cle'] = array();
      if ($val['cle'] == 'CLE') $parametre['__cle'][] = $val['variable'];
      if ($val['cle'] == 'ID_PATIENT') $parametre['__id'] = $val['variable'];
      if ($val['cle'] == 'VAR') $parametre['__var'] = $val['variable'];
      if ($val['cle'] == 'VAL') $parametre['__val'] = $val['variable'];
      if ($val['cle'] == 'J0') $parametre['__j0'] = $val['variable'];
      if ($val['cle'] == 'IR') $parametre['__ir'] = $val['variable'];
    }
    //dump($parametre,true);
    if (!array_key_exists('__cle', $parametre)) $parametre['__cle'] = 'date_j';
    $var = ORM::for_table('variables')->raw_query('SELECT variable FROM variables where cle="VAR" AND id_etude="' . $etude->id . '"')->find_one();
    $val = ORM::for_table('variables')->raw_query('SELECT variable FROM variables where cle="VAL" AND id_etude="' . $etude->id . '"')->find_one();
    $date_j0 = ORM::for_table('variables')->raw_query('SELECT variable FROM variables where cle="J0" AND id_etude="' . $etude->id . '"')->find_one();
    $format_date = ORM::for_table('format_date')->select('format')->find_one($etude->id);

    if($etude['format'] == '3' and ($var == '' or $val == ''))
    {
      $parametre['__var'] = 'variable';
      $parametre['__val'] = 'valeur';

    }$k=0;
    $ref = array();
    $table= array();
    $row = 0;
    $nbr_lignes_inserees = 0;
    $nbr_lignes_rejetees = 0;
    if (($handle = fopen(PATH_DATA . $_GET['file_name'], "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 0, $separateur)) !== FALSE) {
        $num = count($data);

        if ($row == 0) {
          for ($c = 0; $c < $num; $c++) {
            $colum[$data[$c]] = $c;
          }
        }
        else {
          
          if($num === count($colum)){
            foreach($colum as $nomcol => $c) {
              
              if (isset($parametre['__j0'])) 
              $date = DateTime::createFromFormat(isset($format_date->format)?$format_date->format:'d/m/Y', $data[$colum[$parametre['__j0']]]);
              $id_pat = $data[$colum[$parametre['__id']]];
              $indicateur = isset($parametre['__ir'])?$data[$colum[$parametre['__ir']]]:null;
              $ref = $etude->nom_etude . '_' . $id_pat;
              $table[$ref]['_id'] = $ref;
              $table[$ref]['nom_etude'] = $etude->nom_etude;
              $value = array();
              $tab = array();
              switch ($nomcol) {
              	//Format 3
              case 'variable':
                $tab['valeur'] = $data[$colum[$parametre['__val']]];
                //$tab['temps'] = $parametre[$parametre['__var']]['temps'];
                   if($indicateur){
                   		if(strlen($indicateur)>=4){
                   			
                   			$date_ind= DateTime::createFromFormat(isset($format_date->format)?$format_date->format:'d/m/Y', $indicateur);
                   			$date_j = $date_ind->format('Y-m-d');
		                	$tab['date'] = $date_j;
	               		}
	              	}
	              	$table[$ref][$data[$colum[$parametre['__var']]]][] = $tab;
              case isset($parametre['__val']):
                break;

              case $parametre['__id']:
                $table[$ref][$nomcol] = $data[$c];
                break;
              case $parametre['__j0']:
                $table[$ref][$nomcol] = $data[$c];
                break;
              case in_array($nomcol,$parametre['__cle']):
                $table[$ref][$nomcol][0]['valeur'] = $data[$c];
                break;
                //format 1 et 2
              default:
              	if($encodage == 'UTF-8')
              	$tab['valeur'] =$data[$c];
              	else
                $tab['valeur'] = utf8_encode($data[$c]);

                if ((!empty($parametre[$nomcol]['temps']) && $date) || ($indicateur && $date)) {
                  
                   if($indicateur){
                   		if(strlen($indicateur) >= 4){
                   			
                   			$date_ind= DateTime::createFromFormat(isset($format_date->format)?$format_date->format:'d/m/Y', $indicateur);
                   			$date_j0 = $date->format('Y-m-d');
                   			$date_j = $date_ind->format('Y-m-d');
                   			$debut = new DateTime($date_j0); 
							$fin = new DateTime($date_j);
                   			$interval = $debut->diff($fin);
                   			$tab['temps'] ='J'. $interval->format('%d');
		                	$tab['date'] = $date_j;
	               		}else{
	                   		$j = '+' . trim($indicateur, 'J') . ' day';
	                   		$tab['temps'] = $indicateur;
	              			$date->modify($j);
			                $date_j = $date->format('Y-m-d');
			                $tab['date'] = $date_j;
			            }
	              	}elseif (!empty($parametre[$nomcol]['temps'])) {

               			$j = '+' . trim($parametre[$nomcol]['temps'], 'J') . ' day';
                   		$tab['temps'] = $parametre[$nomcol]['temps'];
              			$date -> modify($j);
		                $date_j = $date -> format('Y-m-d');
		                $tab['date'] = $date_j;
               		}
                }
                $table[$ref][$nomcol][] = $tab;
                break;
              }
            }
            $nbr_lignes_inserees++;
          }else{
            $nbr_lignes_rejetees++;
          }
        }
        $row++;
      }

      fclose($handle);
    }
    $cn = new MongoClient();
    $db = $cn -> selectDB("bd_patients");
    $collection = $db->selectCollection('Patients');
    foreach($table as $key) {
      $doc_existe = $collection->findOne(array(
        '_id' => $key['_id']
      ));
      //dump($key);
      if ($doc_existe) {
        $collection -> update(array(
          "_id" => $key['_id']
        ) , $key);
      }
      else {
        $collection->insert($key);
      }
    }
  $b_ajax['results'] = array('nbr_lignes_inserees' => $nbr_lignes_inserees,'nbr_lignes_rejetees' => $nbr_lignes_rejetees);
}else{

    $b_ajax['message'] = "Erreur d'insertion :";
    $b_ajax['error'] = true;
}
