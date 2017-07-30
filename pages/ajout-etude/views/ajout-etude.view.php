<div  id="ajout-etude" role="dialog" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" >
    <div class="modal-dialog">
	<div class="modal-content">
            <div class="modal-header" align="center">
                <div id="div-forms">
                     <form action="" method="post" id="nouvelle-etude">
                        <div class="modal-body">
                            <div id="div-ajout-msg">
                                <div id="icon-ajout-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-ajout-msg">Nouvelle etude</span>
                            </div>
                            <input id="id_etude" name="id_etude" class="form-control" type="text" style="display: none;">
                            <input id="nom_etude" name="nom_etude" class="form-control" type="text" placeholder="Nom de l'étude">
                            <input id="description" name="description" class="form-control" type="text" placeholder="Description">
                            <div class="row">
                              <div class="col-md-12">
                                <label >Format Fichier des donneés de l'étude :</label>
                                <label style="margin-left: 0%"><input type="radio" name="format_fichier" value="1" checked><a href="<?=PATH_DATA.'format_fichier/format1.xlsx';?>"> Format 1</a></label> 
                                <label style="margin-left: 0%"><input type="radio" name="format_fichier" value="2"><a href="<?=PATH_DATA.'format_fichier/format2.xlsx';?>"> Format 2</a></label>
                                <label style="margin-left: 0%"><input type="radio" name="format_fichier" value="3"><a href="<?=PATH_DATA.'format_fichier/format3.xlsx';?>">Format3</a></label> 
                              </div>
                            </div>
                            <input id="id_projet" name="id_projet" class="form-control" type="text" value='<?=$id_projet;?>' style="display: none;">
                        </div>
                        <div id="message" class="message">
                            <?php display_template_message('alert', '', 'danger'); ?>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button id="valide" type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>