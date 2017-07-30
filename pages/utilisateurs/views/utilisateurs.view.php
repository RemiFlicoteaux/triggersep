<?php element('menu_haut'); ?>
<!--<link rel='stylesheet' content='text/css' href='<?= PATH_CSS ?>users.css'>-->
<link rel='stylesheet' content='text/css' href='<?= PATH_CSS ?>form.css'>
<main id="user_form_content">
	<h2> <?= $lang['TXT_HEAD_CREA_USER'] ?> </h2>
	<?php
		if(isset($error_info) && !empty($error_info))
		{
			?>
				<div class='info error'>
					<?= $error_info ?>
				</div>
			<?php
		}
		if(isset($valid_info) && !empty($valid_info))
		{
			?>
				<div class='info valid'>
					<?= $valid_info ?>
				</div>
			<?php
		}
	?>
	<div class="form_content">
		<form id='crea_user_form' class='form' name='crea_user' method='POST' action='#'>
			<p><?= $lang['TXT_NEEDED_FIELD'] ?></p>
			<div class='form-group'>
				<label for='username' class='control-label'> <?= $lang['LIB_FORM_USERNAME'] ?> *</label>
				<input type='text' name='username' class='form-control' required>
				<span class='help-block hide' data-error-type='needed'><?= $lang['MSG_ERROR_MISS_THIS_FIELD'] ?></span>
			</div>
			<div class='form-group'>
				<label for='userpass' class='control-label'> <?= $lang['LIB_FORM_PASS'] ?> *</label>
				<input type='password' name='userpass' class='form-control' required>
				<span class='help-block hide' data-error-type='needed'><?= $lang['MSG_ERROR_MISS_THIS_FIELD'] ?></span>
			</div>
			<div class='form-group'>
				<label for='conf_userpass' class='control-label'> <?= $lang['LIB_FORM_CONF_PASS'] ?> *</label>
				<input type='password' name='conf_userpass' class='form-control' required>
				<span class='help-block hide' data-error-type='needed'><?= $lang['MSG_ERROR_MISS_THIS_FIELD'] ?></span>
			</div>
			<div class='form-group'>
				<label for='user_nom' class='control-label'> <?= $lang['LIB_FORM_NOM'] ?> </label>
				<input type='text' name='user_nom' class='form-control'>
				<span class='help-block hide'></span>
			</div>
			<div class='form-group'>
				<label for='user_prm' class='control-label'> <?= $lang['LIB_FORM_PRENOM'] ?> </label>
				<input type='text' name='user_prm' class='form-control'>
				<span class='help-block hide'></span>
			</div>
			<div class='form-group'>
				<label for='user_mail' class='control-label'> <?= $lang['LIB_FORM_MAIL'] ?> *</label>
				<input type='email' name='user_mail' class='form-control' pattern='<?= $b_pattern_email ?>' required>
				<span class='help-block hide' data-error-type='needed'><?= $lang['MSG_ERROR_MISS_THIS_FIELD'] ?></span>
				<span class='help-block hide' data-error-type='pattern'><?= $lang['MSG_ERROR_BAD_MAIL'] ?></span>
			</div>
			<div class='form-group'>
				<label for='user_tel' class='control-label'> <?= $lang['LIB_FORM_TEL'] ?> </label>
				<input type='tel' name='user_tel' class='form-control' pattern='<?= $b_pattern_tel ?>'>
				<span class='help-block hide'></span>
				<span class='help-block hide' data-error-type='pattern'><?= $lang['MSG_ERROR_BAD_TEL'] ?></span>
			</div>
			<div class='form-group'>
				<label for='user_fax' class='control-label'> <?= $lang['LIB_FORM_FAX'] ?> </label>
				<input type='tel' name='user_fax' class='form-control' pattern='<?= $b_pattern_tel ?>'>
				<span class='help-block hide'></span>
				<span class='help-block hide' data-error-type='pattern'><?= $lang['MSG_ERROR_BAD_TEL'] ?></span>
			</div>
			<div class='form-group'>
			<?php
				if($_SESSION['profile']=='super_admin')
				{
					?>
						<label for='user_grp' class='control-label'> <?= $lang['LIB_FORM_USER_GRP'] ?> *</label>
						<select name='user_grp' class='form-control' required>
							<option value='' selected></option>
							<?php
								foreach ($li_grp as $grp) 
								{
									?><option value="<?= $grp['nom'] ?>"><?= $grp['nom'] ?></option><?php
								}
							?>
						</select>
						<span class='help-block hide' data-error-type='needed'><?= $lang['MSG_ERROR_MISS_THIS_FIELD'] ?></span>
					<?php
				}
				else
				{
					?> <input type='hidden' name='user_grp' value="user"> <?php
				}
			?>
			</div>
			<div class='form-group'>
				<?php
					if($_SESSION['profile']=='admin')
					{
						?>
						<label for='user_centre' class='control-label'> <?= $lang['LIB_FORM_CENTRE'] ?> *</label>
						<select name='user_centre' class='form-control' required>
							<option value='' selected></option>
							<?php
								foreach ($li_centre as $centre) 
								{
									?><option value="<?= $centre['id_db'] ?>"><?= $centre['code']." - ".$centre['nom'] ?></option><?php
								}
							?>
						</select>
						<span class='help-block hide' data-error-type='needed'><?= $lang['MSG_ERROR_MISS_THIS_FIELD'] ?></span>
						<?php
					}
					else
					{
						?>
						<input type='hidden' name='user_centre' value='<?= $_SESSION['profile'] ?>'></input>
						<?php
					}
				?>
			</div>
			<input type='submit' name='crea_user'>
		</form>
	</div>
</main>