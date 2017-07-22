<div id="informations-supplementaire">
  <div class="content">
    <ul>
      <li>
        <span>
          Nom de l'etude : <b class=""><?= $b_etude['nom_etude']; ?> </b>
        </span>
      </li>
      <li>
        <span>
          Description : <b class=""><?= $b_etude['description']; ?> </b>
        </span>
      </li>
      <li>
        <span>
          Format : <b class=""><?= $b_etude['format']; ?> </b>
        </span>
      </li>
      <li>
        <span>
          Date d'insertion des données :
          <b class=""><?= $b_historique_data['date_creation']; ?></b>
        </span>
      </li>
      <li>
        <span>
          Date de modification :
          <b class=""><?= $b_historique_data['date_modification']; ?></b>
        </span>
      </li>
      <li>
        <span>
          Nom de Fichier : <b class=""> <?= $b_historique_data['fichier']; ?> </b>
        </span>
      </li>
      <li>
        <span>
          Nom de créateur : <b class=""><?= $b_historique_data['login']; ?> </b>
        </span>
      </li>
    </ul>
  </div>
</div>