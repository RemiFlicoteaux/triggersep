<div class="modal fade" id="ajout-variable-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
	<div class="modal-content">
            <div class="modal-header" align="center">
                <div id="div-forms">
                        <div class="modal-body">
                            <div id="div-ajout-msg">
                                <div id="icon-ajout-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-ajout-msg">Ajouter un variable.</span>
                            </div>
                            <input id="input_variable" class="form-control" type="text" placeholder="Variable">
                            <input id="input_description" class="form-control" type="text" placeholder="Description">
                            <input id="input_unite" class="form-control" type="text" placeholder="Unité">
                            <input id="input_type" class="form-control" type="text" placeholder="Type">
                            <input id="input_type" class="form-control" type="text" placeholder="Catégorie">
                        </div>
                        <div id="message" class="message">
                            <?php display_template_message('alert', '', 'danger'); ?>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button id="valide" type="button" class="btn btn-primary">Valider</button>
                                <button id="close" type="button" class="btn btn-danger" onclick="">Annuler</button>
                            </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>