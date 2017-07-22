<div id="admin_users_rip">

  <div class="wrap">
    <div class="panel panel-custom">
      <!-- Default panel contents -->
      <div class="panel-heading">Utilisateurs de l'application <?=$b_name_projet;?></div>
      <div class="panel-body">
        <!--table-->
        <form action="./?<?= make_query_string(['p' => 'admin_users']) ?>" method="post">
          <table class="table table-condensed">
            <thead>
              <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Identifiant</th>
                <th>Mot de passe</th>
                <th>Mise à jour<br>mot de passe</th>
                <th>Email</th>
                <th>Dernière connexion</th>
                <th>Role</th>
                <th>Bloquer/Débloquer<br>cet utilisateur</th>
              </tr>
            </thead>
            <?php
            $i = 0;
            foreach ($data_users as $users) :
              $i ++;
              ?>
              <tbody>
                <tr class ="<?= $b_session_utilisateur['identifiant'] === $users['identifiant'] ? 'line-selected' : '' ?>">
                  <td>
                    <input type ="hidden" name="user[<?= $users['identifiant']; ?>]"/>
                    <?= $i; ?>
                  </td>
                  <td>
                    <?= $users['nom']; ?>
                  </td>
                  <td>
                    <?= $users['prenom']; ?>
                  </td>
                  <td>
                    <?= $users['identifiant']; ?>
                  </td>
                  <td>
                    <input type="hidden" 
                           name="user[<?= $users['identifiant']; ?>][ancien_mot_de_passe]"
                           value="<?= $users['mot_de_passe']; ?>"/>
                    <input name="user[<?= $users['identifiant']; ?>][mot_de_passe]" 
                           class="input_pass form-control input-sm" 
                           type ="text"
                           value="<?= $users['mot_de_passe']; ?>"/>
                    </button>
                  </td>
                  <?php $diff = date_diff_day($users['date_mise_a_jour_mdp'], date('Y-m-d H:i:s')); ?>
                  <td class="update_password_<?= $users['identifiant']; ?> text-<?= $diff >= RIP_LIMIT_PASSWORD_VALIDITY ? "danger" : "" ?>">
                    <span><?= $diff ?></span>
                    jour<?= $diff > 1 ? 's' : '' ?>
                  </td>
                  <td>
                    <?php $mail = $users['email']; ?>
                    <?php if ($mail) : ?>
                      <a href="mailto:<?= $mail; ?>">
                        <?= $mail; ?></a>
                    <?php else: ?>
                      <span class="label label-warning">Pas d'adresse mail</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($users['derniere_connexion']) : ?>
                      <?= date('d/m/Y H:i:s', strtotime($users['derniere_connexion'])); ?>
                    <?php else: ?>
                      <span class="label label-warning">Jamais connecté</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($b_session_utilisateur['identifiant'] !== $users['identifiant']) : ?>
                      <input type="hidden" 
                             name="user[<?= $users['identifiant']; ?>][ancien_role]"
                             value="<?= $users['role']; ?>"/>
                      <select name="user[<?= $users['identifiant']; ?>][role]">
                        <option <?= selected($users['role'], ADMIN_ROLE) ? 'selected' : ''; ?> 
                          value="1">Administrateur</option>
                        <option <?= selected($users['role'], USER_ROLE) ? 'selected' : ''; ?>  
                          value="2">Utilisateur</option>
                      </select>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($users['role'] > 1 && $b_session_utilisateur['identifiant'] !== $users['identifiant']) : ?>
                      <button type="submit" 
                              class="btn btn-<?= $users['active'] ? "success" : "danger"; ?> btn-xs" 
                              name="active" 
                              value="<?= $users['identifiant']; ?>"
                              title="<?= $users['active'] ? "Bloquer" : "Débloquer"; ?>">
                        <span class="glyphicon glyphicon-<?= $users['active'] ? "ok" : "ban"; ?>-circle"></span>
                      </button>
                    <?php else: ?>
                      <span class="label label-info">Administrateur</span>
                    <?php endif ?>
                  </td>
                </tr>
                <?php
              endforeach;
              ?>
            </tbody>
          </table>
          <!--end of table-->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning" name="users" >Soumettre les modifications <span class="glyphicon glyphicon-send"></span></button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php if ($message) : ?>
      <div class="wrapper"><?php display_template_message('alert', $message, $type); ?></div>
    <?php endif; ?>
  </div>
</div>