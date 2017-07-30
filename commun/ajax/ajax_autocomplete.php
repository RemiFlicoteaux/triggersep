<?php
if(isset($_GET['term'])){
	
$term=$_GET['term'];
$id_etude=$_GET['id_etude'];
if(is_numeric($term))
$b_ajax['results']=ORM::for_table('variables')->raw_query('SELECT * FROM variables WHERE  variables.id_etude="'.$id_etude.'" AND id LIKE "%'.$term.'%" AND variables.id_var_catalogue is NULL')->find_array();	
else
//$b_ajax['results']=ORM::for_table('etudes')->select('id')->select('id_etude')->select('variable')->select('libelle')->select('temps')->where_like('variable',$term.'%')->where('id_etude',$id_etude)->where_null('id_var_catalogue')->order_by_asc('variable')->distinct()->find_array();
$b_ajax['results']=ORM::for_table('variables')->raw_query('SELECT * FROM variables WHERE  variables.id_etude="'.$id_etude.'" AND variable LIKE "%'.$term.'%" AND variables.id_var_catalogue is NULL ORDER BY variable ASC')->find_array();
}
