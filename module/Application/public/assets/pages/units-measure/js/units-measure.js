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
            {action: 'units-measure-save', data: config},
            function (error) {
                console.log(error);
            },
            function () {
            },
            function (response) {
                if (response.success) {
                    toastr.success(response.message);
                }
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