// n NONE DO PRIMEIRO CHECKBOX DA TABELA
// l CHECKBOX DO TBODY
// EX: check( "selectAll", "#TableApplicationHome tbody" );
var CheckboxAll = function () {
    return {
        check: function (n, l) {
            $("input[name=" + n + "]").click(function () {
                if (this.checked === true) {
                    $(l).find("input[type=checkbox]").each(function () {
                        $(this).attr('checked', 'checked');
                        $(this).parent('span').attr('class', 'checked');
                    });
                } else {
                    $(l).find("input[type=checkbox]").each(function () {
                        $(this).removeAttr('checked');
                        $(this).parent('span').removeAttr('class', 'checked');
                    });
                }
            });
            $(l).delegate("[type=checkbox]", "click", function () {
                if (this.checked === false) {
                    $("input[name=" + n + "]").each(function () {
                        $(this).removeAttr('checked');
                        $(this).parent('span').removeAttr('class', 'checked');
                    });
                }
            });
        }
    }
}();