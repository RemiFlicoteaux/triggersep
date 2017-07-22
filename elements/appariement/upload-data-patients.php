<div style class="row" id='file_reader'>
	<form enctype="multipart/form-data" action="./?p=data" method="post" id="reader-form">
		 <div class="data">
			<div class="row">
					
					<div class="col-md-12 one">
						<label for="file"> Selectioner le fichier des données: </label><input class="btn btn-default" name="file" type="file" >
					<br>
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


