<?php if(count($table_variables)!=0):?>
        <div id="div" class="panel panel-primary" resizable="both"  draggable="true" style="position: fixed;top:20%;right: 0%;height:0px;width: 302px;">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" href="#signstopconcepts-collapse" data-toggle="collapse">Variables de l'étude</a>
                </h4>
            </div>
            <div id="signstopconcepts-collapse" class="signstopconcepts-collapse panel-collapse collapse in">
                <select id="select" style="width:300px;overflow:auto;" size="30" multiple="multiple" >
                 <?php for($i=0;$i<count($table_variables);$i++) {?>
                   <option id="<?=$table_variables[$i]['id'];?>" id_etude="<?=$table_variables[$i]['id_etude'];?>" libelle="<?=$table_variables[$i]['libelle'];?>" temps="<?=$table_variables[$i]['temps'];?>" id_var_catalogue="<?=$table_variables[$i]['id_var_catalogue'];?>" value="<?=$table_variables[$i]['variable'];?>" ><?=$table_variables[$i]['variable'];?> : (<?=$table_variables[$i]['libelle'];?>)</option>
                <?php } ?>
                </select>
            </div>
        </div>
<?php endif;?>