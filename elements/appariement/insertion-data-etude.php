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

                    <input style="display: none;" name='id_etude' value="<?= $b_id_etude ?>"/>
                </div>
                <div>
                    <input style="display: none;" name='etude' value="<?= $b_nom_etude ?>"/>
                    <p style="text-align: center;">
                        <button type="submit"  style="text-align: center;" value="Inserer" name="Inserer" class="btn btn-primary">Inserer</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="text-center" id="insertion-data-etude-loader">
    <img src="<?= PATH_IMG ?>loader.gif" alt="" />
</div>