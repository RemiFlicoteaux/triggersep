<?php



if(isset($_GET['format']) && isset($_GET['id_etude']) ){

  $format=$_GET['format'];
  $id_etude=$_GET['id_etude'];

  $format_date = ORM::for_table('format_date')->find_one($id_etude);dump($format_date);
  	if($format_date){
  		//$format_date->id_etude=$id_etude;
		$format_date->format=$format;
		$format_date->save();
	}else{
		$format_date = ORM::for_table('format_date');
		$format_date->create();
		$format_date->id=$id_etude;
		$format_date->format=$format;
		$res = $format_date->save();
	}
  
  } else {
  header('Location:./');
  exit(1);
}
