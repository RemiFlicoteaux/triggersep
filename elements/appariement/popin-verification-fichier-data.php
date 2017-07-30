<div class="modal fade" id="verification-fichier-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" title="Vérification de fichier des données">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="popin" title="Vérification de fichier des données">
                <div id="msg-traitement">
                    <?php if ($b_extension == false): ?>
                        <div class="alert alert-danger" role="alert">
                            L'extension de fichier est incorrecte (le fichier doit etre un fichier csv)
                        </div>
                    <?php else: ?>
                        <div class="alert alert-success" role="alert">
                            Extension valide
                        </div>
                        <?php if ($available_variables): ?>
                            <div class="alert alert-success" role="alert">
                                Nombre des variables reconnus est : 
                                <?= $available_variables; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-danger" role="alert">
                                Aucun variable reconnu trouvé
                            </div>
                        <?php endif; ?>  
                        <?php if ($missing_variables): ?>
                            <div class="alert alert-danger" role="alert">
                                <b><?= count($missing_variables); ?></b> variable(s) du fichier de données n'ont pas été décrite(s) dans le fichier de variables de l'étude:
                                <ul>
                                    <?php foreach ($missing_variables as $var) : ?>
                                        <li><b>- <?= $var ?></b></li>
                                    <?php endforeach; ?>
                                </ul>
                                Ces variables ne seront pas inclues dans la base.<br>
                                Pour les insérer vous devez soit modifiés les noms de variable(s) dans le fichier de données soit modifier le fichier descriptif des variables.
                            </div>
                        <?php else: ?>
                            <div class="alert alert-success" role="alert">
                                Toutes les variables du fichier de données ont une corréspondance dans le fichier des variables.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div id="message_success" class="message">
                    <?php display_template_message('alert', '', 'success'); ?>
                </div>
                <div id="message_danger" class="message">
                    <?php display_template_message('alert', '', 'danger'); ?>
                </div>
                <input id='file_name' type='text' value='<?= $file_name_destination; ?>' hidden>
                <input id='id_projet' type='text' value='<?= $id_projet; ?>' hidden>
                <input id='nom_etude' type='text' value='<?= $nom_etude; ?>' hidden>

            </div>
        </div>
    </div>
</div>