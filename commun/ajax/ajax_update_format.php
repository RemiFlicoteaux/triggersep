<?php


if(isset($_GET['id_etude']) && isset($_GET['format']) ){

  $id_etude=$_GET['id_etude'];
  $format=$_GET['format'];

  $etude = ORM::for_table('etudes')->find_one($id_etude);
  $etude->format=$format;
  $res = $etude->save();
  
  } else {
  header('Location:./');
  exit(1);
}