<a href="#" role="button" data-toggle="modal" data-target="#ajout-variable-modal" style="display:none;">Nouvelle variable</a>
<?php if($variables_etude) : ?>
<table id="data-table-gestion-variables" class="table table-responsive table-hover table-condensed" >
<thead>
    <tr class="info"> 
    <th class="sorting_asc">Variable</th>
    <th >Description</th> 
    <th >Type</th>
    <th>Répétition</th> 
    <!--<th>Modif/Supp</th> -->
  </tr>
</thead>
<tbody id='tbody'>
    <?php
     for($i=0;$i<count($variables_etude);$i++)
     {
        ?>
        <tr id="tr<?=$variables_etude[$i]["id"]?>">
          <td >
            <input id="var<?=$variables_etude[$i]["id"]?>" style="border:0px; width:100%" value="<?= $variables_etude[$i]['variable']; ?>" readonly/>
          </td>
          <td >
            <input id="desc<?=$variables_etude[$i]["id"]?>" style="border:0px; width:100%" value="<?=$variables_etude[$i]['libelle']; ?>" readonly/>
          </td>
      <td >
      <input id="unite<?=$variables_etude[$i]["id"]?>" style="border:0px; width:100%" value="<?= $variables_etude[$i]['type']; ?>" readonly/>
      </td>
      <td>
       <input id="type<?=$variables_etude[$i]["id"]?>" style="border:0px; width:100%" value="<?= $variables_etude[$i]['temps']; ?>" readonly/>
      </td>
      <!--<td><span id="modif<?=$variables_etude[$i]["id"]?>" id_var="<?=$variables_etude[$i]["id"]?>" class="glyphicon glyphicon-pencil" ></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a><span id="supp<?=$variables_etude[$i]["id"]?>" id_var="<?=$variables_etude[$i]["id"]?>" class="glyphicon glyphicon-trash" ></span></a></td>-->
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