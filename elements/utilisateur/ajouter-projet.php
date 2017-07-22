<div  id="ajouter-projet" class="wrapper">
    <div class="form">
         <form class="form">
            <div class="modal-body">
                <div class="informations-etude">
                    <div class="form-group" >
                        <label class="col-sm-4 control-label"><strong>Nom du Projet : </strong></label>
                        <input id="nom_projet" name="nom_projet" class="form-control" type="text" placeholder="Nom du Projet" >
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><strong>Déscription : </strong></label>
                        <textarea id="description" name="description" class="form-control" type="text" placeholder="Description" style="max-width: 564px;"></textarea>
                    </div>      
                </div>
            </div>
        </form>
    </div>
    <div id="message" class="message">
        <?php display_template_message('alert', '', 'danger'); ?>
    </div>
</div>