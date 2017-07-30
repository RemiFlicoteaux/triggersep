/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 14 septembre 2015
 */
jQuery(document).ready(function () {

  /**
   * 
   * OUvrir Popup 
   * 
   * 
   */
    // data-patients
  var links_popup = $('.data-patients');
  var popup = null;
  links_popup.click(function (e) {
    var popup_url = $(this).attr('href');
    e.preventDefault();
    if (popup === null || popup.closed) {
      popup = popupwindow(popup_url);
    } else {
      popup.location.href = popup_url;
    }
    popup.focus();
  });



  /*
  *
  * 
  *
  *
  */
  var recipient;
  var id_etude;
  $('#MyModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  recipient = button.data('whatever') // Extract info from data-* attributes
  id_etude=button.data('id')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Etude : ' + recipient)
  modal.find('.modal-body input').val(recipient)
  $("#link-export").prop('href','./?p=data-patients-export&nom_etude='+recipient+'&id_etude='+id_etude+'&format_export='+$(this).val());
  
});

$("#select_format").change(function(){

    $("#link-export").prop('href','./?p=data-patients-export&nom_etude='+recipient+'&id_etude='+id_etude+'&format_export='+$(this).val());
  
  });

});

