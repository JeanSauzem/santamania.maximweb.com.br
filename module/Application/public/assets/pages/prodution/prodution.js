var Prodution = function () {

    var close = function () {

        AjaxService.exec(Application.getBasePath() + '/prodution/ajax',
            {action: 'close-day'},
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
            close();
        }
    }
}();

