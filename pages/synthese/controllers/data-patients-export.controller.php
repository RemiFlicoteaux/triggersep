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
    
           $req_main = ORM::for_table('')
                ->raw_query("SELECT cat.id,var.temps,CONCAT( cat.nom_variable, var.temps) as var_ref
                            FROM catalogue cat, `variables` var
                            WHERE id_var_catalogue = cat.id and id_etude='".$etudes[$i]['id']."' and id_projet='$b_id_projet'
                            GROUP BY cat.id,var_ref");
           $var_rows=$req_main->find_array(); 
    // ouvrir le fichier et ecrire la ligne titre

    ob_clean();
     $csv_rows_raw[0]='Patients';
     $csv_rows_raw[1]='Nom_etude';       
     
      
       
    
      
    for($i=0;$i<count($etudes);$i++){
        
        $Ref=[];
      for ($j=0;$j<count($var_rows);$j++)$Ref[$var_rows[$j]['var_ref']]='';  
        //recuperer les variables de l'etude i
              $req_main = ORM::for_table('')
                ->raw_query(" SELECT variable, concat( cat.nom_variable, var.temps ) AS ref
                                FROM variables var, catalogue cat
                                WHERE id_var_catalogue = cat.id and id_etude='".$etudes[$i]['id']."' and id_projet='". $b_id_projet."'");
           $var_et=$req_main->find_array(); 
            for ($j=0;$j<count($var_et);$j++)$Ref[$var_et[$j]['ref']]=$var_et[$j]['variable'];  
      
        $j=2;
        foreach ($Ref as $key => $var)
        {
            $csv_rows_raw[$j] =$var;
            $j++;
            $csv_rows_raw[$j] ='Date';
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
             array_push($tab_data_export,$vars['_id']); 
             array_push($tab_data_export,$etudes[$i]['nom_etude']);

              foreach($Ref as $key => $var){
                 if(isset($vars[$var])):
                          if(isset($vars[$var][0]['valeur'])):
                            array_push($tab_data_export,$vars[$var][0]['valeur']);
                            if(isset($vars[$var][0]['date'])):
                              array_push($tab_data_export,$vars[$var][0]['date']);
                            else:
                              array_push($tab_data_export,'');
                            endif;
                          else:
                            array_push($tab_data_export,$vars[$var]);
                            array_push($tab_data_export,'');
                          endif;
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

          