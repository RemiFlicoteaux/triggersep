<div id="etude-infos" class="etude">
  <div class="container-fluid">
    <div class="title">
      <h3>Gestion des etudes</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div>
<<<<<<< HEAD
          <button id="nouvelle_etude" data-target="#ajout-etude-modal" data-toggle="modal" role="button" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>Ajouter Nouvelle Etude</button>
        </div>
        <div class="title">
          <strong>Liste des etudes</strong>
          <hr />
=======
          <button id="nouvelle_etude" data-target="#ajout-etude-modal" data-toggle="modal" role="button" class="btn btn-primary">Ajouter une nouvelle étude</button>
>>>>>>> 27976f6... #fix spell
        </div>
        <div class="border">
          <table id="data-table-etudes" class="display table table-condensed table-responsive table-striped table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th hidden>Numéro de l'étude</th>
                <th>Nom d'étude</th>
                <th>Description</th>
                <th>Format</th>
                <th>Nombre des variables</th>
                <th>Date création</th>
                <th>Date modification</th>
                <th>Modifier</th>
                <th>Supprimer</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($etudes as $etude) : ?>
                <tr id="<?=$etude['id'];?>" >
                  <td hidden id="id_etude" class="id_etude"><?=$etude['id']; ?></td>
                  <td class="nom_etude" >
                    <a href="./?p=appariement&nom_etude=<?= $etude['nom_etude']; ?>"><?=$etude['nom_etude'];?></a>
                  </td>
                  <td class="description"><?= $etude['description']; ?></td>
                  <td id='format' class="format"><?= $etude['format']; ?></td>
                  <td ><?= $etude['nombre_variables'];?></td>
                  <td ><?= $etude['date_creation']; ?></td>
                  <td><?=$etude['date_modification'];?></td>
                  <td><span  class="glyphicon glyphicon-pencil" ></span></td>
                  <td><span  class="glyphicon glyphicon-trash" ></span></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
            <!-- MODULE INSERTION NOUVELLE ETUDE -->
            <?php element($b_page . '/ajout-nouvelle-etude',[
                'b_page' => $b_page,
                'id_projet' => $b_id_projet,
                ]); ?>
            <br />  
  </div>
</div>
