/**
 * JavaScript ecmascript 5
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 15 mai 2015
 */


$(document).ready(function () {
  
  var projets_list = $('tbody tr');
  var id=null;
  var t = null;
  var btnModifier=$('#modifier');
  var message = $('.message');
  var btnNewProjet=$('#new');
  var btnAnnuler=$('#annuler');
  var jumbotron = $('.jumbotron');
  /*var view = $('#informations-utilisateur');
  var module_index = 0;*/

/*
     *
     * Ajout une nouvelle etude
     *
     *
     */

$('tr').on('click','span',function (event) {

  var t = $(this);
  var tr = t.closest("tr")
  var id_projet = tr.find('td.id_projet').text();
  if ($(this).hasClass('glyphicon glyphicon-trash')) {
     if(confirm("Cliquer sur ok pour confirmer la suppression de Projet")){
       $.getJSON('./?p=ajax_gestion_projets', {delete: true, id: id_projet}, function (data) {
                if (data.error === false) {
                  message.children()
                          .removeClass('alert-danger')
                          .addClass('alert-success');

                            location.reload();

                } else {
                  message.children()
                          .removeClass('alert-success')
                          .addClass('alert-danger');
                }


                 message.children()
                        .find('span.message')
                        .text(data.message);
                message
                        .fadeOut(100)
                        .fadeIn(300);
        });
      //location.reload();
    }
  }else if ($(this).hasClass('glyphicon glyphicon-pencil')) {


          var nom_projet = tr.find('td.nom_projet').text();
          var description = tr.find('td.description').text();

          document.getElementById("id_projet").value=id_projet;
          document.getElementById("nom_projet").value=nom_projet ;
          document.getElementById("description").value=description;
          $("#ajout-projet-modal").modal('show');
  }

});

 $('tr .nom_projet').on('click', function() {

  var message = $('.message');
  var _alert = message.find('.alert');
  var body = $("body");
  var tr = $(this).closest("tr")
  var id_projet = tr.find('td.id_projet').text();

  $.getJSON('./?p=ajax_changer_projet', {id_projet : id_projet}, function (data) {
      message.hide();
      if (data.error === false) {
          _alert.removeClass('alert-danger alert-warning');
          _alert.addClass('alert-success');
          window.location.replace ('./?p=synthese');
      } else {
          _alert.removeClass('alert-success alert-warning');
          _alert.addClass('alert-danger');
          reload = false;
      }
      message
              .fadeIn(300)
              .find('span.message')
              .html(data.message);
  })

        message.hide();
        body.css({overflow: 'inherit'});

  });

});

