<?php


if(isset($_GET['id_var_etude']) && isset($_GET['id_parent']) ){

  $id_var_fils=$_GET['id_var_etude'];
  $id_parent=$_GET['id_parent'];
  $id_etude=$_GET['id_etude'];
  $operation=$_GET['operation'];




      if($operation=='delete_one'){

        $delete = ORM::for_table('mapping')->find_one($id_var_fils)->delete();
        $delete->save();

      }elseif($operation=='delete'){

        $delete = ORM::for_table('mapping')->where('id_var_parent',$id_parent)->where('id_etude',$id_etude)->delete_many();

      }
      elseif($operation=='insert'){
        $insert = ORM::for_table('mapping');
        $insert->create();
         $insert->id=$id_var_fils;
          $insert->id_var_parent=$id_parent;
          $insert->id_etude=$id_etude;
  	$res = $insert->save();
    } 


    }else {
      header('Location:./');
    exit(1);
  }

