<?php
element($b_page . '/historique-insertion-data', [
    'b_etude' => $etude,
    'b_historique_data' => $historique_data
]);
?>
<div style class="row" id='file_reader'>
    <form enctype="multipart/form-data" action="" method="post" id="reader-form">
        <div class="data">
            <div class="row">
                <div class="col-md-12 one">

                    <input style="display: none;" id="id_etude" name='id_etude' value="<?= $etude['id'] ?>"/>
                    <input style="display: none;" id="id_projet" name='id_projet' value="<?= $etude['id_projet'] ?>"/>
                    <input style="display: none;" id="file_name" name='file_name' value="<?= $historique_data['fichier'] ?>"/>

                </div>
                <div>
                    <input style="display: none;" name='etude' value="<?= $b_nom_etude ?>"/>
                    <p style="text-align: center;">
                        <button type="submit"  style="text-align: center;" id="Verifier" value="Verifier" name="Verifier" class="btn btn-primary">Verifier</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="text-center" id="insertion-data-etude-loader">
    <img src="<?= PATH_IMG ?>loader.gif" alt="" />
</div>
<br />

<div class="user-output-message">    
    <?php if ($b_fichier_ok) : ?>
        <ul class="list-group">
            <li class="list-group-item list-group-item-success"><?= count($table_vars_reconnus); ?> variables reconnues</li>
            <li class="list-group-item list-group-item-danger"><?= count($table_vars_inconnus); ?>
                variables non reconnues <br>
                <?php foreach ($table_vars_inconnus as $v) : ?>
                    - <?= $v; ?>  <br>
                <?php endforeach; ?>
            </li>
        </ul>
        <div class="text-center">
            <button type="submit"  id="Inserer" value="Inserer" name="Inserer" class="btn btn-primary">Inserer</button>
        </div>
        <br />
        <div id="message-info" class="alert alert-info hide"></div>
    <?php endif; ?>
</div>

