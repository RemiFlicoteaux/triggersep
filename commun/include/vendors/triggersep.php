<?php

class Model_Document_Collection extends Mongo_Collection {
  protected $name = 'Patients';
  protected $db = 'Triggersep';
}


class Model_Document extends Mongo_Document {
  protected $_references = array(
      'other'=>'',
      'other' => array('model' => 'other'),
      'lots'  => array('model'    => 'other', 'field'    => '_lots', 'multiple' => TRUE)
  );
}
/* Table Data Gateway Pattern */
class Model_New_Other extends Mongo_Document {

  protected $db = 'Triggersep';
  protected $_searches = array(
      'docs' => array('model' => 'document', 'field' => '_other'),
  );
}
