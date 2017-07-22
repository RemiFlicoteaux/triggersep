<?php


if(isset($_GET['id_var']) ){

  $new_id=$_GET['id_var'];

  if($new_id!=''){

    $id_etude = ORM::for_table('variables')->select('id_etude')->where_equal('id',$new_id)->find_one();

    $delete_current_id = ORM::for_table('variables')->where_equal('id_etude',$id_etude['id_etude'])->where_equal('cle','ID_PATIENT')->find_one();
    if(!empty($delete_current_id)):
    $delete_current_id->cle = '';
    $delete_current_id->save();
    endif;

    $insert_new_id = ORM::for_table('variables')->where_equal('id',$new_id)->find_one();
    $insert_new_id->cle= 'ID_PATIENT';
    $res = $insert_new_id->save();
    
    $b_ajax['error'] = false;
    $b_ajax['message'] = 'Mise à jour ID Patient avec succéé';

  }
} else {
  $b_ajax['error'] = true;
  $b_ajax['message'] = 'Erreur selection Id Patient';
}