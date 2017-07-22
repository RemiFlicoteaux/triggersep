<div id="triggersep">
  <div class="container-fluid">
    <div class="title">
      <h3>Gestion du projet <?php echo $b_name_projet; ?></h3>
    </div>
    <div>
      <div class="info">
            <div ><h3> </h3></div>
          
            <ul class="nav">
                <li ><a data-toggle="tab" href="#details-projet">Détails du projet</a></li>
                <li class="active"><a data-toggle="tab" href="#gestion-catalogue">Gestion des Variables Catalogues</a></li>
            </ul>
        </div> 
        <div class="panel-body">
          <div class="tab-content">
              <div class="tab-pane fade in active" id='gestion-catalogue'>
               <?php
               if(!empty($historique_catalogue)):
                element($b_page . '/information-historique', [
                  'historique_catalogue' => $historique_catalogue
                ]);
              endif;
                ?>
              <br />
              <!-- Messages -->

              <?php if ($infos['message']) : ?>
                    <div class="wrapper">
                        <br>
                        <?php display_template_message('alert', $infos['message'], $infos['type']) ?>
                    </div>
              <?php endif; ?> 
              
              <!-- TABLEAU DE DONNEES -->
              <?php if(!empty($table_data)):
                      element($b_page .'/table-data', [
                     'table_data' => $table_data, 
                     'table_data_count' => $table_data_count, 
                       ]);   
              endif;?>
           
              <!-- MODULE LECTURE DE FICHIER -->
               <?php
                element($b_page . '/file-reader', [
                  'b_page' => $b_page,
                ]);
                ?>
              <!-- POPIN_AJOUT_VARIABLE -->
              <?php element($b_page .'/popin-ajout-variable', [
                    ]); ?>
              <!-- POPIN_VERIFICATION ET MISE AJOUR CATALOGUE -->
              <?php if($b_format_fichier == true): ?>  
              <?php element($b_page .'/popin-verification-fichier', [
                    'b_extension' => $b_extension, 
                    'b_noms_colones' => $b_noms_colones,
                    'file_name_destination' => $file_name_destination 
                      ]); ?>
              <script>
               pop('popin',<?=$b_fichier_ok ? 1 : 0;?>);
              </script>
              <?php endif; ?>
               </div> 
              <div class="tab-pane fade" id='details-projet'>
                  <?php 
                     if(!empty($details_projet)):
                      element($b_page . '/details-projet', [
                        'data_projet' => $details_projet
                      ]);
                      endif;
                ?>
              </div>
          </div>
        </div>
    </div>
	</div>
</div>
