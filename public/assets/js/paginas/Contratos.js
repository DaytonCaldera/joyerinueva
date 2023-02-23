document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        const root = new Contratos();
        // 
        let btnSearch = document.getElementById('btn_buscar');
        let btnNew = document.getElementById('btn_nuevo');
        let btnHistory = document.getElementById('client_history_btn');
        let btnAddItem = document.getElementById('add_item');

        btnHistory.addEventListener('click', event => root.historyClientEvent(event, btnHistory));
        btnSearch.addEventListener('click', event => root.searchContractEvent(event, btnSearch));
        btnNew.addEventListener('click', event => root.newContractEvent(event, btnNew));
        btnAddItem.addEventListener('click', event => root.addItem(event, btnAddItem));

    }
}

class Contratos {
    constructor() {

    }

    searchContractEvent(e, btn) {
        this.showSearchBlock();
    }
    newContractEvent(e, btn) {
        this.showNewBlock();
        this.loadNewItemsTable();
    }
    historyClientEvent(e, btn) {
        this.loadClientHistoryTable();
    }

    showSearchBlock() {
        $("#buscar_contrato").show();
        $("#nuevo_contrato").hide();
        $("#historial_cliente").hide();
        // document.getElementById('buscar_contrato').removeAttribute('hidden');
        // document.getElementById('nuevo_contrato').setAttribute('hidden', true);
        // document.getElementById('historial_cliente').setAttribute('hidden', true);
    }
    showNewBlock(e, btn) {
        $("#buscar_contrato").hide();
        $("#nuevo_contrato").show();
        $("#historial_cliente").hide();
        $("#articulos").chosen();
        // document.getElementById('buscar_contrato').setAttribute('hidden', true);
        // document.getElementById('nuevo_contrato').removeAttribute('hidden');
        // document.getElementById('historial_cliente').setAttribute('hidden', true);

    }

    showHistoryBlock() {
        $("#buscar_contrato").hide();
        $("#nuevo_contrato").hide();
        $("#historial_cliente").show();
        // document.getElementById('buscar_contrato').setAttribute('hidden', true);
        // document.getElementById('nuevo_contrato').setAttribute('hidden', true);
        // document.getElementById('historial_cliente').removeAttribute('hidden');
    }

    loadClientHistoryTable() {
        let $this = this;
        let client_id = $("#client_id").val();
        $("#historialJsGrid").jsGrid({
            width: '100%',
            autoload: true,
            controller: {
                loadData: function (filter) {
                    return $.ajax({
                        type: "GET",
                        url: "/admin/contratos/historial/" + client_id,
                        data: filter
                    }).done(function () {
                        $this.showHistoryBlock();
                    });
                },
            },
            fields: [
                { name: "numcontra", title: "N.C.", type: "text", width: 50 },
                { name: "cedula", title: "Cedula", type: "text", width: 150, filtering: false },
                { name: "fecha_contrato", title: "Fecha contrato", type: "text", width: 200 },
                { name: "fecha_vencimiento", title: "Vencimiento", type: "text", width: 100, },
                { name: "vencido", type: "checkbox", title: "Esta vencido", sorting: false, filtering: false },
                { type: "control" }
            ]
        });
    }

    loadNewItemsTable() {
        $("#newjsGrid").jsGrid({
            autoload: true,
            width: "100%",

            fields: [
                { name: "descripcion", type: "text" },
                { name: "prestamo", type: "text" }
            ]
        });

    }

    addItem() {
        var data = {
            id_articulo: $("#articulos").val(),
            descripcion: $("#articulos").text(),
            prestamo: $("#prestamo").val(),
        }
        $("#newjsGrid").jsGrid("insertItem", data)
    }



}
