<div id="changer-projet" class="wrapper">
  <div class="form">
    <form class="form">
      <div class="form-group">
        <label>Liste des projets : </label>
        <select class="form-control" name="projet">
          <?php for($i=0;$i<count($projets);$i++){ ?>
            <option value="<?= $projets[$i]["id"]; ?>">
              <?= $projets[$i]['nom_projet']; ?>
            </option>
            <?php } ?>
        </select>
      </div>
    </form>
  </div>
  <div id="message" class="text-center">
    <?php display_template_message('alert', '', 'success'); ?>
  </div>
</div>