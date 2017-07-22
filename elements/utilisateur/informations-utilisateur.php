<script id="utilisateur-droit-template" type="text/x-handlebars-template">
<div class="utilisateur">
  <h4 class="text-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{message.0.nom}} {{message.0.prenom}}</h4>
  <div class="form">
    <form action="" method="post">
      <input type="hidden" name="login" value="{{message.0.login}}" />
      <div class="form-group">
        <label for="type">Type de compte : </label>
        <select class="form-control input-sm" id="type" name="type">
          <option value="-1">-- Sélectionner --</option>
          <?php foreach ($profils as $role => $profil) : ?>
            <option {{#ifCond message.0.profile  '<?= $role; ?>'}} selected {{/ifCond}} value="<?= $role; ?>">
            <?= $profil; ?>
          </option> 
        <?php endforeach; ?>
      </select>
    </div>
    <!--<div class="form-group">
      <label for="type">Site par défaut : </label>
      <select class="form-control input-sm" id="type" name="hopital">
        <?php foreach ($hopitaux as $code => $hp) : ?>
          <option {{#ifCond message.0.default_site  '0<?= $code; ?>'}} selected {{/ifCond}} value="<?= $code; ?>">
            <?= current($hp) . '(' . get_code_hp($code) . ')'; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div> -->
    <div class="form-group">
      <label for="page_accueil">Page d'accueil : </label>
      <select class="form-control input-sm" id="page_accueil" name="page_accueil">
        <option value="-1">-- Sélectionner --</option>
        <?php foreach ($modules as $module_name => $module) : ?>
          <option {{#ifCond message.0.default_page  '<?= $module_name; ?>'}} selected {{/ifCond}} value="<?= $module_name; ?>">
          <?= $module; ?>
        </option> 
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="disable_account" class="text-danger"><b>Desactiver ce compte :</b></label>
    <input type="checkbox" name="disable_account" id="disable_account" {{#ifCond message.0.etat '0'}} checked {{/ifCond}} />
  </div>
  <div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="droits nav nav-tabs" role="tablist" id="tabpanel"> 
      <?php
      $start = false;
      foreach ($modules as $module_name => $module) :
        ?>
        <li role="presentation" >
          <a href="#<?= $module_name; ?>" aria-controls="<?= $module_name; ?>" role="tab" data-toggle="tab">
            <?= $module; ?>
          </a>
        </li> 
        <?php
        $start = true;
      endforeach;
      ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <?php
      foreach ($modules as $module_name => $module) :
        switch ($module_name) {
        case 'ipop' :
          ?>
          <!-- IPOP -->
          <div role="tabpanel" class="tab-pane" id="<?= $module_name; ?>">
            <br />
            <p>Services (<?= $module; ?>) : </p>
            <div class="row">
              <div class="col-md-6">
                <b class="text-primary">Privilèges disponible :</b>
              </div>
              <div class="col-md-6">
                <b class="text-primary">
                  Privilège pour cette utilisateur :
                </b>
              </div>
            </div>
            <div class="form-group">
              <select multiple="multiple" id="multiselect-<?= $module_name; ?>" name="services_ipop[]">
                <?php foreach ($services_ipop as $service) : ?>
                  <option  {{#each message}} 
                    {{#ifCond this.id '<?= $service['id']; ?>'}} 
                    {{#ifCond this.droit_type '<?= $module_name; //ipop        ?>'}} 
                    selected 
                    {{/ifCond}} 
                    {{/ifCond}} 
                    {{/each}} 
                    value="<?= $service['id']; ?>" >
                    <?= $service['lib_service']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <?php
        break;
        case 'nestor' :
            ?>
            <!-- NESTOR -->
            <div role="tabpanel" class="tab-pane" id="<?= $module_name; ?>">
              <br />
              <p>Services (<?= $module; ?>) : </p>
              <div class="row">
                <div class="col-md-6">
                  <b class="text-primary">Privilèges disponibles :</b>
                </div>
                <div class="col-md-6">
                  <b class="text-primary">
                    Privilège(s) pour cet utilisateur :
                  </b>
                </div>
              </div>
              <div class="form-group">
                <select multiple="multiple" id="multiselect-<?= $module_name; ?>" name="services_nestor[]">
                  <?php foreach ($services_nestor as $service) : ?>
                    <option  {{#each message}} 
                      {{#ifCond this.id '<?= $service['code_service']; ?>'}} 
                      {{#ifCond this.droit_type '<?= $module_name; //nestor        ?>'}} 
                      selected 
                      {{/ifCond}} 
                      {{/ifCond}} 
                      {{/each}} 
                      value="<?= $service['code_service']; ?>">
                      <?= $service['service_lib']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <?php
          break;
          case 'u2i' :
            ?>
            <!-- U2I -->
            <div role="tabpanel" class="tab-pane " id="<?= $module_name; ?>">
              <br />
              <p>Services (<?= $module; ?>) : </p>
              <div class="row">
                <div class="col-md-6">
                  <b class="text-primary">Privilèges disponibles :</b>
                </div>
                <div class="col-md-6">
                  <b class="text-primary">
                    Privilège(s) pour cet utilisateur :
                  </b>
                </div>
              </div>
              <div class="form-group">
                <select multiple="multiple" id="multiselect-<?= $module_name; ?>" name="services_u2i[]">
                  <?php foreach ($services_u2i as $service) : ?>
                    <option  {{#each message}} 
                      {{#ifCond this.id '<?= $service['code_service']; ?>'}} 
                      {{#ifCond this.droit_type '<?= $module_name; //u2i        ?>'}} 
                      selected 
                      {{/ifCond}} 
                      {{/ifCond}} 
                      {{/each}} 
                      value="<?= $service['code_service']; ?>">
                      <?= $service['service_lib']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <?php
          break;
    }
  endforeach;
  ?>
</div>
</div>
<button type="button" class="btn btn-success pull-right">
  <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
  Enregistrer
</button>
</form>
</div>
<div class="clear"></div>
<br>
</div>
</script>

<div class="message">
  <?php display_template_message('alert', ''); ?>
</div>
<div id="informations-utilisateur"></div>
