<div id="triggersep">
    <div class='appariement'>  
        <div class="container-fluid">
            <div class="title">
                <h3><?php echo get_projet_name_by_id($b_id_projet) ?> </h3>

            </div>
            <div>
                <?php if ($nom_etude): ?>  
                    <div class="info">
                        <div ><h3> Détails de l'étude <?php echo $nom_etude ?></h3></div>

                        <ul class="nav">
                            <li class="<?= $allowed_step[1] ? ($get_etape == 1 ? 'active' : null) : 'disabled'; ?>"><a href="./?<?= make_query_string(['etape' => 1]); ?>">Détails de l’étude</a></li>
                            <li class="<?= $allowed_step[2] ? ($get_etape == 2 ? 'active' : null) : 'disabled'; ?>"><a href="./?<?= make_query_string(['etape' => 2]); ?>">Variables de l'étude</a></li>
                            <li class="<?= $allowed_step[3] ? ($get_etape == 3 ? 'active' : null) : 'disabled'; ?>"><a href="./?<?= make_query_string(['etape' => 3]); ?>">Appariement catalogue / variables études</a></li>
                            <li class="<?= $allowed_step[4] ? ($get_etape == 4 ? 'active' : null) : 'disabled'; ?>"><a href="./?<?= make_query_string(['etape' => 4]); ?>">Insertion des données</a></li>
                        </ul>

                    </div> 

                    <br/>

                    <div id="steps">
                        <div id="step-<?= $get_etape; ?>">
                            <?php
                            switch ($get_etape) {
                                case 1:
                                    $id = 'details-etude';
                                    $element = 'details-etude';
                                    $element_vars = [
                                        'b_etude' => $etude,
                                        'b_nom_etude' => $nom_etude,
                                        'b_historique_data' => $historique_data,
                                        'b_format_fichier' => $format_fichier_data,
                                        'b_variables_etude' => $variables_etude,
                                        'b_id_etude' => $id_etude,
                                        'variables_etude' => $variables_etude,
                                        'b_format_date' => $format_date['format']
                                    ];
                                    break;
                                case 2:
                                    $id = 'insertion-variables-etude';
                                    $element = 'gestion-variables-etude';
                                    $element_vars = [
                                        'etude' => $etude,
                                        'b_page' => $b_page,
                                        'liste_etudes' => $liste_etudes,
                                        'id_projet' => $b_id_projet,
                                        'b_nom_etude' => $nom_etude,
                                        'variables_etude' => $variables_etude,
                                    ];
                                    break;
                                case 3:
                                    $id = 'appariemnt-variable';
                                    $element = 'table-data';
                                    $element_vars = [
                                        'b_page' => $b_page,
                                        'etude' => $etude,
                                        'format_fichier_data' => $format_fichier_data,
                                        'table_data' => $etude_data_final_tab,
                                        'table_data_count' => $table_data_count,
                                        'b_nom_etude' => $nom_etude,
                                        'b_id_etude' => $id_etude,
                                        'b_format_fichier' => $format_fichier_data,
                                        'infos' => $infos,
                                        'variables_etude' => $variables_etude,
                                        'table_variables' => $table_variables,
                                        'id_projet' => $b_id_projet,
                                        'b_etude' => $etude,
                                    ];
                                    break;
                                case 4:
                                    $id = 'insertion-data-etude';
                                    $element = 'insertion-data-etude';
                                    $element_vars = [
                                        'etude' => $etude,
                                        'historique_data' => $historique_data,
                                        'b_page' => $b_page,
                                        'b_nom_etude' => $nom_etude,
                                        'id_projet' => $b_id_projet,
                                        'b_id_etude' => $id_etude,
                                    ];
                                    break;
                            }
                            ?>

                            <div class="container-fluid" id="<?= $id ?>">
                                <?php element($b_page . '/' . $element, $element_vars); ?>   
                            </div>
                        </div>
                    </div>



                    <div class="panel-body">


                        <!-- POPIN_VERIFICATION ET MISE AJOUR VARIABLES ETUDE -->
                        <?php
                        if ($b_format_fichier == true):
                            element($b_page . '/popin-verification-fichier-variables', [
                                'b_extension' => $extension,
                                'b_noms_colones' => $b_noms_colones,
                                'etude' => $etude,
                                'file_name_destination' => $file_name_destination
                            ]);
                            ?>
                            <script>
                                popin_fichier_variables('popin',<?php echo $b_fichier_ok ? 1 : 0; ?>,<?php echo $format_fichier_data; ?>,<?php echo "'" . $_nom_etude . "'"; ?>);
                            </script>
                        <?php endif; ?> 

                        <!-- POPIN_VERIFICATION ET MISE AJOUR DATA -->
                        <?php
                        if ($extension_fichier_data):
                            element($b_page . '/popin-verification-fichier-data', [
                                'b_extension' => $extension_fichier_data,
                                'available_variables' => $available_variables,
                                'missing_variables' => $missing_variables,
                                'file_name_destination' => $file_name_destination,
                                'id_projet' => $b_id_projet,
                                'nom_etude' => $nom_etude,
                                'separateur' => $separateur,
                                'b_etude' => $etude,
                            ]);
                            ?>
                            <script>
                                popin_fichier_data('popin',<?php echo $b_fichier_ok ? 1 : 0; ?>,<?php echo $extension_fichier_data ? 1 : 0; ?>);
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($infos['message']) : ?>
                <div class="container-fluid">
                    <?php display_template_message('alert', $infos['message'], $infos['type']); ?>
                </div> 
                <?php
            endif;
        endif;
        ?> 
    </div>   
</div>

