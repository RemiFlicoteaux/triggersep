<?php

if (isset($_GET['file_name'])) {

    $nom_fichier = $_GET['file_name'];
    $boutton = $_GET['boutton'];
    $format_fichier_data = isset($_GET['format_fichier_data']) ? $_GET['format_fichier_data'] : '1';
    $nombre_variables_inseres = 0;
    $nombre_variables_updated = 0;
    $nombre_lignes_vides = 0;
    $lettres = array(0 => 'J');

    $inputFileType = PHPExcel_IOFactory::identify(PATH_DATA . $nom_fichier);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load(PATH_DATA . $nom_fichier);
    $objWorksheet = $objPHPExcel->getActiveSheet();

    $highestRow = $objWorksheet->getHighestRow();
    $nom_etude = $_GET['nom_etude'];

    $etude = ORM::for_table('etudes')
            ->where_equal('nom_etude', $nom_etude)
            ->where('id_projet', $b_id_projet)
            ->find_one();

    // Nom variable complet
    if ($boutton == 'update') {
        $r = 0;

        if ($etude) {

            //pourquoi cette requete alors qu'elle vient d'etre faite 10 lignes au dessus ?
            $etude = ORM::for_table('etudes')->where('nom_etude', $nom_etude)->where('id_projet', $b_id_projet)->find_one();
            $etude->nom_etude = $nom_etude;
            $etude->nom_de_fichier = $nom_fichier;
            $etude->format = $format_fichier_data;
            $etude->save();

            for ($row = 3; $row <= $highestRow; $row++) {

                $variable = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                $libelle = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                $unite = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                $type = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
            
                if ($etude['encodage'] == null || $etude['encodage'] === 'ISO-8859-1') {
                    $variable = utf8_encode($variable);
                    $libelle = utf8_encode($libelle);
                }


                $variable_commun = get_variable($variable, $lettres);

                if ($variable or $libelle) {

                    $var = ORM::for_table('variables')
                                    ->where_equal('variable', $variable)
                                    ->where_equal('nom_etude', $nom_etude)->find_one();

                    if ($var == true) {

                        $var->variable = $variable;
                        $var->libelle = $libelle;
                        $var->type = $type;
                        $var->unite = $unite;
                        $var->save();
                        $nombre_variables_updated++;
                    } else {
                        $var = ORM::for_table('variables');
                        $var->create();
                        $var->nom_etude = $nom_etude;
                        $var->id_etude = $etude->id;
                        $var->variable = $variable;
                        $var->libelle = $libelle;
                        $var->type = $type;
                        $var->unite = $unite;
                        $var->variable_commun = $variable_commun['var_comm'];
                        if ($format_fichier_data == "1") {
                            $var->temps = $variable_commun['temps'];
                        }
                        $var->save();
                        $nombre_variables_inseres++;
                    }
                } else {
                    $nombre_lignes_vides++;
                }
            }
            $etude->nb_variables = $nombre_variables_inseres + $nombre_variables_updated;
            $etude->save();
            $b_ajax['message'] = "Les données ont été mises à jour.";
            $b_ajax['message'] .= "<br>";
            $b_ajax['message'] .= " Nombre de variables inserées : " . $nombre_variables_inseres;
            $b_ajax['message'] .= "<br>";
            $b_ajax['message'] .= " Nombre de variables mises à jour : " . $nombre_variables_updated;
            $b_ajax['message'] .= "<br>";
            $b_ajax['message'] .= " Nombre de lignes vide : " . $nombre_lignes_vides;
            $b_ajax['error'] = false;
        }
    } else {

        $etude = ORM::for_table('etudes')->where('nom_etude', $nom_etude)->where('id_projet', $b_id_projet)->find_one();
        $etude->nom_etude = $nom_etude;
        $etude->nom_de_fichier = $nom_fichier;
        $etude->format = $format_fichier_data;
        $etude->save();

        $variables = ORM::for_table('variables')->where('id_etude', $etude['id'])->delete_many();
        $fichiers_donnees = ORM::for_table('historique_data')->where('id_etude', $etude['id'])->delete_many();

        $cn = new MongoClient();
        $db = $cn->selectDB("bd_patients");
        $collection = $db->selectCollection('Patients');
        $collection->remove(array('nom_etude' => $etude['id']));
        ORM::for_table('variables')
                ->where_equal('nom_etude', $nom_etude)->delete_many();


        for ($row = 3; $row <= $highestRow; $row++) {

            $variable = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
            $libelle = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
            $unite = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
            $type = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
            $variable_commun = get_variable($variable, $lettres);

            if ($etude['encodage'] == null || $etude['encodage'] === 'ISO-8859-1') {
                $variable = utf8_encode($variable);
                $libelle = utf8_encode($libelle);
            }

            if ($variable or $libelle) {

                $var = ORM::for_table('variables')
                                ->where_equal('variable', $variable)
                                ->where_equal('nom_etude', $nom_etude)->find_one();

                if ($var == true) {

                    $var->variable = $variable;
                    $var->libelle = $libelle;
                    $var->type = $type;
                    $var->unite = $unite;
                    $var->save();
                    $nombre_variables_updated++;
                } else {
                    $var = ORM::for_table('variables');
                    $var->create();
                    $var->nom_etude = $nom_etude;
                    $var->id_etude = $etude->id;
                    $var->variable = $variable;
                    $var->libelle = $libelle;
                    $var->type = $type;
                    $var->unite = $unite;
                    $var->variable_commun = $variable_commun['var_comm'];
                    if ($format_fichier_data == "1") {
                        $var->temps = $variable_commun['temps'];
                    }
                    $var->save();
                    $nombre_variables_inseres++;
                }
            } else {
                $nombre_lignes_vides++;
            }
        }
        $etude->nb_variables = $nombre_variables_inseres + $nombre_variables_updated;
        $etude->save();
        $b_ajax['message'] = "Les données ont été insérées.";
        $b_ajax['message'] .= "<br>";
        $b_ajax['message'] .= " Nombre de variables inserées : " . $nombre_variables_inseres;
        $b_ajax['message'] .= "<br>";
        $b_ajax['message'] .= " Nombre de variables mises à jour : " . $nombre_variables_updated;
        $b_ajax['message'] .= "<br>";
        $b_ajax['message'] .= " Nombre de lignes vide : " . $nombre_lignes_vides;
        $b_ajax['error'] = false;
    }
} else {
    $b_ajax['message'] = "Erreur d'insertion :";
    $b_ajax['error'] = true;
}

