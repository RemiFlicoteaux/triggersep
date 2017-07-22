<div style class="row" id='file_reader'>
    <form enctype="multipart/form-data" action="./?p=appariement" method="post" id="reader-form">
        <div class="data">
            <div class="row">
                <div class="col-md-12 one">
                   
                    <input style="display: none;" name='id_etude' value="<?=$b_id_etude?>"/>
                </div>
                <div>
                    <input style="display: none;" name='etude' value="<?=$b_nom_etude?>"/>
                    <p style="text-align: center;">
                    <button type="submit"  style="text-align: center;" value="Envoyer" name="Envoyer" class="btn btn-primary">Inserer</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>


