<?php
/**
 * PHP @version 5.5.12
 * 
 * @author :AOUEY Yesser
 * @date : 23 sept. 2015
 */

if(isset($_GET['variable'])){

  
  $variable=$_GET['variable'];
  $description=$_GET['description'];
  $unite=$_GET['unite'];
  $type=$_GET['type'];
  $operation=$_GET['operation'];
  
  
  if($operation=='insert'){
  	
  	$var = ORM::for_table('catalogue')->where('nom_variable',$variable)->where('id_projet',$b_id_projet)->find_one();

	  if($var == false){
		$var = ORM::for_table('catalogue');
		$var->create();
		$var->id_projet=$b_id_projet;
		$var->nom_variable=$variable;
		$var->description=$description;
		$var->unites=$unite;
		$var->type=$type;
		$res = $var->save();
		}else{

		$b_ajax['error'] = true;
      		$b_ajax['message'] = 'Le nom de variable existe déja!';
		}

  } elseif($operation=='update') {
  	
	  	$id=$_GET['identifiant'];

		$var=ORM::for_table('catalogue')->where('id',$id)->where('id_projet',$b_id_projet)->find_one();
		$var->id_projet=$b_id_projet; 
		$var->nom_variable=$variable;
		$var->description=$description;
		$var->unites=$unite;
		$var->type=$type;
		$res = $var->save();
  
  }else{

	  	$id=$_GET['identifiant'];

	  	$var = ORM::for_table('catalogue')->where('id',$id)->where('id_projet',$b_id_projet)->find_one();
		$var->delete();

  }
  
} else {
  header('Location:./');
  exit(1);
}

