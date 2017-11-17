var UnitsMeasure = function () {

    var form = $('#units-measure-form');

    var submit = function () {

        var config = {};
        jQuery(form).serializeArray().map(function (item) {
            if (config[item.name]) {
                if (typeof(config[item.name]) === "string") {
                    config[item.name] = [config[item.name]];
                }
                config[item.name].push(item.value);
            } else {
                config[item.name] = item.value;
            }
        });

        AjaxService.exec(Application.getBasePath() + '/units-measure/ajax',
            {action: 'units-measure-save-ajax', data: config},
            function () {
            },
            function (response) {
                if (response.success) {
                    $('#units-measure-modal').modal('hide');
                    $('#units').append('<option value='+response.units.id+' selected>'+response.units.name+'</option>');
                    $('#units').selectpicker('refresh');

                }
            }, 
            function (error) {
                console.log(error);
            }
            
        );
    };

    return {
        init: function () {
            form.on('submit', function (e) {
                e.preventDefault();
                submit();
            })
        }
    }
}();

UnitsMeasure.init();