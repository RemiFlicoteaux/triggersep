<div id="connexion">
  <div class="login">
    <div class="top">
     
      <b>Entrez votre identifiant et votre mot de passe.</b>
    </div>
    <div class="form">
      <hr />
      <form class="form-horizontal" action="" method="post">
        <div class="form-group">
          <label for="login" class="col-sm-4 control-label">Identifiant</label>
          <div class="col-sm-5">
            <input type="text" class="form-control input-sm" id="login" name="login" autofocus placeholder="Login" required>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-4 control-label">Mot de passe</label>
          <div class="col-sm-5">
            <input type="password" class="form-control input-sm" id="password" name="password" autocomplete="off" placeholder="Mot de passe" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-default btn-sm">Se connecter</button>
          </div>
        </div>
      </form>
    </div>
    <?php if ($infos['message']) : ?>
      <?php display_template_message('alert', $infos['message'], $infos['type']) ?>
    <?php endif; ?>
  </div>
</div>
<?php element('assistance'); ?>

