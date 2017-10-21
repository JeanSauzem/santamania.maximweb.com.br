var Application = function () {
    return {
        getBasePath: function () {
            return 'http://' + window.location.host;
            //return '//' + window.location.host + '/gestor';
        }
    }
}();
