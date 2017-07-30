<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 13 février 2017 */
//utilisateurs

$etudes = ORM::for_table($b_table_etudes)
        ->where('id_projet', $b_id_projet)
        ->order_by_desc('id')
        ->find_array();
for ($i = 0; $i < count($etudes); $i++) {
    $etudes[$i]['nombre_variables'] = ORM::for_table('variables')->where('id_etude', $etudes[$i]['id'])->count();
}
?>