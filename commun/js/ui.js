/**
 * JavaScript ecmascript 5
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 22 avr. 2015
 * 
 * tous ce qui concerne l'interface utilisateur generale doit se trouver ici (jQueryUI datapicker, modules Bootstrap...)
 */


jQuery(document).ready(function () {

  //s element script 
  $('script.rm').remove();
  //e element script
  //s disconnect time
  var disconnect_time = {
    timer_sec: $('#disconnect-time span.logout-time'),
    min_symb: 'M',
    sec_symb: 's',
    deconnection_msg: 'Déconnexion...',
    body_content: $('body'),
    interval: 1000,
    display: function () {
      this.timer_sec
              .delay(this.interval)
              .fadeIn(100);
    },
    format_time: function (time) {
      return time < 10 ? '0' + time : time;
    },
    display_timer: function () {

      var self = this;
      var total_seconds = +self.timer_sec.text();
      var min = total_seconds >= 60 ? (total_seconds / 60) - 1 : 0;
      var sec = 59;
      var format_min = '';
      var format_sec = '';

      self.display();
      if (self.timer_sec.length > 0) {
        var interval = setInterval(function () {

          if (min >= 0) {

            format_min = self.format_time(min);
            format_sec = self.format_time(sec);
            self.timer_sec.text(format_min + ' : ' + format_sec);

            if (sec === 0) {
              sec = 60;
              min--;
            }
            sec--;
          } else {
            self.timer_sec.text(self.deconnection_msg);
            self.body_content.empty();
            $('script').remove();
            $('body').load('./?p=lock');
            clearInterval(interval);
          }
        }, self.interval);
      }

    }
  };
  disconnect_time.display_timer();
  //e disconnect time
  
  //s tooltip
  $('[data-toggle="tooltip"]').tooltip();
  //e tooltip

  //s datatable
  //desactive les messages d'erreur sous forme d'alerte et les affiches dans la console
  $.fn.dataTableExt.sErrMode = 'throw';

  var dt = {};
  dt.language_fr = {
    "sProcessing": "Traitement en cours...",
    "sSearch": "Rechercher&nbsp;:",
    "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
    "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
    "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
    "sInfoPostFix": "",
    "sLoadingRecords": "Chargement en cours...",
    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
    "oPaginate": {
      "sFirst": "Premier",
      "sPrevious": "Pr&eacute;c&eacute;dent",
      "sNext": "Suivant",
      "sLast": "Dernier"
    },
    "oAria": {
      "sSortAscending": ": activer pour trier la colonne par ordre croissant",
      "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
    }
  };
  dt.init_data_table = {
    language: dt.language_fr
  };
  
  dt.init_data_table_logs = {
    scrollCollapse: true,
    scrollY: dt.height - 50,
    paging: true,
    ajax: {
      url: "./?p=ajax_utilisateur_get_logs",
      type: "POST"
    },
    processing: true,
    serverSide: true,
    lengthMenu: [[100, 200, 300, 500, 1000], [100, 200, 300, 500, 1000]],
    order: [[3, "desc"]]
  };
  
  dt.init_data_table_gestion_variables={
    paging: true,
    bAutoWidth: true,
    bInfo: true,
    bSort: false,
    searching: false,
    lengthMenu: [[20, 50, 100,200,500], [20, 50, 100,200,500]],
    order: [[1, "asc"]]
  };
  
  dt.init_data_table_appariement={
    paging: true,
    bAutoWidth: true,
    bInfo: true,
    bSort: false,
    searching: true,
    lengthMenu: [[20, 50, 100,200,500], [20, 50, 100,200,500]],
    order: [[1, "asc"]]
  };
  
  dt.log_object = {};
  $.extend(dt.log_object, dt.init_data_table, dt.init_data_table_logs);
  $('#data-table-logs').DataTable(dt.log_object);
  
  dt.gestion_variables_object = {};
  $.extend(dt.gestion_variables_object, dt.init_data_table, dt.init_data_table_gestion_variables);
  $('#data-table-gestion-variables').DataTable(dt.gestion_variables_object);
  
  /*dt.appariement_object = {};
  $.extend(dt.appariement_object, dt.init_data_table, dt.init_data_table_appariement);
  $('#ata-table-appariement').DataTable(dt.appariement_object);*/
  //e datatable

  //s changer projet
    var changer_projet_opener = $('#changer-projet-opener');
    var changer_projet = $('#changer-projet');
    var form_changer_projet = changer_projet.find('form');
    var message = $('#changer-projet #message');
    var alert = message.find('.alert');
    var reload = false;
    var body = $("body");

    changer_projet_opener.click(function (e) {
        e.preventDefault();
        changer_projet.dialog({
            title: 'Changer de Projet',
            width: 400,
            position: {my: "center center-100%"},
            resizable: false,
            modal: true,
            open: function () {
                body.css({overflow: 'hidden'});
            },
            close: function () {
                if (reload) {
                    
                    window.location.replace ('./?p=catalogue');
                }
                message.hide();
                body.css({overflow: 'inherit'});
            },
            buttons: {
                "Valider": function () {
                    var data = form_changer_projet.serialize();
                    $.getJSON('./?p=ajax_changer_projet', {data: data}, function (data) {
                        message.hide();
                        if (data.error === false) {
                            data.message += '<br> Veuillez fermer cette fenêtre pour appliquer la modification.';
                            alert.removeClass('alert-danger alert-warning');
                            alert.addClass('alert-success');
                            reload = true;
                        } else {
                            alert.removeClass('alert-success alert-warning');
                            alert.addClass('alert-danger');
                            reload = false;
                        }
                        message
                                .fadeIn(300)
                                .find('span.message')
                                .html(data.message);
                    })
                            .error(function () {
                                alert.removeClass('alert-success alert-danger');
                                alert.addClass('alert-warning');
                                reload = false;
                                message
                                        .fadeIn(300)
                                        .find('span.message')
                                        .text('Une erreur s\'est produite merci de réessayer');
                            });
                },
                "Fermer": function () {
                    $(this).dialog("close");
                }
            }
        });
    });
    //e changer projet

    //s ajouter projet
    var ajouter_projet_opener = $('#ajouter-projet-opener');
    var ajouter_projet = $('#ajouter-projet');
    var form_ajouter_projet = ajouter_projet.find('form');
    var message2 = $('#ajouter-projet #message');
    var alert = message2.find('.alert');
    var reload = false;
    var body = $("body");

    ajouter_projet_opener.click(function (e) {
        e.preventDefault();
        ajouter_projet.dialog({
            title: 'Ajouter Projet',
            width: 600,
            position: {my: "center center-100%"},
            resizable: false,
            modal: true,
            open: function () {
                body.css({overflow: 'hidden'});
            },
            close: function () {
                if (reload) {
                    
                    window.location = window.location.href.replace(/&s=1/, '');
                }
                message2.hide();
                body.css({overflow: 'inherit'});
            },
            buttons: {
                "Valider": function () {
                    var data = form_ajouter_projet.serialize();
                    $.getJSON('./?p=ajax_ajouter_projet', {data: data}, function (data) {
                        message2.hide();
                        if (data.error === false) {
                            data.message2 += '<br> Veuillez fermer cette fenêtre pour appliquer la modification.';
                            alert.removeClass('alert-danger alert-warning');
                            alert.addClass('alert-success');
                            reload = true;
                        } else {
                            alert.removeClass('alert-success alert-warning');
                            alert.addClass('alert-danger');
                            reload = false;
                        }
                        message2
                                .fadeIn(300)
                                .find('span.message')
                                .html(data.message2);
                    })
                            .error(function () {
                                alert.removeClass('alert-success alert-danger');
                                alert.addClass('alert-warning');
                                reload = false;
                                message2
                                        .fadeIn(300)
                                        .find('span.message')
                                        .text('Une erreur s\'est produite merci de réessayer');
                            });
                },
                "Fermer": function () {
                    $(this).dialog("close");
                }
            }
        });
    });
    //e ajouter projet

});

