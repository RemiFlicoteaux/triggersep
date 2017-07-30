<div  id="ajout-projet-modal" role="dialog" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog">
	<div class="modal-content">
            <div class="modal-header" align="center">
                <div id="div-forms">
                     <form action="" method="post" id="nouveau-projet" class="form-horizontal" role="form">
                        <div class="modal-body">
                            <div id="div-ajout-msg">
                                <div class="title">
                                  <strong>Informations Du Projet</strong>
                                  <hr />
                                </div>
                            </div>
                            <div class="informations-etude">
                                <div class="form-group">
                                    <input id="id_projet" name="id_projet" class="form-control" type="text" value="<?=isset($id_projet)?$id_projet:'';?>" style="display: none;">
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label"><strong>Nom du Projet: </strong></label>
                                    <input id="nom_projet" name="nom_projet" class="form-control" type="text" placeholder="Nom du Projet" >
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><strong>Description: </strong></label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Description" style="max-width: 564px;"></textarea>
                                </div>      
                            </div>
                            <div id="message" class="message">
                                <?php display_template_message('alert', '', 'danger'); ?>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button id="valide" type="button" class="btn btn-primary">Validé</button>
                                    <button id="close" type="button" class="btn btn-danger" onclick="">Annuler</button>
                                </div>
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
