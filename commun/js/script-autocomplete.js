
$(function () {
	/**
	 *AUTO COMPLET
	 * 
	 */
	$('.classinput').each(function() {
		
	  critbox = $(this).attr("id");	 
	   $('#'+critbox).each(function () {
		
		  var _t=$(this);
		  critbox = $(this).attr("id");
		  	       
	        _t.autocomplete({
				
	            delay: 100,
	            source: function (request, response) { 
	                $.getJSON(_t.attr('data-link'), {term: request.term},
	                function (data) {
	                	$('#select').remove();
						$('#signstopconcepts-collapse').html('<select id="select" style="width: 280px;" size="30" multiple="multiple" ></select>');
						//alert(data.toSource());
	                    $.map(data.results, function (item) {
							
						$('#select').append('<option id="'+item.id+'" id_etude="'+item.id_etude+'" libelle="'+item.libelle+'" temps="'+item.temps+'" id_var_catalogue="'+_t.attr("id")+'" value="'+item.variable+'" >'+item.variable+' : ('+item.libelle+')</option>');
	                    });                  
	           		 });	
	         	},

	        });
	 	});
	});
});


	
