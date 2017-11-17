var ProductsCategories = function () {


    return {
        init: function () {

            $('#product-category-form').submit(function (e) {
                e.preventDefault();

                AjaxService.exec(Application.getBasePath() + '/product-categories/ajax',
                    {name: $('#account-status-name').val().trim(), active: '1',action: 'products-categories-save'},
                    function () {
                    },
                    function (response) {
                        if (response.success) {
                            $('#product-category-modal').modal('hide');
                            $('#product').append('<option value='+response.category.id+' selected>'+response.category.name+'</option>');
                            $('#product').selectpicker('refresh');
                           
                        }
                    },
                    function (error) {
                        console.log(error);
                    }
                );
            });
        }
    };
}();
$(document).ready(function () {
    ProductsCategories.init();
});