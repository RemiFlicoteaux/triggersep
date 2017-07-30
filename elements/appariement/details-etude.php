<<<<<<< HEAD
<div style class="row" id='file_reader'>
   <form enctype="multipart/form-data" action="./?p=appariement" method="post" id="reader-form">
      <div class="data">
         <div class="row">
            <div class="col-md-12 one">
               <label > Selectioner le fichier de variables :</label>
               <input class="btn btn-default" name="file" type="file" >
                <p style="text-align: center;">
                    <button type="submit"  style="text-align: center;" value="variables" name="file_variables" class="btn btn-success">Upload</button>
                </p>                   
            </div>
            <div id="informations-supplementaire">
               <div class="content">
                  <ul>
                     <li>
                        <span> Format fichier des variables : </span>
                        <a href="./data/format_fichier/fichier_variables.xlsx" target="_black"> Télécharger </a>
                     </li>
                     <li>
                        <span>
                        Nom de l'etude : <b class=""><?= $b_etude['nom_etude']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Description : <b class=""><?= $b_etude['description']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Format : <b class=""><?= $b_etude['format']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Date d'insertion des variables :
                        <b class=""><?= $b_etude['date_creation']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Date de modification :
                        <b class=""><?= $b_etude['date_modification']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nom de Fichier : <b class=""> <?= $b_etude['nom_de_fichier']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nombre de Varaibles : <b class=""> <?= $b_etude['nb_variables']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nom de créateur : <b class=""><?= $b_etude['login']; ?> </b>
                        </span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12 one">
               <label >Sélectionnez le fichier des données</label>
               <input id='input_data' class="btn btn-default" name="file_data" type="file" >                    
               <input style="display: none;" name='etude' value="<?=$b_nom_etude?>"/>
               <input style="display: none;" name='id_etude' value="<?=$b_id_etude?>"/>
				<p style="text-align: center;">
				<button type="submit"  style="text-align: center;" value="data" name="file_data" class="btn btn-primary">Envoyer</button>
				</p>
            </div>
            <div id="informations-supplementaire">
               <div class="content">
                  <ul>
                     <li>
                        <span>
                        Nom de Fichier : <b class=""> <?= $b_historique_data['fichier']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Date de modification :
                        <b class=""><?= $b_historique_data['date_modification']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nombre des Colones :
                        <b class=""><?= $b_historique_data['nb_colone']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nombre des Lignes :
                        <b class=""><?= $b_historique_data['nb_ligne']; ?></b>
                        </span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12">
               <label >Format Fichier des donneés de l'etude :</label>
               <label style="margin-left: 0%"><input type="radio" name="format_fichier" id_etude="<?= $b_etude['id']; ?>" value="1" <?=($b_etude['format']=='1')?'checked':'';?>><a href="<?=PATH_DATA.'format_fichier/format1.xlsx';?>" target="_blank"> Format 1</a></label> 
               <label style="margin-left: 0%"><input type="radio" name="format_fichier" id_etude="<?= $b_etude['id']; ?>" value="2" <?=($b_etude['format']=='2')?'checked':'';?>><a href="<?=PATH_DATA.'format_fichier/format2.xlsx';?>" target="_blank"> Format 2</a></label>
               <label style="margin-left: 0%"><input type="radio" name="format_fichier" id_etude="<?= $b_etude['id']; ?>" value="3" <?=($b_etude['format']=='3')?'checked':'';?>><a href="<?=PATH_DATA.'format_fichier/format3.xlsx';?>" target="_blank">Format3</a></label> 
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
            <label >Format Date</label>
            <input id='format_date' id_etude="<?=$b_id_etude?>" value="<?=$b_format_date?>" name="format_date" type="text" >
            </div>
         </div>
      </div>
   </form>
</div>

=======
<div style class="row" id='file_reader'>
   <form enctype="multipart/form-data" action="./?p=appariement" method="post" id="reader-form">
      <div class="data">
         <div class="row">
            <div class="col-md-12 one">
               <label > Selectionner le fichier de variables :</label>
               <input class="btn btn-default" name="file" type="file" >
                <p style="text-align: center;">
                    <button type="submit"  style="text-align: center;" value="variables" name="file_variables" class="btn btn-success">Envoyer</button>
                </p>                   
            </div>
            <div id="informations-supplementaire">
               <div class="content">
                  <ul>
                     <li>
                        <span> Format fichier des variables : </span>
                        <a href="./data/format_fichier/fichier_variables.xlsx" target="_black"> Télécharger </a>
                     </li>
                     <li>
                        <span>
                        Nom de l'étude : <b class=""><?= $b_etude['nom_etude']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Description : <b class=""><?= $b_etude['description']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Format : <b class=""><?= $b_etude['format']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Date d'insertion des variables :
                        <b class=""><?= $b_etude['date_creation']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Date de modification :
                        <b class=""><?= $b_etude['date_modification']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nom du fichier : <b class=""> <?= $b_etude['nom_de_fichier']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nombre de variables : <b class=""> <?= $b_etude['nb_variables']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Créateur : <b class=""><?= $b_etude['login']; ?> </b>
                        </span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12 one">
               <label >Sélectionnez le fichier de données</label>
               <input id='input_data' class="btn btn-default" name="file_data" type="file" >                    
               <input style="display: none;" name='etude' value="<?=$b_nom_etude?>"/>
               <input style="display: none;" name='id_etude' value="<?=$b_id_etude?>"/>
				<p style="text-align: center;">
				<button type="submit"  style="text-align: center;" value="data" name="file_data" class="btn btn-success">Envoyer</button>
				</p>
            </div>
            <div id="informations-supplementaire">
               <div class="content">
                  <ul>
                     <li>
                        <span>
                        Nom du fichier : <b class=""> <?= $b_historique_data['fichier']; ?> </b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Date de modification :
                        <b class=""><?= $b_historique_data['date_modification']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nombre de colonnes :
                        <b class=""><?= $b_historique_data['nb_colone']; ?></b>
                        </span>
                     </li>
                     <li>
                        <span>
                        Nombre de lignes :
                        <b class=""><?= $b_historique_data['nb_ligne']; ?></b>
                        </span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12">
               <label >Format du fichier des donneés de l'étude :</label>
               <label style="margin-left: 0%"><input type="radio" name="format_fichier" id_etude="<?= $b_etude['id']; ?>" value="1" <?=($b_etude['format']=='1')?'checked':'';?>><a href="<?=PATH_DATA.'format_fichier/format1.xlsx';?>" target="_blank"> Format 1</a></label> 
               <label style="margin-left: 0%"><input type="radio" name="format_fichier" id_etude="<?= $b_etude['id']; ?>" value="2" <?=($b_etude['format']=='2')?'checked':'';?>><a href="<?=PATH_DATA.'format_fichier/format2.xlsx';?>" target="_blank"> Format 2</a></label>
               <label style="margin-left: 0%"><input type="radio" name="format_fichier" id_etude="<?= $b_etude['id']; ?>" value="3" <?=($b_etude['format']=='3')?'checked':'';?>><a href="<?=PATH_DATA.'format_fichier/format3.xlsx';?>" target="_blank">Format3</a></label> 
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
            <label >Format des dates dans le fichier de données : </label>
            <input id='format_date' id_etude="<?=$b_id_etude?>" value="<?=$b_format_date?>" name="format_date" type="text" >
            </div>
         </div>
      </div>
   </form>
</div>

>>>>>>> 27976f6... #fix spell
