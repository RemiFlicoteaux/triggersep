<?php

/**
 * PHP @version 5.5.12
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 13 mai 2015
 */
//utilisateurs
$Projets = ORM::for_table($b_table_projets)
        ->order_by_desc('id')
        ->find_array();
for($i=0;$i<count($Projets);$i++){

	$Projets[$i]['nombre_etudes']=ORM::for_table('etudes')->where('id_projet',$Projets[$i]['id'])->count();
}