var AjaxService = function () {

    var ajaxSetup = function () {
        $.ajaxSetup({
            type    : 'POST',
            dataType: 'json'
        });
    };

    return {
        exec: function (url, data, beforeSendCallback, successCallback, errorCallback) {
            ajaxSetup();
            $.ajax({
                url       : url,
                data      : data,
                error     : function (error) {
                    errorCallback(error.responseText);
                },
                beforeSend: function (data) {
                    beforeSendCallback(data);
                },
                success   : function (data) {
                    successCallback(data);
                }
            });
        }
    }
}();