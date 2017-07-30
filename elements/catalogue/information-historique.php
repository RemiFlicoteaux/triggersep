<div id="informations-supplementaire">
  <div class="content">
    <ul>
      <li>
        <span>
          Date de création :
          <b class=""><?= $historique_catalogue[0]['date_insertion']; ?></b>
        </span>
      </li>
      <li>
        <span>
          Nom du fichier : <a href="<?=PATH_DATA.$historique_catalogue[0]['nom_fichier'];?>" target="back" class=""> <?= $historique_catalogue[0]['nom_fichier']; ?> </a>
        </span>
      </li>
      <li>
        <span>
          Nom du créateur : <b class=""><?= $historique_catalogue[0]['login']; ?> </b>
        </span>
      </li>
    </ul>
  </div>
</div>
