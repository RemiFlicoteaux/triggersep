<div class="modal fade" id="verification-fichier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" title="Vérification de Fichier">
    <div class="modal-dialog">
	<div class="modal-content">
            <div id="popin" title="Vérification de Fichier">
                <div id="msg-traitement"> 
                <?php if($b_extension==false): ?>
                    <div class="alert alert-danger" role="alert">L'extension de fichier est incorrecte (l'extension de fichier doit etre xlsx ou xls)</div>
                <?php else: ?>
                    <div class="alert alert-success" role="alert">L'extension du fichier est valide.</div>
                  <?php if($b_noms_colones==false): ?>
                      <div class="alert alert-danger" role="alert">Les noms des colonnes ne sont pas valides.</div>
                  <?php else: ?>
                      <div class="alert alert-success" role="alert">Les noms des colonnes sont valides.</div>
                      <div class="alert alert-info" role="alert"><strong>Important!</strong><br> Cliquez sur le boutton "Insertion et Mise à jour" pour inserer ou mettre à jour les variables de l'étude.</div>
                  <?php endif; ?>
                <?php endif; ?> 
                </div>       
                <div id="message" class="message">
                  <?php display_template_message('alert', '', 'success'); ?>
                </div>
                <div class="text-center" id="insertion-variables-etude-loader">
                    <img src="<?= PATH_IMG ?>loader.gif" alt="" />
                </div>                    
                <input id='file_name' type='text' value='<?=$file_name_destination;?>' hidden>               
                <input id='nom_etude' type='text' value='<?= $_nom_etude; ?>' hidden>  
            </div>
        </div>
    </div>
</div>
