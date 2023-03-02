const Swal = require('sweetalert2')

window.simplemsg = function (msg) {
    Swal.fire(msg);
}

/**
 * Alertas
 */

window.successAlert = function (msg, title = '') {
    Swal.fire({
        title: title,
        text: msg,
        icon: 'success',
    });
}

window.failAlert = function (msg, title = '') {
    Swal.fire({
        title: title,
        text: msg,
        icon: 'error',
    });
}
window.warningAlert = function (msg, title = '') {
    Swal.fire({
        title: title,
        text: msg,
        icon: 'warning',
    });
}

/**
 * Prompt
 */

window.confirmDialog = function (title, msg, icon, success, cancel = '') {
    Swal.fire({
        title: title,
        text: msg,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            window.successToast(success);
        } else {
            if (cancel !== '')
                window.warningToast(cancel);
        }
    })
}

/**
 * Toast
 */

window.confirmToast = function (msg, callback = null) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: true,
        showCancelButton: (callback != null) ? true : false,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        }
    })

    Toast.fire({
        icon: 'success',
        title: msg
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed && callback != null) {
            callback();
        } 
    })
}

window.successToast = function (msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,

        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        }
    })
    Toast.fire({
        icon: 'success',
        title: msg
    })
}

window.failToast = function (msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        }
    })
    Toast.fire({
        icon: 'error',
        title: msg
    })
}

window.warningToast = function (msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        }
    })
    Toast.fire({
        icon: 'warning',
        title: msg
    })
}