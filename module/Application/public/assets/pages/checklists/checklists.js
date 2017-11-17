var checklists = function () {

    var formDate = $('#checklist-date-form');

    var sendChecklist = function () {
        var config = {};
        jQuery(formDate).serializeArray().map(function (item) {
            if (config[item.name]) {
                if (typeof(config[item.name]) === "string") {
                    config[item.name] = [config[item.name]];
                }
                config[item.name].push(item.value);
            } else {
                config[item.name] = item.value;
            }
            console.log(config);
        });

        AjaxService.exec(Application.getBasePath() + '/checklist/ajax',
            {action: 'counter-save-ajax', data: config},
            function () {
            },
            function (response) {
                if (response.success) {
                    $('table tbody').append('<tr><th><input class="checkbox" type="checkbox"></th><th scope="row">' + response.counter.id + '</th>' +
                        '<td>' + response.counter.data + '</td>' +
                        '<td class="text-right">' +
                        '<a href="/checklist/check-product/' + response.counter.id + '" class="btn btn-primary btn-sm tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar">' +
                        '<i class="fa fa-pencil"></i>' +
                        '</a>' +
                        '<button onclick="remove(\'checklist\', \'' + response.counter.id + '\')" class="btn btn-danger btn-sm tooltips user-delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deletar">' +
                        '<i class="fa fa-trash"></i>' +
                        '</button>' +
                        '</td>' +
                        '</tr>');
                    $('#modal_date_checklist').modal('hide');
                    $.Notification.notify('success', 'top left', 'Notificação de Sucesso', 'Data Cadastrada com Sucesso');
                } else {
                    $.Notification.notify('error', 'top left', 'Notificação de Erro', 'Esta data já esta cadastrada');
                }
            },
            function (error) {
                console.log(error);
            }
        );

    };

    var open = function () {
        $('#modal_date_checklist').modal('show');
    };
    var openCalender = function () {
        $.fn.datepicker.defaults.format = "dd/mm/yyyy";
        $('#date-checklist').datepicker();
    };

    return {
        init: function () {
            formDate.on('submit', function (e) {
                e.preventDefault();
                sendChecklist();
            })
        },
        open: function () {
            open();
        },
        calenderChecklist: function () {
            openCalender();
        }
    }
}();

$(document).ready(function () {
    checklists.init();
    checklists.calenderChecklist();
});