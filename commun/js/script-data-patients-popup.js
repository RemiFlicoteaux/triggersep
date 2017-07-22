/**
 * JavaScript ecmascript 5
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 12 Octobre 2015
 */

jQuery(document).ready(function () {


/*
*	data table bouton export
*
*
**/

	$('#data-table-synthese').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	
  /* $('#var_exist').blur(function (){
		
		var _variable = $(this).val();
		
		$.getJSON($(this).attr('data-link'), {component: _variable}
		, function (data) {
		if(data.results===''){
			$("button[type=submit]").removeAttr("disabled");
		}else{	
		$.map(data.results, function (item) {
		
		
			alert('variable existe');
			$("button[type=submit]").attr("disabled","disabled");
			
		});
		
		   }			  
			
		});	
		
	});*/
		
});
