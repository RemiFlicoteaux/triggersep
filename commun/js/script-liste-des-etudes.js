/**
 * JavaScript ecmascript 5
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 15 mai 2015
 */
$(document).ready(function () {

    // data-patients
    var links_popup = $('.data-patients');
    var popup = null;
    links_popup.click(function (e) {
        var popup_url = $(this).attr('href');
        e.preventDefault();
        if (popup === null || popup.closed) {
            popup = popupwindow(popup_url, 800, 500);
        } else {
            popup.location.href = popup_url;
        }
        popup.focus();
    });

    


    /**
     * 
     * Modification et suppression des etudes
     * 
     * 
     */

    $('td').on('click', 'span', function () {

        var t = $(this);
        var tr = t.closest("tr");
        if (t.hasClass('glyphicon glyphicon-pencil')) {

            var id_etude = tr.find('td.id_etude').text();
            var nom_etude = tr.find('td.nom_etude a').text();
            var description = tr.find('td.description').text();

            document.getElementById("_id_etude").value = id_etude;
            document.getElementById("nom_etude").value = nom_etude;
            document.getElementById("description").value = description;
            document.getElementById("nom_etude").readOnly = true;
            $("#ajout-etude-modal").modal('show');

        } else if (t.hasClass('glyphicon glyphicon-trash')) {
            if (confirm("Etes vous sûr de vouloir supprimer cette étude ?")) {

                var _id_etude = tr.find('td.id_etude').text();
                var _nom_etude = tr.find('td.nom_etude a').text();
                var _id_projet = $('#_id_projet').val();

                $.getJSON('./?p=ajax_gestion_des_etudes', {
                    nom_etude: _nom_etude,
                    id_etude: _id_etude,
                    id_projet: _id_projet,
                    operation: 'delete'
                }, function (data) {

                    state = !data.error;
                    if (state !== true) {
                        //alert('variable enregistré');
                        //alert(data.message);

                    } else {

                        $('#tr' + _id_etude).remove();
                        location.reload();

                    }

                });
            }
        }

    });


});
