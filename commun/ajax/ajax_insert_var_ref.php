<?php


if(isset($_GET['id_var_etude']) && isset($_GET['id_var_catalogue']) ){

  $id_var_etude=$_GET['id_var_etude'];
  $id_var_catalogue=$_GET['id_var_catalogue'];
  $id_etude=$_GET['id_etude'];
  $operation=$_GET['operation'];

  if($operation=='insert'){

    $insert = ORM::for_table('variables')->where_equal('id',$id_var_etude)->find_one();
    $insert->id_var_catalogue=$id_var_catalogue;
    $res = $insert->save();


  }else {

    $delete = ORM::for_table('variables')->where_equal('id',$id_var_etude)->find_one();
    $delete->id_var_catalogue=null;
    $res = $delete->save();
  }
} else {
  header('Location:./');
  exit(1);
}

