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

    var txtbox;
    var prevbox;

    $('tr').on('click', 'span', function () {

        if ($(this).attr('id_var_ref')) {
            var _id_var_catalogue = $(this).attr('id_var_ref');
            var _id_var_etude = $(this).attr('id_var_etude');
            var _id_etude = $(this).attr('id_etude');

            $.getJSON('./?p=ajax_insert_var_ref', {
                id_var_catalogue: _id_var_catalogue,
                id_etude: _id_etude,
                id_var_etude: _id_var_etude,
                operation: 'delete'
            }, function (data) {

                state = !data.error;
                if (state !== true) {
                    //alert('variable enregistré');
                    alert(data.message);
                } else {


                }
            });

            $('#var' + _id_var_etude).detach();
            var _first = $("#div" + _id_var_catalogue + " input:first").attr('id');
            if (!(_first)) {
                $('#libelle' + _id_var_catalogue).detach();
            }
            $('#var' + _id_var_etude).detach();
            $('#temps' + _id_var_etude).detach();
            $(this).detach();
        }

    });

    /*
     *
     * Modifier le temps
     *
     */

    $('.temps').on('keyup', 'input', function () {

        var _temps = $(this).val();
        var _id = $(this).attr('idvar');
        $.getJSON('./?p=ajax_update_temps', {
            temps: _temps,
            id_var_etude: _id
        }, function (data) {

            state = !data.error;
            if (state !== true) {
                //alert('variable enregistré');
                alert(data.message);
            }

        });
    });

    /*
     *
     * Modifier le temps
     *
     */

    $('#format_date').on('keyup', function () {

        var _format = $(this).val();
        var _id = $(this).attr('id_etude');
        $.getJSON('./?p=ajax_update_format_date', {
            format: _format,
            id_etude: _id
        }, function (data) {

            state = !data.error;
            if (state !== true) {
                //alert('variable enregistré');
                alert(data.message);
            }

        });
    });


    /* *
     *
     *
     */
    $("#div").draggable();
    /*
     *
     *
     */

    $('.classinput').focusin(function () {

        prevbox = $(this);
        txtbox = $(this);
        $.getJSON(txtbox.attr('data-link'), {
            term: '__'
        }, function (data) {
            $('#select').remove();
            $('#signstopconcepts-collapse').html('<select id="select" style="width: 280px;" size="30" multiple="multiple" ></select>');
            //alert(data.toSource());
            $.map(data.results, function (item) {

                $('#select').append('<option id="' + item.id + '" id_etude="' + item.id_etude + '" libelle="' + item.libelle + '" temps="' + item.temps + '" value="' + item.variable + '" >' + item.variable + ' : (' + item.libelle + ')</option>');


            });


        });


    });


    $('.panel').on('click', '#select :selected', function () {

        if ($(this).val() !== null && txtbox.attr('id')) {

            var _var_etude = $(this).val();
            var _id_var_etude = $(this).attr('id');
            var _libelle = $(this).attr('libelle');
            var _temps = $(this).attr('temps');
            var _id_etude = $(this).attr('id_etude');
            var _id_var_cat = txtbox.attr('id');

            txtbox.val('');

            $.getJSON('./?p=ajax_insert_var_ref', {
                id_var_catalogue: _id_var_cat,
                id_var_etude: _id_var_etude,
                id_etude: _id_etude,
                operation: 'insert'
            }, function (data) {

                state = !data.error;
                if (state !== true) {
                    //alert('variable enregistré');
                    //alert(data.message);
                } else {

                    $('#div' + _id_var_cat).append('<input id="var' + _id_var_etude + '" type="text" style="border:0px;width:90%" class="classinput" value=' + _var_etude + '>&nbsp;<span style="color:red" id="' + _id_var_etude + '" id_var_ref="' + _id_var_cat + '" id_var_etude="' + _id_var_etude + '" class="glyphicon glyphicon-remove" ></span>');
                    $('#long_name' + _id_var_cat).html("<div class='libelle'><libelle id='libelle" + _id_var_cat + "' class='infobulle'><img src='./commun/images/info.png'><span> <description>" + _libelle + "</description></span></libelle></div>");
                    $('#temp' + _id_var_cat).append('<input style="border:0px;" id="temps' + _id_var_etude + '" idvar="' + _id_var_cat + '" value="' + _temps + '" type="textbox"  size="4">');
                    $("#select option[value=\"" + _var_etude + "\"]").remove();
                    txtbox.val();
                }

            });


            //document.getElementById('div').style.display='none';

        }


    });

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

    /*
     *
     * Ajout une nouvelle etude
     *
     *
     */
    var div_new_etude = $("#ajout-etude-modal");
    $("#nouvelle_etude").change(function () {

        if ($(this).val() === 'NOUVELLE ETUDE') {
            document.getElementById("ajout-etude-modal").style.display = 'block';
        } else {
            document.getElementById("ajout-etude-modal").style.display = 'none';
        }

    });


    // Multiselect Variables Cles

    var cles = $('#cles');
    var variable = cles.find('option');

    cles.multiselect({
        numberDisplayed: 1,
        includeSelectAllOption: false,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonContainer: '<div id="select-multiple-cles" />',
        filterPlaceholder: 'Rechercher',
        buttonTitle: function () {
            return null;
        },
        onChange: function (element, checked) {
            var current_value = element.val();
            var all_selected_cles = [];
            var detached_elements = [];
            var message = $('.appariement .message');

            $('ul.multiselect-container li').each(function () {
                var t = $(this);
                var input = t.find('input');
                var input_value = input.val();
                var is_checked = t.hasClass('active');

                if (input_value === current_value) {
                    if (checked) {
                        $.getJSON('./?p=ajax_insert_variable_cle', {
                            operation: 'insert',
                            id_variable: element.attr('id')
                        }, function (data) {

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
                        t.addClass('active');
                    } else {
                        $.getJSON('./?p=ajax_insert_variable_cle', {
                            operation: 'delete',
                            id_variable: element.attr('id')
                        }, function (data) {

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
                        t.removeClass('active');
                        all_selected_cles.pop(input_value);
                    }
                    input.prop('checked', checked);
                }

                if (is_checked) {
                    all_selected_cles.push(input_value);
                }
            });
        },
        buttonText: function (options) {
            if (options.length === 0) {
                return 'Choisir un ou plusieurs cles';
            } else {
                return options.length + ' Cle' + (options.length > 1 ? 's' : '');
            }
        }
    });
    cles.multiselect('select', 1);

    // Selection Variable ID_PATIENT

    var id_patient = $('#id_patient');
    var _current_id = $('#id_patient').find('option:selected').attr('id');
    id_patient.on('change', function () {
        var message = $('.appariement .message');
        $.getJSON('./?p=ajax_insert_variable_id_patient', {
            id_var: $(this).find('option:selected').attr('id')
        }, function (data) {

            if (data.error === false) {
                message.children()
                        .removeClass('alert-danger')
                        .addClass('alert-success');
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

            location.reload();
        });
    });

    // Selection Variable Date J0

    var id_variable_j0 = $('#date_j0');

    id_variable_j0.on('change', function () {
        var message = $('.appariement .message');
        $.getJSON('./?p=ajax_insert_variable_datej0', {
            id_var: $(this).find('option:selected').attr('id')
        }, function (data) {

            if (data.error === false) {
                message.children()
                        .removeClass('alert-danger')
                        .addClass('alert-success');
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
            location.reload();
        });

    });

    // Selection Variable Date J0

    var id_variable_indicateur = $('#indicateur_repetition');

    id_variable_indicateur.on('change', function () {
        var message = $('.appariement .message');
        $.getJSON('./?p=ajax_insert_indicateur_repetition', {
            id_var: $(this).find('option:selected').attr('id')
        }, function (data) {

            if (data.error === false) {
                message.children()
                        .removeClass('alert-danger')
                        .addClass('alert-success');
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
            location.reload();
        });

    });

    //e Handelbars helper


    // s format fichier des données
    $("input[name=format_fichier]:radio").click(function () {

        var _format = $(this).val();
        var _id_etude = $(this).attr('id_etude');
        $.getJSON('./?p=ajax_update_format', {
            format: _format,
            id_etude: _id_etude
        }, function (data) {

            if (data.error === false) {
                location.reload();

            } else {

            }
        });
    });
    //e format fichier des données


    var insertion_data_etude_loader = $('#insertion-data-etude-loader');
    var Inserer = $('.appariement button[name="Inserer"]');

    insertion_data_etude_loader.hide();
    Inserer.click(function () {
        $(this).prop('disabled', true);
        insertion_data_etude_loader.show();
    });
});

function popin_fichier_variables(div, b_traitement, _format_fichier_data, _nom_etude) {

    var message = $('#popin .message');
    var msg_traitement = 'msg-traitement';
    var nom_etude = _nom_etude;
    $("#" + div).dialog({
        resizable: false,
        height: "auto",
        width: 700,
        modal: true
    });
    var myButtons = {
        "Insertion et Mise à jour": function () {
            var _file_name = $("#file_name").val();

            $.getJSON('./?p=ajax_insert_update_variables_etude', {
                boutton: 'update',
                file_name: _file_name,
                format_fichier_data: _format_fichier_data
            }, function (data) {

                if (data.error === false) {
                    message.children()
                            .removeClass('alert-danger')
                            .addClass('alert-success');
                } else {
                    message.children()
                            .removeClass('alert-success')
                            .addClass('alert-danger');
                }
                var myButtons = {
                    Fermer: function () {
                        window.location.replace("./?p=appariement&nom_etude=" + nom_etude);
                        $(this).dialog("close");
                        //$(location).attr('href', './?p=appariement')
                    }
                };
                $("#" + div).dialog('option', 'buttons', myButtons);
                document.getElementById(msg_traitement).style.display = 'none';
                message.children()
                        .find('span.message')
                        .html(data.message);
                message
                        .fadeOut(100)
                        .fadeIn(300);
            });
        },
        "Suppression et Insertion": function () {
            var _file_name = $("#file_name").val();

            $.getJSON('./?p=ajax_insert_update_variables_etude', {
                boutton: 'delete',
                file_name: _file_name,
                format_fichier_data: _format_fichier_data
            }, function (data) {

                if (data.error === false) {
                    message.children()
                            .removeClass('alert-danger')
                            .addClass('alert-success');
                } else {
                    message.children()
                            .removeClass('alert-success')
                            .addClass('alert-danger');
                }
                var myButtons = {
                    Fermer: function () {
                        window.location.replace("./?p=appariement&nom_etude=" + nom_etude);
                    }
                };
                $("#" + div).dialog('option', 'buttons', myButtons);
                document.getElementById(msg_traitement).style.display = 'none';
                message.children()
                        .find('span.message')
                        .html(data.message);
                message
                        .fadeOut(100)
                        .fadeIn(300);
            });
        },
        Annuler: function () {
            window.location.replace("./?p=appariement&nom_etude=" + nom_etude);
            //$(this).dialog("close");
        }
    };

    if (b_traitement === 0) {
        var myButtons = {
            Fermer: function () {
                window.location.replace("./?p=appariement&nom_etude=" + nom_etude);
                $(this).dialog("close");
                //$(location).attr('href', './?p=gestion_variables')
            }
        };
    }

    $("#" + div).dialog('option', 'buttons', myButtons);
}

function popin_fichier_data(div, b_traitement, _format_fichier_data) {

    var message_success = $('#popin #message_success');
    var message_danger = $('#popin #message_danger');
    var msg_traitement = 'msg-traitement';
    var _nom_etude = $("#nom_etude").val();
    $("#" + div).dialog({
        resizable: false,
        height: "auto",
        width: 700,
        modal: true
    });
    var myButtons = {
        "Inserer et Mettre à jour les données": function () {
            var _file_name = $("#file_name").val();
            var _id_projet = $("#id_projet").val();
            var _nom_etude = $("#nom_etude").val();
            //var _separateur = $("#separateur").val();
            var _encodage = $("#encodage").val();
            $.getJSON('./?p=ajax_insert_update_data_etude', {
                file_name: _file_name,
                nom_etude: _nom_etude,
                id_projet: _id_projet,
                //separateur: _separateur,
                encodage: _encodage
            }, function (data) {

                if (data.error === false) {
                    /*message_success.children()
                     .removeClass('alert-danger')
                     .addClass('alert-success');*/
                    message_success.children()
                            .find('span.message')
                            .html('Nombres des lignes inserées : ' + data.results.nbr_lignes_inserees);
                    message_danger.children()
                            .find('span.message')
                            .html('Nombres des lignes rejetées : ' + data.results.nbr_lignes_rejetees);
                    message_success
                            .fadeOut(100)
                            .fadeIn(300);
                    message_danger
                            .fadeOut(100)
                            .fadeIn(300);
                } else {
                    message_success.children()
                            .removeClass('alert-success')
                            .addClass('alert-danger');
                    message_success.children()
                            .find('span.message')
                            .html(data.message);
                }
                var myButtons = {
                    Fermer: function () {
                        window.location.replace("./?p=appariement&nom_etude=" + _nom_etude);
                        $(this).dialog("close");
                        //$(location).attr('href', './?p=appariement')
                    }
                };
                $("#" + div).dialog('option', 'buttons', myButtons);
                document.getElementById(msg_traitement).style.display = 'none';

            });
        },
        Annuler: function () {
            window.location.replace("./?p=appariement&nom_etude=" + _nom_etude);
            $(this).dialog("close");
        }
    };

    if (b_traitement === 0) {
        var myButtons = {
            Fermer: function () {
                var _nom_etude = $("#nom_etude").val();
                location.href = "./?p=appariement&nom_etude=" + _nom_etude;
            }
        };
    }

    $("#" + div).dialog('option', 'buttons', myButtons);
}

function hide(div) {
    document.getElementById(div).style.display = 'none';
    return false;
}
