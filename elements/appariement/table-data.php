<?php
 element($b_page . '/information-historique', [
                                            'b_etude' => $etude
                                        ]);
 element($b_page . '/variables-cles', [
                                            'b_format_fichier' => $format_fichier_data,
                                            'variables_etude' => $variables_etude,
                                        ]);

?>

<br>
<!-- AFFICHAGE DATA TABLE APPARIEMENT -->
<div>
   <h4>Etape 2 : Appariez les variables</h4>
</div>
<table id="data-table-appariement" class="table table-responsive table-hover table-condensed" >
<thead>
	<tr class="info"> 
    <th class="sorting_asc">Variable Catalogue</th>
    <th >Description</th> 
    <th >Unité</th>
    <th style="border-left: 2px solid #cdd0d4;" >Variable</th>
    <th ></th>
    <th >Libellé</th>
    <th >Unité</th>
    <?php if($b_format_fichier==1):?>
    <th >Répétition</th> 
  <?php endif; ?>
    
  </tr>
</thead>

<tbody>
    <?php
    foreach ($table_data as $data) :
		?>
		<tr>
		  <td style="width:20%;" >
                      <?= $data['var_catalogue']; ?>
		  </td>
		  <td style="width:20%;" >
                      <?= $data['description']; ?>
		  </td >
                  <td style="width:10%;" id="unite<?=$data['id_var_cat'];?>">
                      <?= $data['unites']; ?>
                  </td>
                 <td id="td_lib<?=$data['id_var_cat'];?>" class='tdinput' style="border-left: 2px solid #cdd0d4;" >
                     <div id="div<?=$data['id_var_cat'];?>" >
                    <?php foreach ($data['variable'] as $variable_id => $variable) : ?>
                         <?php if ($variable) : ?>
                            
                                <input id='var<?=$variable_id;?>' type="text" value="<?=$data['variable'][$variable_id];?>" style="border:0px; width:90%" class="classinput" data-link="./?p=ajax_autocomplete&t" id_var_catalogue='<?=$variable_id;?>' readonly/>
                                <span style="color:red" id_var_ref='<?=$data['id_var_cat'];?>' id_etude='<?=$data['id_etude'];?>' id_var_etude="<?=$variable_id;?>" class="glyphicon glyphicon-remove" ></span> 
                                <?php endif;
                                 endforeach;?>
                    </div>
                    <input id='<?=$data['id_var_cat'];?>' style='width:90%' style='border:0px;width:80%'  href='#add-var-box' type='text' class='classinput' data-link='./?p=ajax_autocomplete&id_etude=<?=$b_id_etude;?>' id_var_catalogue='<?=$data['id_var_cat'];?>' />
                 </td>
                 <td></td>
                  <td id="long_name<?=$data['id_var_cat'];?>">
                   <?php 
                   foreach ($data['libelle'] as $variable_id => $libelle) : ?>
                    <?php if($libelle):?>
                        <div  class="libelle">
                            <libelle id="libelle<?=$data['id_var_cat'];?>" class="infobulle"><img src="<?= PATH_IMG .'info'?>.png"><span> 
                                <description><?=$data['libelle'][$variable_id];?></description>
                                </span>
                            </libelle>
                        </div>
                    <?php endif;
                            break;
                        endforeach; ?>
                   </td>

             <td id="unite<?=$data['id_var_cat'];?>">
            </td>
            <?php if($b_format_fichier==1):?>
            <td id="temp<?=$data['id_var_cat'];?>" class="temps" style="widht:3%" >
                <?php foreach ($data['temps'] as $variable_id => $temps) : ?>
                    <?php if($libelle):?>
                        <input style="border:0px;width:100%;" id='temps<?=$variable_id;?>' idvar="<?=$variable_id;?>" value="<?=$data['temps'][$variable_id];?>" type="textbox"  size="4">   
               <?php endif;
               endforeach; ?>

            </td>
          <?php endif; ?>
           </tr>	
    <?php 
    endforeach;
          ?>
</tbody>
<tfoot>
</tfoot>
</table>

<?php element($b_page . '/liste-variables-etude', ['table_variables' => $table_variables]); ?>

