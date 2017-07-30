<div class="col-md-8" align="center">
    <div  align="center">
        <form action="" method="post" id="nouvelle-etude" class="form-horizontal" role="form">
            <div align="center">
                <div id="div-ajout-msg">
                    <div class="title">
                      <strong>Informations De l'étude</strong>
                      <hr />
                    </div>
                </div>
                <div class="informations-etude">
                    <div class="form-group">
                        <input id="id_projet" name="id_projet" class="form-control" type="text" value='<?=$id_projet;?>' style="display: none;">
                        <input id="id_etude" name="id_etude" class="form-control" type="text" style="display: none;">
                    </div>
                    <div class="form-group" >
                        <div class="col-md-12"><label class="col-md-3 control-label"><strong>Nom de l'étude</strong></label></div>
                         <div class="col-md-6"><input id="nom_etude" name="nom_etude" class="form-control" type="text" placeholder="Nom de l'étude" ></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><strong>Description</strong></label>
                       <div class="col-md-12"> <textarea id="description" name="description" class="form-control" placeholder="Description" style="min-width:580px;max-width: 580px;"></textarea></div>
                    </div>
                </div>
                <div id="message" class="message">
                    <?php display_template_message('alert', '', 'danger'); ?>
                </div>
                <div class="modal-footer">
                    <div>
                        <button id="valide" type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
               </div>
            </div>
        </form>
    </div>
</div>
