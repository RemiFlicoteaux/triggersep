<div  id="ajout-etude-modal" role="dialog" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog">
	<div class="modal-content">
            <div class="modal-header" align="center">
                <div id="div-forms">
                     <form action="" method="post" id="nouvelle-etude" class="form-horizontal" role="form">
                        <div class="modal-body">
                            <div id="div-ajout-msg">
                                <div class="title">
                                  <strong>Descriptif de l'étude</strong>
                                  <hr />
                                </div>
                            </div>
                            <div class="informations-etude">
                                <div class="form-group">
                                    <input id="_id_projet" name="id_projet" class="form-control" type="text" value='<?=$id_projet;?>' style="display: none;">
                                    <input id="_id_etude" name="id_etude" class="form-control" type="text" style="display: none;">
                                </div>
                                <div class="form-group" >
                                    <label style="text-align:left" class="col-sm-4 control-label"><strong>Nom de l'étude : </strong></label>
                                    <input id="nom_etude" name="nom_etude" class="form-control" type="text" placeholder="Nom de l'étude" >
                                </div>
                                <div class="form-group">
                                    <label  style="text-align:left" class="col-sm-4 control-label"><strong>Description : </strong></label>
                                    <textarea id="description" name="description" class="form-control" type="text" placeholder="Description" style="max-width: 564px;"></textarea>
                                </div>      
                            </div>
                            <div id="message" class="message">
                                <?php display_template_message('alert', '', 'danger'); ?>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button id="nouvelle-etude-valide" type="button" class="btn btn-success">Valider</button>
                                    <button id="nouvelle-etude-close" type="button" class="btn btn-danger" onclick="">Annuler</button>
                                </div>
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
