var ProductsCategories = function () {


    return {
        init: function () {

            $('#product-category-form').submit(function (e) {
                e.preventDefault();

                AjaxService.exec(Application.getBasePath() + '/products-categories-save/ajax',
                    {category: $('#account-status-name').val().trim(), action: 'save'},
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
            });
        }
    };
}();
$(document).ready(function () {
    ProductsCategories.init();
});