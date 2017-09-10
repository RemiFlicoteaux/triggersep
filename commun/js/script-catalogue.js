/**
 * PHP @version 5.5.12
 * 
 * @author : AOUEY Yesser <yesser87@gmail.com>
 * @date : 14 septembre 2015
 */
jQuery(document).ready(function () {

    /**
     * 
     * Modification et suppression des variables referentiels
     * 
     * 
     */

    var txtbox;
    var prevbox;

    $('td').on('click', 'span', function () {

        if ($(this).hasClass('glyphicon glyphicon-pencil')) {

            $(this).removeClass("glyphicon glyphicon-pencil")
            $(this).addClass('glyphicon glyphicon-ok');
            $('#var' + $(this).attr('id_var')).prop("readOnly", false);
            $('#var' + $(this).attr('id_var')).css("border", "2px solid");
            $('#desc' + $(this).attr('id_var')).prop("readOnly", false);
            $('#desc' + $(this).attr('id_var')).css("border", "2px solid");
            $('#unite' + $(this).attr('id_var')).prop("readOnly", false);
            $('#unite' + $(this).attr('id_var')).css("border", "2px solid");
            $('#type' + $(this).attr('id_var')).prop("readOnly", false);
            $('#type' + $(this).attr('id_var')).css("border", "2px solid");

        } else if ($(this).hasClass('glyphicon glyphicon-ok')) {

            var _id = $(this).attr('id_var');

            if ($('#var' + _id).val() != '')
            {
                var _variable = $('#var' + $(this).attr('id_var')).val();
                var _description = $('#desc' + $(this).attr('id_var')).val();
                var _unite = $('#unite' + $(this).attr('id_var')).val();
                var _type = $('#type' + $(this).attr('id_var')).val();

                $.getJSON('./?p=ajax_update_variable_ref', {identifiant: _id, variable: _variable, description: _description, unite: _unite, type: _type, operation: 'update'}
                , function (data) {

                    state = !data.error;
                    if (state !== true) {
                        //alert('variable enregistré');
                        //alert(data.message);

                    } else {

                        $('#modif' + _id).removeClass("glyphicon glyphicon-ok")

                        $('#modif' + _id).addClass('glyphicon glyphicon-pencil');
                        $('#var' + _id).prop("readOnly", true);
                        $('#var' + _id).css("border", "0px");
                        $('#desc' + _id).prop("readOnly", true);
                        $('#desc' + _id).css("border", "0px");
                        $('#unite' + _id).prop("readOnly", true);
                        $('#unite' + _id).css("border", "0px");
                        $('#type' + _id).prop("readOnly", true);
                        $('#type' + _id).css("border", "0px");

                    }


                });

            } else {

                alert('Le nom de variable est obligatoire')

            }

        } else if ($(this).hasClass('glyphicon glyphicon-trash')) {

            var _id = $(this).attr('id_var');
            var _variable = $('#var' + $(this).attr('id_var')).val();
            var _description = $('#desc' + $(this).attr('id_var')).val();
            var _unite = $('#unite' + $(this).attr('id_var')).val();
            var _type = $('#type' + $(this).attr('id_var')).val();

            $.getJSON('./?p=ajax_update_variable_ref', {identifiant: _id, variable: _variable, description: _description, unite: _unite, type: _type, operation: 'delete'}
            , function (data) {

                state = !data.error;
                if (state !== true) {
                    //alert('variable enregistré');
                    //alert(data.message);

                } else {
                    $('#tr' + _id).remove();

                }

            });
        }


    });

    $('#addvar').on('click', function () {

        $("#new_var").show();


    });

    $('#annuler').on('click', function () {

        $("#new_var").hide();


    });

    $('#valide').on('click', function () {

        var message = $('#ajout-variable-modal .message');
        if ($('#input_variable').val() !== '')
        {

            var _variable = $('#input_variable').val();
            var _description = $('#input_description').val();
            var _unite = $('#input_unite').val();
            var _type = $('#input_type').val();

            $.getJSON('./?p=ajax_update_variable_ref', {identifiant: '', variable: _variable, description: _description, unite: _unite, type: _type, operation: 'insert'}
            , function (data) {

                state = !data.error;
                if (state !== true) {
                    //alert('variable enregistré');
                    //alert(data.message);
                    message.children()
                            .find('span.message')
                            .text(data.message);
                    message
                            .fadeOut(100)
                            .fadeIn(300);
                } else {

                    location.reload();

                }
            });

        } else {
            alert('Le nom de variable est obligatoire');
        }

    });
    $('#close').on('click', function () {
        $("#ajout-variable-modal").modal('hide');
    });
//e Handelbars helper


});

function pop(div, b_traitement, no_data) {

    var message = $('#popin .message');
    var msg_traitement = 'msg-traitement';

    $("#" + div).dialog({
        resizable: false,
        height: "auto",
        width: 800,
        modal: true,
    });
    var myButtons = {};
    var btn_insert_delete_text = "Supprimer l'ancien catalogue et insérer les variables";
    
    if (no_data === 1) {
        btn_insert_delete_text = "Insérer les variables de ce catalogue";
    }

    myButtons[btn_insert_delete_text] = function () {
        var _file_name = $("#file_name").val();

        $.getJSON('./?p=ajax_catalogue_update', {boutton: 'delete', file_name: _file_name}, function (data) {

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
                    location.href = './?p=catalogue';
                }
            };
            $("#" + div).dialog('option', 'buttons', myButtons);
            document.getElementById(msg_traitement).style.display = 'none';
            message.children()
                    .find('span.message')
                    .text(data.message);
            message
                    .fadeOut(100)
                    .fadeIn(300);
        });
    };


    if (no_data === 0) {
        myButtons["Mettre à jour le catalogue"] = function () {

            var _file_name = $("#file_name").val();
            message = $('#popin .message');

            $.getJSON('./?p=ajax_catalogue_update', {boutton: 'update', file_name: _file_name}, function (data) {

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
                        $(this).dialog("close");
                        window.location.replace('./?p=catalogue');
                    }
                };
                document.getElementById(msg_traitement).style.display = 'none';
                $("#" + div).dialog('option', 'buttons', myButtons);
                message.children()
                        .find('span.message')
                        .text(data.message);
                message
                        .fadeOut(100)
                        .fadeIn(300);
            });
        };
    }

    myButtons["Annuler"] = function () {
        $(this).dialog("close");
    };




    if (b_traitement == 0) {
        var myButtons = {
            Annuler: function () {
                $(this).dialog("close");
                window.location.replace('./?p=catalogue');
            }
        };
    }

    $("#" + div).dialog('option', 'buttons', myButtons);
}

function hide(div) {
    document.getElementById(div).style.display = 'none';
    return false;
}