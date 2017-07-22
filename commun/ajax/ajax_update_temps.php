<?php


if(isset($_GET['temps']) && isset($_GET['id_var_etude']) ){

  $temp=$_GET['temps'];
  $id_var_etude=$_GET['id_var_etude'];

  $temps = ORM::for_table('variables')->find_one($id_var_etude);
	$temps->temps=$temp;
	$res = $temps->save();
  
  } else {
  header('Location:./');
  exit(1);
}

