<div class="jumbotron">
    <div class="container-fluid">
        <?php if ($project) : ?>
            <div class="text-center">            
                <h1 class="text-center">Bienvenue sur l'application <?= $project->nom_projet; ?></h1>
                <p>Date de création : <?= $project->date_creation; ?></p>
                <h2><?= $project->description; ?></h2>
                <a href="<?= LINK_HELP; ?>" target="_blank">Aide <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>
            </div>
        <?php else : ?>
            <form action="" method="post" class="form">
                <div class="form-group">
                    <label for="project">Choisir un projet</label>
                    <select name="id_project" class="form-control">
                        <option value="">----</option>
                        <?php foreach ($all_projects as $p) : ?>
                            <option value="<?= $p->id ?>"><?= $p->nom_projet ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-success pull-right" type="submit">Choisir</button>
                <div class="clear"></div>
            </form>
        <?php endif; ?>
    </div>
</div>
