<div class="row" id='file_reader'>
	<form enctype="multipart/form-data" action="./?p=appariement" method="post" id="reader-form">
		 <div class="params">
			<div class="row">
				<div class="col-md-12 one">
					<label for="etude">Liste des études</label>
					  <select  id="select_etude" name="etude" class="form-control">
						<option value="">Sélectionner</option>
						<?php if (count($liste_etudes)>0) {
						foreach ($liste_etudes as $etude) : ?>
						  <option <?= selected($etude['nom_etude'] ,@$_POST['nom_etude']) ? 'selected' : '' ?> value="<?= $etude['nom_etude']; ?>" >
							<?= $etude['nom_etude']; ?> 
						  </option>
						<?php endforeach; } ?>
					  </select>
					</div>
					<div id="div_new_etude" class="col-md-12 one" hidden='true'>
						<label for="file"> Selectioner un fichier : </label><input class="btn btn-default" name="file" type="file" >
						<br><br>
					</div>
					<div>
						<p style="text-align: center;">
						<button id="btn_submit" type="submit" style="text-align: center;" value="Afficher" name="Afficher" class="btn btn-success">Afficher</button>
						</p>
					</div>
				</div>
		</div>
	</form>
</div>


