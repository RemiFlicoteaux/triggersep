<a href="#" class="glyphicon glyphicon-plus" role="button" data-toggle="modal" data-target="#ajout-variable-modal">Ajouter un variable</a>
<table id="data-table-gestion-variables" class="table table-responsive table-hover table-condensed" >
<thead>
	<tr class="info"> 
    <th class="sorting_asc">Variable</th>
    <th >Description</th> 
    <th >Unité</th>
    <th>Type</th> 
    <th>Modif/Supp</th> 
  </tr>
</thead>
<tbody id='tbody'>
<tr id="new_var" style="display:none;"><td ><input id='var' style='border:2px solid; width:100%' value='' /></td><td ><input id='desc' style='border:2px solid; width:100%' value='' /></td><td ><input id='unite' style='border:2px solid; width:100%' value='' /></td><td><input id='type' style='border:2px solid; width:100%' value='' /></td><td><span id='add' class='glyphicon glyphicon-ok' ></span>&nbsp&nbsp&nbsp&nbsp&nbsp<img id="annuler" src="<?=PATH_IMG?>annuler-icone-9581-16.png" /></td></tr>
    <?php
	 for($i=0;$i<count($table_data);$i++)
	 {
		?>
		<tr id="tr<?=$table_data[$i]["id"]?>">
		  <td >
			<input id="var<?=$table_data[$i]["id"]?>" style="border:0px; width:100%" value="<?= $table_data[$i]['nom_variable']; ?>" readonly/>
		  </td>
		  <td >
			<input id="desc<?=$table_data[$i]["id"]?>" style="border:0px; width:100%" value="<?=$table_data[$i]['description']; ?>" readonly/>
		  </td>
      <td >
      <input id="unite<?=$table_data[$i]["id"]?>" style="border:0px; width:100%" value="<?= $table_data[$i]['unites']; ?>" readonly/>
      </td>
      <td>
       <input id="type<?=$table_data[$i]["id"]?>" style="border:0px; width:100%" value="<?= $table_data[$i]['type']; ?>" readonly/>
      </td>
      <td><span id="modif<?=$table_data[$i]["id"]?>" id_var="<?=$table_data[$i]["id"]?>" class="glyphicon glyphicon-pencil" ></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a><span id="supp<?=$table_data[$i]["id"]?>" id_var="<?=$table_data[$i]["id"]?>" class="glyphicon glyphicon-trash" ></span></a></td>
    </tr>
    		<?php
    	     }
          ?>
</tbody>
<tfoot>
</tfoot>
</table>

 
