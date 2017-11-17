$(document).ready(function () {
    //$.Notification.notify('custom', 'top right', 'Sample Notification', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci ut dolor scelerisque aliquam.')
});

function remove(code) {
    swal({
        title             : "Are you sure?",
        text              : "You will not be able to recover this imaginary file!",
        type              : "warning",
        showCancelButton  : true,
        confirmButtonClass: 'btn-warning',
        confirmButtonText : "Yes, delete it!",
        closeOnConfirm    : false
    }, function () {
        $(window.document.location).attr('href', getBasePath() + "warehouses/delete/" + code);
    });
}


