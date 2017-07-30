<div id="projet-infos" class="projet">
  <div class="container-fluid">
    <div class="title">
      <h3>Gestion des Projets</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div>
          <button id="ajout-nouveau-projet" data-target="#ajout-projet-modal" data-toggle="modal" role="button" href='#' class="btn btn-primary">Ajouter nouveau projet</button>
        </div>
        <div class="title">
          <strong>Liste des Projets</strong>
          <hr />
        </div>
        <div class="border">
          <table id="data-table-projets" class="display table table-condensed table-responsive table-striped table-hover" >
            <thead>
              <tr>
                <th hidden>Numéro de Projet</th>
                <th>Nom Projets</th>
                <th>Description</th>
                <th>Nombre Des Etudes</th>
                <th>Créateur</th>
                <th>Date Création</th>
                <th>Date Modification</th>
                <th>Modifier</th>
                <th>Supprimer</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($Projets as $Projet) : ?>
                <tr >
                  <td class="id_projet" hidden><?=$Projet['id']; ?></td>
                  <td class="nom_projet"><?= $Projet['nom_projet']; ?></td>
                  <td  class="description"><?= $Projet['description']; ?></td>
                  <td><?=$Projet['nombre_etudes'];?></td>
                  <td id='createur' class="createur"><?= $Projet['createur']; ?></td>
                  <td class="page_accueil"><?= $Projet['date_creation']; ?></td>
                  <td class="page_accueil"><?= $Projet['date_modification']; ?></td>
                  <td><span class="glyphicon glyphicon-pencil" ></span></td>
                  <td><span class="glyphicon glyphicon-trash" ></span></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div> 
    </div>
    <!-- MODULE INSERTION NOUVELLE ETUDE -->
            <?php element($b_page . '/nouveau-projet',[
                'b_page' => $b_page,
                ]); ?>
            <br /> 
  </div>
</div>
