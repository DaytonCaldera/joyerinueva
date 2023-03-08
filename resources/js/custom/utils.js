window.number_format = function (number) {
    if (number == null) {
        throw new Error("Cannot format null");
    }

    const options = { minimumFractionDigits: 2, maximumFractionDigits: 2 };
    const formattedNumber = number.toLocaleString(undefined, options);
    return formattedNumber;

}

window.startLoading = function () {
    $("#loading").modal({
        backdrop: 'static',
        keyboard: false,
    });
    $("#loading").modal('show');
}

window.stopLoading = function () {
    setTimeout(() => { $("#loading").modal('hide'); }, 500)

}

window.DataTableLanguage = {
    "lengthMenu": "Mostrar _MENU_ registros por pagina",
    "zeroRecords": "No se encontraron registros",
    "info": "Mostrando pagina _PAGE_ de _PAGES_",
    "infoEmpty": "No hay registros disponibles",
    // "infoFiltered": "(filtered from _MAX_ total records)",
    "search": "Buscar"
}
