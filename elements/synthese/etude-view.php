
 <table id="data-table-synthese" class="table table-responsive table-hover table-condensed" >
<thead>
  <?php
    if($etudes){
    for($i=0;$i<count($etudes);$i++){
    print('<tr class="info"><th ><a data-toggle="modal" data-target="#MyModal" data-id="'.$etudes[$i]["id"].'" data-whatever="'.$etudes[$i]["nom_etude"].'">'.$etudes[$i]['nom_etude'].' (Exporter)</a></th>');
    }
   }?>
   
    <?php if($table_data){     
    print(' <th >variables de référence Triggersep ('.count($table_data).')</th>');
    print(' <th >Nombres des données Manquants Par Variable</th>');
}
print('</tr>');?>
</thead>
<tbody>
    <form >
       <?php
    if($nbr_variables){
      print('<tr>');
      print('<td style="font-weight: bold;">Nombre Des Variables etudes:</td>');
      for ($j=0; $j <count($nbr_variables) ; $j++) { 
        print('<td style="text-align:center;font-weight: bold;">'.$nbr_variables[$j].'</td>');
      }
      print('<td></td></tr>');
    }
      ?>
    <?php
    if($nbr_variables){
      print('<tr>');
      print('<td style="font-weight: bold;">Nombre Des Variables Manquants :</td>');
      for ($j=0; $j <count($nbr_variables) ; $j++) {
        $diff=count($table_data)-$nbr_variables[$j];
        print('<td style="text-align:center;font-weight: bold;">'.$diff.'</td>');
      }
      print('<td></td></tr>');
    }
      ?>
    <?php
    if($nbr_patients){
      print('<tr>');
      print('<td style="font-weight: bold;"">Nombre Des Patients Par Etude :</td>');
      for ($j=0; $j <count($nbr_patients) ; $j++) {
        print('<td style="font-weight: bold;">'.$nbr_patients[$j].'</td>');
      }
      print('<td></td></tr>');
    }
      ?>

    <?php
if(count($etudes)>0):
	 for($i=0;$i<count($catalogue);$i++)
	 {
		?>
		<tr >
		 
      <?php

      for ($j=0; $j <count($etudes) ; $j++) { 

                    $var=$table_data[$catalogue[$i]['nom_variable']][$etudes[$j]['nom_etude']]['variable'];
                    
                    print('<td  >'.$var.'</td>'); 
                          
      }

      ?>
       <td width="10%" style="text-align:center;">
      <?= $catalogue[$i]['nom_variable']; ?>
      </td>
      <td style="text-align:center; "><?php

      for ($j=0; $j <count($etudes) ; $j++) { 

        echo $table_data[$catalogue[$i]['nom_variable']][$etudes[$j]['nom_etude']]['nbr_vars_manquants']; 

        }?>
        </td>
    </tr>
		<?php }
else:
      $infos['message'] = 'aucun données';
      display_template_message('alert', $infos['message'], $infos['type']);
endif;
    ?>
    </form>
     </div>
  </div>

<tfoot>

</tfoot>

</table>
<!-- Small modal -->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="MyModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="MyModalLabel"></h4>
      </div>
       <form >
      <div class="modal-body">
          <div class="form-group">
            <label for="etude">Format Export</label>
          <select  id="select_format" name="format" class="form-control">
              <option value="">Sélectionner le format d'export</option>
              <option  value="Export en ligne" >
              Export en ligne
              </option>
            <option  value="Export en colone" >
              Export en colone
              </option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a id='link-export'><button type="button" class="btn btn-primary">Exporter</button></a>
      </div>
      </form>
    </div>
  </div>
</div>
