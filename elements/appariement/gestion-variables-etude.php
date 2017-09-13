<?php element($b_page . '/information-historique', ['b_etude' => $etude]); ?>
<a href="#" role="button" data-toggle="modal" data-target="#ajout-variable-modal" style="display:none;">Nouvelle variable</a>
<?php if ($variables_etude) : ?>
    <table id="data-table-gestion-variables" class="table table-responsive table-hover table-condensed" >
        <thead>
            <tr class="info"> 
                <th class="sorting_asc">Variable</th>
                <th >Description</th> 
                <th >Unite</th>
                <th >Type</th>
                <th>Répétition</th> 
                <!--<th>Modif/Supp</th> -->
            </tr>
        </thead>
        <tbody id='tbody'>
            <?php
            for ($i = 0; $i < count($variables_etude); $i++) {
                ?>
                <tr id="tr<?= $variables_etude[$i]["id"] ?>">
                    <td >
                       <?= $variables_etude[$i]['variable']; ?>
                    </td>
                    <td >
                        <?= $variables_etude[$i]['libelle']; ?>
                    </td>
                    <td >
                        <?= $variables_etude[$i]['unite']; ?>
                    </td>
                    <td >
                        <?= $variables_etude[$i]['type']; ?>
                    </td>
                    <td>
                        <?= $variables_etude[$i]['temps']; ?>
                    </td>
                    <!--<td><span id="modif<?= $variables_etude[$i]["id"] ?>" id_var="<?= $variables_etude[$i]["id"] ?>" class="glyphicon glyphicon-pencil" ></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a><span id="supp<?= $variables_etude[$i]["id"] ?>" id_var="<?= $variables_etude[$i]["id"] ?>" class="glyphicon glyphicon-trash" ></span></a></td>-->
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
<?php else : ?>
    <div  class="message">
        <?php display_template_message('alert', 'Aucun variables trouvés', 'danger'); ?>
    </div>
<?php endif; ?>
