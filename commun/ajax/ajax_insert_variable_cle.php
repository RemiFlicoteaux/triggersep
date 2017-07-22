<?php

if(isset($_GET['id_variable']) && isset($_GET['operation']) ){

  $id_variable=substr($_GET['id_variable'],4);
  $operation=$_GET['operation'];

  if($operation == 'delete'){

    $delete_current_id = ORM::for_table('variables')->where_equal('id',$id_variable)->find_one();
    $delete_current_id->cle = '';
    $res = $delete_current_id->save();
    
    $b_ajax['error'] = false;
    $b_ajax['message'] = 'Clé supprimé';

  }elseif($operation == 'insert') {

    $insert_new_id = ORM::for_table('variables')->where_equal('id',$id_variable)->find_one();
    $insert_new_id->cle = 'CLE';
    $res = $insert_new_id->save();
    
    $b_ajax['error'] = false;
    $b_ajax['message'] = 'Clé ajouté';
  }
} else {
  $b_ajax['error'] = true;
  $b_ajax['message'] = 'Erreur selection Id Patient';
}