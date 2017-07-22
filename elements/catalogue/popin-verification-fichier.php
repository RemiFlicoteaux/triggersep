<div id="popin" title="Vérification de Fichier">
    <div id="msg-traitement">  
    <?php if($b_extension==false): ?>
        <div class="alert alert-danger" role="alert">L'extension de fichier est incorrecte (l'extension de fichier doit etre xlsx ou xls)</div>
    <?php else: ?>
        <div class="alert alert-success" role="alert">Extension OK!</div>
      <?php if($b_noms_colones==false): ?>
          <div class="alert alert-danger" role="alert">Les noms des colones sont incorrectes</div>
      <?php else: ?>
          <div class="alert alert-success" role="alert">Les nom des colonnes correctes!</div>
          <div class="alert alert-info" role="alert"><strong>Important!</strong><br> Pour supprimer le catalogue existant et inserer le nouveau catalogue : Cliquez sur le boutton "Supprimer et Inserer"<br>Pour mettre a jour le catalogue existant : Cliquez sur le boutton "Mettre a jour" </div>
      <?php endif; ?>
    <?php endif; ?> 
  </div>       
  <div id="message" class="message">
    <?php display_template_message('alert', '', 'success'); ?>
  </div>
  <input id='file_name' type='text' value='<?=$file_name_destination;?>' hidden>               
</div>
