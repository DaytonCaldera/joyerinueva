document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        const root = new Contratos();
        // 
        let btnSearch = document.getElementById('btn_buscar');
        let btnNew = document.getElementById('btn_nuevo');
        let btnHistory = document.getElementById('client_history_btn');
        let btnAddItem = document.getElementById('add_item');
        let btnCancelNewContract = document.getElementById('btn_cancelar_nuevo_contrato');


        btnHistory.addEventListener('click', event => root.historyClientEvent(event, btnHistory));
        btnSearch.addEventListener('click', event => root.searchContractEvent(event, btnSearch));
        btnNew.addEventListener('click', event => root.newContractEvent(event, btnNew));
        btnAddItem.addEventListener('click', event => root.addItem(event, btnAddItem));
        btnCancelNewContract.addEventListener('click', event => root.cancelNewContract(event));

    }
}

class Contratos {
    constructor() {
        this.total = 0;
        this.total_container = $("#total_prestamo");
        this.new_contract_jsgrid = $("#newjsGrid");
        this.searchBlock = $("#buscar_contrato");
        this.newBlock = $("#nuevo_contrato");
        this.historyBlock = $("#historial_cliente");
        this.historyJsGrid = $("#historialJsGrid");
    }

    setTotal(val, notShow = false) {
        this.total = val;
        if (!notShow)
            this.total_container.val(this.total)
    }
    getTotal() {
        return this.total;
    }

    searchContractEvent(e, btn) {
        this.showSearchBlock();
    }
    newContractEvent(e, btn) {
        this.showNewBlock();
        this.loadNewItemsTable();
    }
    historyClientEvent(e, btn) {
        this.getHistoryClient(btn);
    }

    showSearchBlock() {
        this.searchBlock.show();
        this.newBlock.hide();
        this.historyBlock.hide();
    }
    showNewBlock(e, btn) {
        this.searchBlock.hide();
        this.newBlock.show();
        this.historyBlock.hide();
        $("#articulos").select2();
    }

    showHistoryBlock(btn) {
        btn.querySelector('.loading').setAttribute('hidden', true);
        this.searchBlock.hide();
        this.newBlock.hide();
        this.historyBlock.show();
    }

    hideAllBlocks() {
        this.searchBlock.hide();
        this.newBlock.hide();
        this.historyBlock.hide();
    }

    getHistoryClient(btn) {
        let client_id = $("#client_id").val();
        $.ajax({
            beforeSend: function () {
                btn.querySelector('.loading').removeAttribute('hidden');
            },
            type: "GET",
            url: "/admin/contratos/historial/" + client_id,
            success: function (data) {
                btn.querySelector('.loading').setAttribute('hidden', 'hidden');
                if (Object.keys(data).length !== 0) {
                    loadClientHistoryTable(data);
                }else{
                    failToast('El cliente digitado no existe o no tiene contratos');
                }
            }
        });
    }

    loadClientHistoryTable(db) {
        let $this = this;
        this.historyJsGrid.jsGrid({
            width: '100%',
            autoload: true,
            data: db,
            fields: [
                { name: "id", title: "N.C.", type: "text", width: 50 },
                { name: "cedula", title: "Cedula", type: "text", width: 150, filtering: false },
                { name: "fecha_contrato", title: "Fecha contrato", type: "text", width: 200 },
                { name: "fecha_vencimiento", title: "Vencimiento", type: "text", width: 100, },
                { name: "vencido", type: "checkbox", title: "Esta vencido", sorting: false, filtering: false },
                {
                    type: "control", editButton: false, deleteButton: false,
                    itemTemplate: function (val, item) {
                        var $customEditButton = $("<button>").attr({ class: "customGridEditbutton jsgrid-button jsgrid-edit-button" })
                            .on('click', function (e) {
                                $this.showSearchBlock();
                            });
                        return $("<div>").append($customEditButton);
                    }
                }
            ]
        });
    }

    loadNewItemsTable() {
        let $this = this;
        this.new_contract_jsgrid.jsGrid({
            autoload: true,
            editing: true,
            width: "100%",
            onItemDeleting: function (row) {
                $this.updateTotal(row.item);
            },
            fields: [
                { name: "descripcion", type: "text", editing: false },
                { name: "prestamo", type: "number" },
                {
                    type: "control",
                    editButton: false
                }
            ]
        });

    }

    addItem() {
        let articulo = $("#articulos option:selected");
        let prestamo = $("#prestamo");
        if (articulo.val() == -1) {
            failToast('Debe seleccionar un articulo');
            return;
        }
        if (prestamo.val() === '0' || prestamo.val() == '') {
            failToast('Debe ingresar un monto');
            return;
        }
        let data = {
            id_articulo: articulo.val(),
            descripcion: articulo.text(),
            prestamo: parseInt(prestamo.val()),
        }
        this.setTotal(this.getTotal() + data.prestamo);
        this.new_contract_jsgrid.jsGrid("insertItem", data);
        this.resetItems();
    }

    updateTotal(item) {
        this.setTotal(this.getTotal() - item.prestamo);
    }

    resetItems(tableToo = false) {
        $("#articulos").val('-1').trigger('change');;
        $("#prestamo").val(0);
        if (tableToo)
            this.new_contract_jsgrid.jsGrid("option", "data", []);
    }
    cancelNewContract(e) {
        this.resetItems(true);
        this.setTotal(0);
        this.new_contract_jsgrid.html('');
        this.hideAllBlocks();
    }

}
