<table id="data-table-synthese" class="table table-responsive table-hover table-condensed table-Synthese" >
<thead>

   
 <?php if($table_data){
$nb_var_ref=count($catalogue);
print('<tr class="info"><th ><a href="./?'.
          make_query_string([
            "p" => "catalogue",
          ]).'" class="data-patients">variables de référence('.$nb_var_ref.')</a></th>');
    
    if($etudes){
    for($i=0;$i<count($etudes);$i++){
    print('<th ><a href="./?'.
          make_query_string([
            "p" => "appariement",
            "nom_etude"=>$etudes[$i]['nom_etude'],
          ]).'" class="data-patients" target="_self">'.$etudes[$i]['nom_etude'].'</a></th>');
  	}
  }
  print('<th>Total</th>');
   print('</tr>');}?>
  

</thead>
<tbody>
       <?php
    if($nbr_variables){
      $som=0;
      print('<tr>');
      print('<td style="font-weight: bold;">Nombre Des Variables etudes:</td>');
      for ($j=0; $j <count($nbr_variables) ; $j++) { 
        print('<td style="font-weight: bold;">'.$nbr_variables[$j].'</td>');
        $som+=$nbr_variables[$j];
      }
      print('<td style="font-weight: bold;">'.$som.'</td>');
      print('</tr>');
    }
    $som_nbr_patients=0;
    if($nbr_patients){
      print('<tr>');
      print('<td style="font-weight: bold;">Nombre Des Patients Par Etude :</td>');
      for ($j=0; $j <count($nbr_patients) ; $j++) {
        print('<td style="font-weight: bold;">'.$nbr_patients[$j].'</td>');
        $som_nbr_patients+=$nbr_patients[$j];
      }
      print('<td style="font-weight: bold;">'.$som_nbr_patients.'</td>');
      print('</tr>');
    }
    $som_diff=0;
    if($_SESSION['utilisateur']['profile']==='ADMIN'):
      if($etudes){
         print('<tr>');
        print('<td style="font-weight: bold;">Cliquer sur Exporter pour exporter les donneés:</td>');
        for($i=0;$i<count($etudes);$i++){
          
          print('<td style="font-weight: bold;"><a data-toggle="modal" data-target="#MyModal" data-id="'.$etudes[$i]['id'].'" data-whatever="'.$etudes[$i]["nom_etude"].'">Exporter</a></td>');
   
        }
        print('<td style="font-weight: bold;"><a data-toggle="modal" data-id="" data-target="#MyModal" data-whatever="Tous">Exporter Tous</a></td>');
        print('</tr>');
      }
    endif;
if(count($etudes)>=1):
	 for($i=0;$i<count($catalogue);$i++)
	 {
		?>
		<tr >
		  <td width="10%">
			<?= $catalogue[$i]['nom_variable']; ?>
		  </td>
      <?php

      for ($j=0; $j <count($etudes) ; $j++) { 
            $var='';
            for($k=0;$k<count($table_data[$etudes[$j]['id']]);$k++){
            if($catalogue[$i]['id']==$table_data[$etudes[$j]['id']][$k]['id_var_catalogue'])
            {    
            $var=$table_data[$etudes[$j]['id']][$k]['variable'];
            } 
           }
      print('<td>'.$var.'</td>');
      }
      
      ?>
    </tr>
		<?php }
endif;
    ?>
    <?php if ($infos['message']) : ?>
      <?php display_template_message('alert', $infos['message'], $infos['type']) ?>
    <?php endif; ?>

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
              <option  value="Export_ligne">
              Export en ligne
              </option>
            <option  value="Export_colone" >
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