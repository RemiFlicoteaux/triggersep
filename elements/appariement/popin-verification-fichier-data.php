<div class="modal fade" id="verification-fichier-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" title="Vérification de fichier des données">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="popin" title="Vérification de fichier des données">
        <div id="msg-traitement">
          <?php if($b_extension==false): ?>
            <div class="alert alert-danger" role="alert">
              L'extension de fichier est incorrecte (le fichier doit etre un fichier csv)
            </div>
          <?php else: ?>
            <div class="alert alert-success" role="alert">
              Extension OK!
            </div>
            <?php if($table_vars_reconnus > 0): ?>
              <div class="alert alert-success" role="alert">
                Nombre des variables reconnus est : 
                <?=count($table_vars_reconnus);?>
              </div>
            <?php else: ?>
              <div class="alert alert-danger" role="alert">
                Aucun variable reconnu trouvé!
              </div>
            <?php endif; ?>
            <?php if($table_vars_inconnus > 0): ?>
              <div class="alert alert-danger" role="alert">
                Nombre des variables inconnus est : 
                <?=count($table_vars_inconnus);?>
              </div>
            <?php else: ?>
              <div class="alert alert-success" role="alert">
                Aucun variable inconnu trouvé!
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <div class="alert" role="alert">
                Encodage detecté : <?=$encodage;?>
                <br>
                <label>Veuillez confirmer</label>
                <select id='encodage'>
                  <option >UTF-8</option>
                  <option >ISO</option>
                </select>
          </div>
        </div>
        <div id="message_success" class="message">
          <?php display_template_message('alert', '', 'success'); ?>
        </div>
        <div id="message_danger" class="message">
          <?php display_template_message('alert', '', 'danger'); ?>
        </div>
        <input id='file_name' type='text' value='<?=$file_name_destination;?>' hidden>
        <input id='id_projet' type='text' value='<?=$id_projet;?>' hidden>
        <input id='nom_etude' type='text' value='<?=$nom_etude;?>' hidden>
        
      </div>
    </div>
  </div>
</div>