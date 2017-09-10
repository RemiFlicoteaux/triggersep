<?php if(!empty($variables_etude)): ?>
    <div>
       <h4>Etape 1 : Choisissez les variables clés</h4>
    </div>
    <div class="row">
        
       <?php switch ($b_format_fichier){ 
               case '1':?>
               <div class="col-md-12">
                   <div class="selectBox">
                       <label>Identifiant Patients : </label>
                     <select id='id_patient'>
                       <option>Selectionez un identifiant</option>
                       <?php foreach ($variables_etude as $variables) :?>
                            <?php if(isset($first_line_tab[$variables['variable']])) :?>
                                <option id="<?=$variables['id'];?>" <?= selected($variables['cle'],'ID_PATIENT')?'selected':'';?>><?=$variables['variable'];?></option>   
                            <?php endif;?>
                       <?php endforeach;?>
                     </select>
                   <label>Date J0 : </label>
                     <select id='date_j0'>
                       <option>Selectionez variable de la date J0</option>
                       <?php foreach ($variables_etude as $variables) :?>
                           <?php if(isset($first_line_tab[$variables['variable']])) :?>
                               <option id="<?=$variables['id'];?>" <?= selected($variables['cle'],'J0')?'selected':'';?>><?=$variables['variable'];?></option>   
                           <?php endif;?>
                       <?php endforeach;?>
                     </select>
                   </div>
              </div>
         <?php break;
               case '2':?>
               <div class="col-md-12">
                   <div class="col-md-2" >
                      <label>Identifiant Patients : </label></div>
                     <select id='id_patient' >
                       <option>Selectionez un identifiant</option>
                       <?php foreach ($variables_etude as $variables) :?>
                             <?php if(isset($first_line_tab[$variables['variable']])) :?>
                           <option id="<?=$variables['id'];?>" <?= selected($variables['cle'],'ID_PATIENT')?'selected':'';?>><?=$variables['variable'];?></option> 
                           <?php endif ;?>
                       <?php endforeach;?>
                     </select>  
                </div>
                <br><br>
              <div class="col-md-12">
                <div class="col-md-2">
                   <label>Date J0 : </label></div>
                     <select id='date_j0'>
                       <option>Selectionez variable de la date J0</option>
                       <?php foreach ($variables_etude as $variables) :?>
                        <?php if(isset($first_line_tab[$variables['variable']])) :?>
                            <option id="<?=$variables['id'];?>" <?= selected($variables['cle'],'J0')?'selected':'';?>><?=$variables['variable'];?></option>   
                           <?php endif ;?>
                           
                       <?php endforeach;?>
                     </select>
               </div>
               <br><br>
               <div class="col-md-12">
                   <div class="col-md-2">
                     <label for="cles">Indicateur de répétion :</label></div>
                     <select id='indicateur_repetition' >
                       <option>Selectionez un variable</option>
                       <?php foreach ($variables_etude as $variables) :?>
                            <?php if(isset($first_line_tab[$variables['variable']])) :?>
                             <option id="<?=$variables['id'];?>" <?= selected($variables['cle'],'IR')?'selected':'';?>><?=$variables['variable'];?></option>   
                           <?php endif ;?>
                       <?php endforeach;?>
                     </select>                 
              </div>
              <br><br>
               <div class="col-md-12">
                   <div class="col-md-2">
                     <label for="cles">Variables non répétées :</label></div>
                     <select class="form-control input-sm" id="cles" name="cles[]" multiple>
                       <?php foreach ($variables_etude as $variables) : ?>
                            <?php if(isset($first_line_tab[$variables['variable']])) :?>
                            <option  id="cle_<?= $variables['id']; ?>" <?= selected($variables['cle'],'CLE')?'selected':'';?> value="<?= $variables['variable']; ?>">
                                <?= $variables['variable']; ?>
                              </option>  
                           <?php endif ;?>
                              
                       <?php endforeach; ?>
                     </select>                  
              </div>    
            <?php break;
                   case '3':?>
                   <div class="col-md-12">
                   <div class="col-md-2" >
                      <label>Identifiant Patients : </label></div>
                     <select id='id_patient' >
                       <option>Selectionez un identifiant</option>
                       <?php foreach ($variables_etude as $variables) :?>
                       <?php if(isset($first_line_tab[$variables['variable']])) :?>
                           <option id="<?=$variables['id'];?>" <?= selected($variables['cle'],'ID_PATIENT')?'selected':'';?>><?=$variables['variable'];?></option>   
                            <?php endif;?>
                       <?php endforeach;?>
                     </select>  
                </div>
                <br><br>
              <div class="col-md-12">
                   <div class="col-md-2">
                     <label for="cles">Date de répétition :</label></div>
                     <select id='indicateur_repetition' >
                       <option>Selectionez un variable</option>
                       <?php foreach ($variables_etude as $variables) :?>
                       <?php if(isset($first_line_tab[$variables['variable']])) :?>
                           <option id="<?=$variables['id'];?>" <?= selected($variables['cle'],'IR')?'selected':'';?>><?=$variables['variable'];?></option>   
                            <?php endif;?>
                       <?php endforeach;?>
                     </select>                 
              </div><br><br>
               <div class="col-md-12">
                   <div class="col-md-2">
                     <label for="cles">Variables non répétées :</label></div>
                     <select class="form-control input-sm" id="cles" name="cles[]" multiple>
                       <?php foreach ($variables_etude as $variables) : ?>
                         <?php if(isset($first_line_tab[$variables['variable']])) :?>
                         <option  id="cle_<?= $variables['id']; ?>" <?= selected($variables['cle'],'CLE')?'selected':'';?> value="<?= $variables['variable']; ?>">
                           <?= $variables['variable']; ?>
                         </option>        
                          <?php endif;?>
                       <?php endforeach; ?>
                     </select>                  
              </div>     
            <?php break;
                  default :?>

            <?php break;
           }
          ?>
   </div>
<?php endif;?>