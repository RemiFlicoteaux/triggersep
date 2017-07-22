<div class="row" id='file_reader'>
	<form enctype="multipart/form-data" action="./?p=data" method="post" id="reader-form">
		 <div class="params">
			<div class="row">
				<div class="col-md-12 one">
					<label for="etude">Liste des études</label>
					  <select  id="etude" name="etude" class="form-control">
						<option value="">Sélectionner</option>

						<?php if (count($liste_etudes)>0) {
						 foreach ($liste_etudes as $etude) : ?>
						  <option <?= selected($etude['nom_etude'] ,@$_POST['nom_etude']) ? 'selected' : '' ?> value="<?= $etude['nom_etude']; ?>">
							<?= $etude['nom_etude']; ?> 
						  </option>
						<?php endforeach; 
						?>
						<option value="Tous les etudes">Tous les etudes</option>
						<?php } ?>
					  </select>
					</div>
					<div>
						<p style="text-align: center;"><button type="submit" style="text-align: center;" value="Afficher" name="Afficher" class="btn btn-success">Afficher</button>
						</p>
						
					</div>
				</div>
		</div>
	</form>
</div>


