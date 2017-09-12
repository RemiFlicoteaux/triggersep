 <?php

/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 17 Fevrier 2016
 */
if (isset($_GET['nom_etude']) && !empty($_GET['nom_etude'])) {


  $nom_etude = $_GET['nom_etude'];
  $id_etude=$_GET['id_etude'];
  $format_export=$_GET['format_export'];

   //recuperation les données des patients dans mongoDB 
  if($nom_etude=='Tous')
  { 
    $catalogue=ORM::for_table('catalogue')->where('id_projet', $b_id_projet)->find_array();
    $etudes=ORM::for_table('etudes')->where('id_projet', $b_id_projet)->find_array();
    

  }else{

    $catalogue=ORM::for_table('catalogue')->where('id_projet', $b_id_projet)->find_array();
    $etudes=ORM::for_table('etudes')->where('id',$id_etude)->find_array();

  }
 
if($format_export==='Export_ligne')
{
    
    
    ob_clean();

    $csv_rows_raw = [
      "Nom_etude",
      "Id_Patient",
      "Variable_catalogue",
      "Variable_etude",
      "Temps",
      "Date",
      "Valeur",
      "Unite"
    ];
    $csv_rows = array_map('utf8_decode', $csv_rows_raw);
    $csv_name = 'export-données-patients';
    $csv_name .=  date('d-m-Y') . '.csv';
    $exporter = new ExportDataCSV('browser', $csv_name);
    $exporter->initialize();
    $exporter->addRow($csv_rows);

    for($i=0;$i<count($etudes);$i++){

     $cn=new MongoClient();
     $db=$cn->selectDB("bd_patients");
     $collection=$db->selectCollection('Patients');
     $data = $collection->find(array('nom_etude' => $etudes[$i]['nom_etude']));

     $req_main = ORM::for_table('catalogue')
                 ->table_alias('cat')
                 ->left_outer_join('variables',"var.id_var_catalogue = cat.id AND var.id_etude='".$etudes[$i]['id']."'", 'var');
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
                  $var_etude=$req_main->find_array(); 
   $tab_data_export = [];
   if(!empty($data)):
      foreach ($data as $vars)
      {
          
          foreach($vars as $key => $var){

             foreach($var_etude as $variable){

               if($variable['variable']==$key):  
                    for($j=0;$j<count($var);$j++) {              
                      array_push($tab_data_export,$etudes[$i]['nom_etude']);
                      array_push($tab_data_export,$vars['_id']);
                      array_push($tab_data_export,$variable['var_catalogue']);
                      array_push($tab_data_export,$variable['variable']);
                      if(isset($vars[$key][$j]['temps'])):
                        array_push($tab_data_export,$vars[$key][$j]['temps']);
                      else:
                        array_push($tab_data_export,$variable['temps']);
                      endif;
                      if(isset($vars[$key])):
                        if(isset($vars[$key][$j]['date'])):
                           array_push($tab_data_export,$vars[$key][$j]['date']);
                        else:
                          array_push($tab_data_export,'');
                        endif;
                         array_push($tab_data_export,isset($vars[$key][$j]['valeur'])?$vars[$key][$j]['valeur']:$vars[$key]);
                     
                        if(isset($vars[$key][$j]['unite'])):

                          array_push($tab_data_export,$vars[$key][$j]['unite']);
                        else:
                          array_push($tab_data_export,'');
                        endif;
                      endif;
                      
                     if (!empty($tab_data_export)):

                        //$tab_data_export_decode = array_map('utf8_decode', $tab_data_export);
                        $exporter->addRow($tab_data_export);
                    endif;
                    $tab_data_export = [];
                  } 
              endif; 
            }

          }
       
      }
      endif;
                  
    }   
 $exporter->finalize();
               exit(0);
}else
  {
    $TabNomEtudes='';
    for($i=0;$i<count($etudes);$i++){
        $TabNomEtudes.=$etudes[$i]['id'].',';
        
    }
    
      $Ref=[];
      $req_main = ORM::for_table('')
                ->raw_query(" SELECT variable, concat( cat.nom_variable, var.temps ) AS ref, nom_etude
                                FROM variables var, catalogue cat
                                WHERE var.id_var_catalogue = cat.id and var.id_etude in (".substr($TabNomEtudes,0,-1).") and cat.id_projet='". $b_id_projet."'");
      $var_et=$req_main->find_array(); 
      //dump($var_et,true);
      for ($j=0;$j<count($var_et);$j++){
          $Ref[$var_et[$j]['ref']][$var_et[$j]['nom_etude']]=$var_et[$j]['variable']; 
          }
    ob_clean();
    $csv_rows_raw[1]='Nom_etude'; 
           
    for($i=0;$i<count($etudes);$i++){
   
        $j=2;
        foreach ($Ref as $key => $var)
        {
            $csv_rows_raw[$j] =$key;
            $j++;

        }
        $csv_rows = array_map('utf8_decode', $csv_rows_raw);
        $csv_name = 'export-données-patients';
        $csv_name .=  date('d-m-Y') . '.csv';
        $exporter = new ExportDataCSV('browser', $csv_name);
        $exporter->initialize();
        $exporter->addRow($csv_rows);
       
        //recuperation les données des patients dans mongoDB 
        
       $cn=new MongoClient();
        $db=$cn->selectDB("bd_patients");
        $collection=$db->selectCollection('Patients');
        $data= $collection->find(array('nom_etude' =>$etudes[$i]['nom_etude']));
         
        //export les données des patients dans mongoDB 
        $tab_data_export = [];
         if(!empty($data)):  
          foreach ($data as $vars)
            {     
             array_push($tab_data_export,$etudes[$i]['nom_etude']);

              foreach($Ref as $key => $var){
                 if(isset($var[$etudes[$i]['nom_etude']])):
                    $variable_etude=$var[$etudes[$i]['nom_etude']];
                    if(isset($vars[$variable_etude])):
                             if(isset($vars[$variable_etude][0]['valeur'])):
                               array_push($tab_data_export,$vars[$variable_etude][0]['valeur']);
                             else:
                               array_push($tab_data_export,$vars[$variable_etude]);

                             endif;
                   else:
                       array_push($tab_data_export,'');
                   endif;
                else:
                       array_push($tab_data_export,'');
                endif;
                
               }
               if (!empty($tab_data_export)):

                      //$tab_data_export_decode = array_map('utf8_decode', $tab_data_export);
                      $exporter->addRow($tab_data_export);
                          
                  endif;
                  $tab_data_export = [];
            }
        endif;
    } 
    $exporter->finalize();
               exit(0); 
}

}else {
  header('Location:./?p=data');
}

          