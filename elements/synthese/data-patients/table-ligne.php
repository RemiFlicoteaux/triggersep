<div id="infos-patient">
  <div class="col-md-5">
    <table>
      <thead>
          <?php
            if($catalogue){
            echo "toto";
            print('<tr class="info">');
            for($i=0;$i<count($catalogue);$i++){
              
            print('<th >'.$catalogue[$i]['nom_variable'].'<br>
              '.$data[$catalogue[$i]['nom_variable']].'</th>');
            }
           }
        print('</tr>');?>
      </thead>
      <tbody>
       
      </tbody>
    </table>
  </div>
</div>