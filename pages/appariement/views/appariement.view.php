<div id="triggersep">
  <div class='appariement'>  
    <div class="container-fluid">
        <div class="title">
            <h3><?php echo get_projet_name_by_id($b_id_projet) ?> </h3>
            
        </div>
        <div>
         <?php if ($nom_etude): ?>  
        <div class="info">
            <div ><h3> Détails de l'étude <?php echo $nom_etude ?></h3></div>
          
            <ul class="nav">
                <li ><a data-toggle="tab" class="<?=($pg == 1)?'active':'';?>" href="#details-etude">Détails de l’étude</a></li>
                <li class="<?=$class_insertion_variables?'active':'';?>"><a data-toggle="tab" href="#insertion-variables-etude">Variables de l'étude</a></li>
                <li class="<?=($class_insertion_variables || $class_insertion_data || $pg == 1)?'':'active';?>"><a data-toggle="tab" href="#appariemnt-variable">Appariement catalogue / variables études</a></li>
                <li class="<?=$class_insertion_data?'active':'';?>"><a data-toggle="tab" href="#insertion-data-etude">Insertion des données</a></li>
            </ul>
        </div> 
        <br/>
        <div class="panel-body">
          <div class="tab-content">


            <!-- DETAILS ETUDE -->
            <div class="tab-pane fade <?=($pg == 1)?'in active':'';?>" id='details-etude'>
             <!-- MODULE LECTURE DE FICHIER -->
                <?php if (!empty($etude)):
                        element($b_page . '/details-etude', [
                            'b_etude' => $etude,
                            'b_nom_etude' => $nom_etude,
                            'b_historique_data'=>$historique_data,
                            'b_format_fichier'=>$format_fichier_data,
                            'b_variables_etude' =>$variables_etude,
                            'b_id_etude' => $id_etude,
                            'variables_etude' => $variables_etude,
                            'b_format_date' => $format_date['format']
                            ]);
                 endif; ?>
                 <?php /*if (!empty($variables_etude)):
                        element($b_page . '/variables-cles', [
                            'b_format_fichier' => $format_fichier_data,
                            'variables_etude' => $variables_etude,
                            ]);
                 endif; */?>
            </div>

            <!-- MODULE INSERTION DES VARIABLES ETUDE -->
            <div class="<?=$class_insertion_variables?$class_insertion_variables:'tab-pane fade';?>" id='insertion-variables-etude'>
           
             
                <?php if (!empty($etude)):
                        element($b_page . '/information-historique', [
                            'b_etude' => $etude
                            ]);
                 endif; ?>
               <br />
                
            <?php element($b_page . '/gestion-variables-etude', [
                    'b_page' => $b_page,
                    'liste_etudes' => $liste_etudes,
                    'id_projet' => $b_id_projet,
                    'b_nom_etude' => $nom_etude,
                    'variables_etude' => $variables_etude,
                ]); ?>
            </div>
            <!-- MODULE APPARIEMENT VARIABLES -->
            <div class="<?=($class_insertion_variables || $class_insertion_data || $pg == 1)?'tab-pane fade':'tab-pane fade in active';?>" id='appariemnt-variable'>
                
                <!-- MODULE LECTURE DE FICHIER -->
                <?php if(!empty($variables_etude)):
                        if (!empty($etude)):
                             element($b_page . '/information-historique', [
                                'b_etude' => $etude
                            ]);
                        endif;?>
               <br />
               <?php if (!empty($variables_etude)):
                        element($b_page . '/variables-cles', [
                            'b_format_fichier' => $format_fichier_data,
                            'variables_etude' => $variables_etude,
                            ]);
                 endif; ?>
               
                <!-- TABLEAU DE DONNEES -->
              <?php if (count($etude_data_final_tab) > 1):
                        element($b_page . '/table-data', [
                            'table_data' => $etude_data_final_tab,
                            'table_data_count' => $table_data_count,
                            'b_nom_etude' => $nom_etude,
                            'b_id_etude' => $id_etude,
                            'b_format_fichier' => $format_fichier_data,
                            'infos' => $infos,
                            'variables_etude' => $variables_etude,
                            'table_variables' => $table_variables,
                            'id_projet' => $b_id_projet,
                            'b_etude' => $etude
                            ]);
                endif; ?>
                <!-- LISTE DE VARIABLES ETUDE -->
                <?php element($b_page . '/liste-variables-etude', ['table_variables' => $table_variables, ]);
                else: 
                    $infos['message']="Vous devez effectuer l’étape précédente <br> Veuillez inserer les variables de l'etudes"; ?>
                    <div><?php display_template_message('alert', $infos['message'],'danger'); ?></div> 
            <?php endif;?>
            </div>

            <!-- MODULE INSERTION DATA ETUDE -->
            <div class="<?=$class_insertion_data?$class_insertion_data:'tab-pane fade';?>" id='insertion-data-etude'>

             <?php if (!empty($historique_data)):
                        element($b_page . '/historique-insertion-data', [
                            'b_etude' => $etude,
                            'b_historique_data'=>$historique_data
                            ]);
                 endif; ?>
               <br />  

            <?php if($var_id_patient):
            element($b_page . '/insertion-data-etude', [
                    'b_page' => $b_page,
                    'b_nom_etude' => $nom_etude,
                    'id_projet' => $b_id_projet,
                    'b_id_etude' => $id_etude,
                    ]); 
             else: 
                    $infos['message']="Vous devez effectuer l’étape précédente <br> Veuillez selectionnez les variables clés"; ?>
                    <div><?php display_template_message('alert', $infos['message'],'danger'); ?></div> 
            <?php endif;?>
            </div>
            </div>
            
            
            <!-- POPIN_VERIFICATION ET MISE AJOUR VARIABLES ETUDE -->
            <?php if ($b_format_fichier == true): 
                 element($b_page . '/popin-verification-fichier-variables',[
                    'b_extension' => $extension,
                    'b_noms_colones' => $b_noms_colones,
                    'etude' => $etude,
                    'file_name_destination' => $file_name_destination
                    ]); ?>
            <script>
             popin_fichier_variables('popin',<?php echo $b_fichier_ok ? 1 : 0; ?>,<?php echo $format_fichier_data; ?>,<?php echo "'".$_nom_etude."'"; ?>);
            </script>
            <?php endif; ?> 

            <!-- POPIN_VERIFICATION ET MISE AJOUR DATA -->
            <?php  if ($extension_fichier_data): 
                    element($b_page . '/popin-verification-fichier-data', [
                    'b_extension' => $extension_fichier_data,
                    'table_vars_reconnus' => $table_vars_reconnus,
                    'table_vars_inconnus' => $table_vars_inconnus,
                    'encodage' => $encodage,
                    'file_name_destination' => $file_name_destination,
                    'id_projet' => $b_id_projet,
                    'nom_etude' => $nom_etude,
                    'separateur' => $separateur
                    ]); ?>
            <script>
             popin_fichier_data('popin',<?php echo $b_fichier_ok ? 1 : 0; ?>,<?php echo $extension_fichier_data? 1 : 0; ?>);
            </script>
            <?php endif; ?>
          </div>
        </div>
    </div>
    <?php if ($infos['message']) : ?>
    <div class="message">
      <?php display_template_message('alert', $infos['message'],$infos['type']); ?>
    </div> 
    <?php endif;
    endif; ?> 
  </div>   
</div>

