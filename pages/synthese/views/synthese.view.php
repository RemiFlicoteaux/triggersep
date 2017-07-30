<div id="triggersep">
  <div class="container-fluid">
    <div class="title">
      <h3><?=get_projet_name_by_id($b_id_projet)?></h3>
      <h4>Synthèse des études disponibles</h4>
    </div>

    <div class="row">
         <?php element($b_page .'/table-data', [
            'catalogue' => $catalogue, 
            'table_data' => $table_data, 
            'b_nom_etude' => $nom_etude,
            'etudes' => $etudes,
            'infos'=>$infos,
            'nbr_variables'=>$nbr_variables,
            'nbr_patients'=>$nbr_patients,
              ]); ?>
	 </div>
  </div>
</div>
