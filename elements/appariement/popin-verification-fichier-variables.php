<div class="modal fade" id="verification-fichier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" title="Vérification de Fichier">
    <div class="modal-dialog">
	<div class="modal-content">
                <div id="popin" title="Vérification de Fichier">
                    <div id="msg-traitement"> 
                    <?php if($etude==false): ?>
<<<<<<< HEAD
                      <div class="alert alert-danger" role="alert">Veuillez Verifier la premiere colonne (Doit contenir le nom de l'eutde)</div>  
=======
                      <div class="alert alert-danger" role="alert">Veuillez vérifier la première colonne (Doit contenir le nom de l'étude)</div>  
>>>>>>> 27976f6... #fix spell
                     <?php endif;?>
                    <?php if($b_extension==false): ?>
                        <div class="alert alert-danger" role="alert">L'extension de fichier est incorrecte (l'extension de fichier doit etre xlsx ou xls)</div>
                    <?php else: ?>
                        <div class="alert alert-success" role="alert">Extension du fichier est valide.</div>
                      <?php if($b_noms_colones==false): ?>
<<<<<<< HEAD
                          <div class="alert alert-danger" role="alert">Les noms des colones sont incorrectes</div>
                      <?php else: ?>
                          <div class="alert alert-success" role="alert">Les nom des colonnes correctes!</div>
                          <div class="alert alert-info" role="alert"><strong>Important!</strong><br> Cliquez sur le boutton " Insertion et Mis à jour" pour inserer ou mettre a jour les variable de l'etude</div>
=======
                          <div class="alert alert-danger" role="alert">Les noms des colonnes ne sont pas valides.</div>
                      <?php else: ?>
                          <div class="alert alert-success" role="alert">Les noms des colonnes sont valides.</div>
                          <div class="alert alert-info" role="alert"><strong>Important!</strong><br> Cliquez sur le boutton "Insertion et Mise à jour" pour inserer ou mettre à jour les variables de l'étude.</div>
>>>>>>> 27976f6... #fix spell
                      <?php endif; ?>
                    <?php endif; ?> 
                  </div>       
                  <div id="message" class="message">
                    <?php display_template_message('alert', '', 'success'); ?>
                  </div>
                  <input id='file_name' type='text' value='<?=$file_name_destination;?>' hidden>               
                </div>
        </div>
    </div>
</div>
