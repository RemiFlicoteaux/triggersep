<?php

if(strlen($_FILES['file']['name'])>1 )
{
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if(strtoupper($extension) == 'XLSX' or strtoupper($extension) == 'XLS'){
        $b_extension=true;
        $file_name_destination = pathinfo($_FILES['file']['name'],PATHINFO_FILENAME).'_'.date('Y-m-d H:i:s').'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'],PATH_DATA.$file_name_destination);

        $inputFileType = PHPExcel_IOFactory::identify(PATH_DATA.$file_name_destination);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load(PATH_DATA.$file_name_destination);
        $objPHPExcel->setActiveSheetIndex('0');
        $objWorksheet=$objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow(); 
        $colone1=$objWorksheet->getCellByColumnAndRow(0, 1)->getValue();
        $colone2=$objWorksheet->getCellByColumnAndRow(1, 1)->getValue();
        $colone3=$objWorksheet->getCellByColumnAndRow(2, 1)->getValue();
        $colone4=$objWorksheet->getCellByColumnAndRow(3, 1)->getValue();

        $objPHPExcel->disconnectWorksheets();
        unset($objReader, $objPHPExcel);

        if((strtoupper($colone1)=='VARIABLE' && strtoupper($colone2)=='DESCRIPTION') && (strtoupper($colone4)=='TYPE' && strtoupper($colone3)=='UNITE') )
        {
                $b_noms_colones = true;
                $b_fichier_ok = true;
        }		
    }
    $b_format_fichier = true;
    $table_data = ORM::for_table('catalogue')->where('id_projet',$b_id_projet)->order_by_asc('nom_variable')->find_array(); 
    if(empty($table_data))
    {
            $infos['message'] = 'Aucune donnée dans le catalogue.' ;
        $infos['type'] = 'danger';
    }		
}else{

    $table_data = ORM::for_table('catalogue')->where('id_projet',$b_id_projet)->order_by_asc('nom_variable')->find_array();    
    $infos['message'] = 'Aucun fichier a été séléctionné!' ;
    $infos['type'] = 'danger';

}
