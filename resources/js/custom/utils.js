window.number_format = function (number) {
    if (number == null) {
        throw new Error("Cannot format null");
    }

    const options = { minimumFractionDigits: 2, maximumFractionDigits: 2 };
    const formattedNumber = number.toLocaleString(undefined, options);
    return formattedNumber;

}
window.loadingModal = false;
window.startLoading = function () {
    $("#loading").modal({
        backdrop: 'static',
        keyboard: false,
    });
    $("#loading").modal('show');
    $("#loading").on('shown.bs.modal', function () {
        window.loadingModal = true;
    });
}

window.stopLoading = function () {
    $stopLoadingInterval = setInterval(function () {
        if (!window.loadingModal) {
            setTimeout(() => { $("#loading").modal('hide'); }, 500);
        }
    }, 500);
    $("#loading").on('hidden.bs.modal', function () {
        window.loadingModal = false;
        clearInterval($stopLoadingInterval);
    });
}

window.onload = function () {
    const spinner = document.querySelector('.spinner');
    spinner.parentElement.removeChild(spinner);
};

window.DataTableLanguage = {
    "lengthMenu": "Mostrar _MENU_ registros por pagina",
    "zeroRecords": "No se encontraron registros",
    "info": "Mostrando pagina _PAGE_ de _PAGES_",
    "infoEmpty": "No hay registros disponibles",
    // "infoFiltered": "(filtered from _MAX_ total records)",
    "search": "Buscar"
}
