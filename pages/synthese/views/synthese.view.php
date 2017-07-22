<div id="triggersep">
  <div class="container-fluid">
    <div class="title">
      <h3><?=get_projet_name_by_id($b_id_projet)?></h3>
      <h4>Synthèse des études disponibles</h4>
    </div>

    <div class="row">
         <?php if ($form_affichage === 'synthese'): ?>
        <!-- TABLEAU DE DONNEES -->
        
         
        
         <?php element($b_page .'/table-data', [
            'catalogue' => $catalogue, 
            'table_data' => $table_data, 
            'b_nom_etude' => $nom_etude,
            'etudes' => $etudes,
            'infos'=>$infos,
            'nbr_variables'=>$nbr_variables,
            'nbr_patients'=>$nbr_patients,
              ]); ?>

        <?php else: ?>         
        
         <?php element($b_page .'/etude-view', [
            'catalogue' => $catalogue, 
            'table_data' => $table_data, 
            'b_nom_etude' => $nom_etude,
            'etudes' => $etudes,
            'infos'=>$infos,
            'nbr_variables'=>$nbr_variables,
            'nbr_patients'=>$nbr_patients,
              ]); ?>


        <?php endif; ?>
	 </div>
  </div>
</div>
