<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPOSITORY</title>
    <!-- CSS -->
    <link rel="icon" href="<?= PATH_IMG; ?>favicon.ico" />
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/jquery.dataTables_bootstrap.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/multi-select.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>lib/bootstrap-multiselect.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>style.css">

    <!-- JAVASCRIPT -->
    <script src="<?= PATH_JS; ?>lib/jquery-1.11.2.min.js"></script>
    <script src="<?= PATH_JS; ?>lib/jquery-ui.min.js"></script>
    <script src="<?= PATH_JS; ?>lib/bootstrap.min.js"></script>
    <script type="text/javascript">
      var bootstrapButton = $.fn.button.noConflict();
      $.fn.bootstrapBtn = bootstrapButton;
    </script>
    <script src="<?= PATH_JS; ?>lib/datepicker-fr.js"></script>
    <script src="<?= PATH_JS; ?>lib/handlebars-v3.0.3.js"></script>
    <!-- DATATABLES -->
    <script src="<?= PATH_JS; ?>lib/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= PATH_JS; ?>lib/datatables/dataTables.tableTools.min.js"></script>
    <script src="<?= PATH_JS; ?>lib/datatables/jquery.dataTables.bootstrap.js"></script>
    <script src="<?= PATH_JS; ?>lib/datatables/numeric-space.js"></script>
    <script src="<?= PATH_JS; ?>lib/datatables/date-eu.js"></script>
    <script src="<?= PATH_JS; ?>lib/jquery.multi-select.js"></script>
    <script src="<?= PATH_JS; ?>lib/bootstrap-multiselect.js"></script>
    <script src="<?= PATH_JS; ?>polyfill.js"></script>
    <script src="<?= PATH_JS; ?>functions.js"></script>
    <script src="<?= PATH_JS; ?>utils.js"></script>
    <script src="<?= PATH_JS; ?>ui.js"></script> 
    <script  src="<?= PATH_JS; ?>script-autocomplete.js"></script>
    <?php if (file_exists(PATH_JS . 'script-' . $b_page . '.js')) : ?>
      <script src="<?= PATH_JS; ?>script-<?= $b_page; ?>.js"></script>
    <?php endif; ?>
    <!-- IE 8 support -->
    <!--[if lt IE 9]> 
      <script src="<?= PATH_JS; ?>lib/respond-custom.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <?php $b_display_html ? include 'header.php' : null; ?>

      <div class="wrap">
            <?php include 'dispatch.php'; ?>

      </div>
      <div class="hide">
            <?php
            $liste_projets=get_list_projets(); 
            element('utilisateur/changer-projet', ['projets' =>$liste_projets]); ?>
        </div>
       <div class="">
          <?php element('gestion-projets/nouveau-projet'); ?>
      </div>

      <?php $b_display_html ? include 'footer.php' : null; ?>  

      <!-- MODULE INSERTION NOUVELLE ETUDE -->
        <?php
        element('liste-des-etudes/ajout-nouvelle-etude', [
            'b_page' => $b_page,
            'id_projet' => $b_id_projet,
        ]);
        ?>
  </body>
</html>
