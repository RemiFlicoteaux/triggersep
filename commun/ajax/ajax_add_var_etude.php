<?php
/**
 * PHP @version 5.5.12
 * 
 * @author :AOUEY Yesser
 * @date : 23 sept. 2015
 */

if(isset($_GET['variable']) && isset($_GET['libelle']) ){


  $id=$_GET['identifiant'];
  $variable=$_GET['variable'];
  $libelle=$_GET['libelle'];
  $temps=$_GET['temps'];
  $id_etude=$_GET['id_etude'];
  $nom_etude=$_GET['nom_etude'];
  
  
  if($id){
  $cat = ORM::for_table('variables')->where_equal('id',$id)->where_equal('nom_etude')->find_one();
  //$cat = ORM::for_table('catalogue')->find_one($var_cat);
  if($cat == false){
	$cat = ORM::for_table('variables');
	$cat->create();
	$cat->id=$id;
	$cat->variable=$variable;
	$cat->variable_commun=$variable;
	$cat->libelle=$libelle;
	$cat->nom_etude=$nom_etude;
	$cat->temps=$temps;
	//$cat->nom_etude=$unite;
	$res = $cat->save();
	}
  } else { 
	$cat = ORM::for_table('variables');
	$cat->create();
	$cat->id_etude=$id_etude;
	$cat->variable=$variable;
	$cat->libelle=$libelle;
	$cat->nom_etude=$nom_etude;
	$cat->temps=$temps;
	$res = $cat->save();
  }
  
} else {
  header('Location:./');
  exit(1);
}

