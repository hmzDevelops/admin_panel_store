    //sweetalert
    function showSweetAlert(title, msg, iconType) {
        Swal.fire({
            title: title,
            text: msg,
            icon: iconType,
            confirmButtonText: "باشه",
        });
    }

    //error toast
    function errorToast(message) {
        var errorTag =
            '<section class="toast" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
            '<strong class="ml-auto">' +
            message +
            "</strong>\n" +
            '<button type="button" class="mr-2 close" data-dissmiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            "</button>\n" +
            "</section>\n" +
            "</section>";

        $(".toast-wrapper").append(errorTag);
        $(".toast")
            .toast("show")
            .delay(5000)
            .queue(function () {
                $(this).remove();
            });
    }

    //success toast
    function successToast(message) {
        var successTag =
            '<section class="toast" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
            '<strong class="ml-auto">' +
            message +
            "</strong>\n" +
            '<button type="button" class="mr-2 close" data-dissmiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            "</button>\n" +
            "</section>\n" +
            "</section>";

        $(".toast-wrapper").append(successTag);
        $(".toast")
            .toast("show")
            .delay(5500)
            .queue(function () {
                $(this).remove();
            });
    }

    //info toast
    function infoToast(message) {
        var infoTag =
            '<section class="toast" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-info text-white">\n' +
            '<strong class="ml-auto">' +
            message +
            "</strong>\n" +
            '<button type="button" class="mr-2 close" data-dissmiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            "</button>\n" +
            "</section>\n" +
            "</section>";

        $(".toast-wrapper").append(infoTag);
        $(".toast")
            .toast("show")
            .delay(5500)
            .queue(function () {
                $(this).remove();
            });
    }


    //info toast
    function warningToast(message) {
        var infoTag =
            '<section class="toast" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-warning text-white">\n' +
            '<strong class="ml-auto">' +
            message +
            "</strong>\n" +
            '<button type="button" class="mr-2 close" data-dissmiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            "</button>\n" +
            "</section>\n" +
            "</section>";

        $(".toast-wrapper").append(infoTag);
        $(".toast")
            .toast("show")
            .delay(5500)
            .queue(function () {
                $(this).remove();
            });
    }
