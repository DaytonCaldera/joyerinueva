document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        const root = new Contratos();
    }
}

class Contratos {
    constructor() {

        //variables
        this.total = 0;
        this.contrato = {
            inventario: [],
            total: 0,
            fecha_contrato: '',
            fecha_vencimiento: '',
            cliente: 0
        };

        //inputs
        this.total_container = $("#total_prestamo");
        this.articulos_select = $("#articulos");
        this.prestamo_articulo = $("#prestamo");
        this.client_search = $("#clientes_search");
        this.client_name = $('#cl_name');
        this.client_ape1 = $('#cl_ape1');
        this.client_ape2 = $('#cl_ape2');

        //containers
        this.main_row = $("#main_row");
        this.newBlock = $("#nuevo_contrato");
        this.searchBlock = $("#buscar_contrato");
        this.historyBlock = $("#historial_cliente");

        //botones
        this.btn_history_return = $("#btn_history_return");
        this.btnSearch = $('#btn_buscar');
        this.btnNew = $('#btn_nuevo');
        this.btnHistory = $('#client_history_btn');
        this.btnAddItem = $('#add_item');
        this.btnCancelNewContract = $('#btn_cancelar_nuevo_contrato');
        this.btnSaveContract = $("#btn_save_contract");
        this.btnPrintReceipt = $("#btn_print_contract_receipt");

        //tablas
        this.new_contract_jsgrid = $("#newjsGrid");
        this.historyJsGrid = $("#historialJsGrid");
        this.client_id_history = $("#client_id_history");

        //datepickers
        this.dpFechaContrato = $("#fecha_contrato");
        this.dpFechaVencimiento = $("#fecha_vencimiento");

        this.initContractControls();
    }



    initContractControls() {

        //botones
        this.btnHistory.on('click', event => this.historyClientEvent(event, this.btnHistory));
        this.btnSearch.on('click', event => this.searchContractEvent(event, this.btnSearch));
        this.btnNew.on('click', event => this.newContractEvent(event, this.btnNew));
        this.btnAddItem.on('click', event => this.addItem(event, this.btnAddItem));
        this.btnCancelNewContract.on('click', event => this.cancelNewContract(event));
        this.btnSaveContract.on('click', event => { this.saveContract(event, this.btnSaveContract) });
        this.btnPrintReceipt.on('click', event => { this.printReceipt(event, this.btnPrintReceipt) });

        //select2
        this.articulos_select.select2({ width: '100%' });
        this.client_search.select2({ width: '100%' });
        this.client_search.on("select2:select", e => { this.showClientFound() });

        //datepicker

    }

    restoreControls() {
        this.btnSaveContract.prop("disabled", false);
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

    showMainRow() {
        this.main_row.show();
    }

    hideMainRow() {
        this.main_row.hide();
    }

    showClientFound() {
        this.client_name.val(this.client_search.find(':selected').data('name'));
        this.client_ape1.val(this.client_search.find(':selected').data('ape1'));
        this.client_ape2.val(this.client_search.find(':selected').data('ape2'));
    }

    setTotal(val, notShow = false) {
        this.total = val;
        if (!notShow)
            this.total_container.val(this.total)
    }
    getTotal() {
        return this.total;
    }



    showSearchBlock() {
        this.hideMainRow();
        this.searchBlock.show();
        this.newBlock.hide();
        this.historyBlock.hide();
    }
    showNewBlock(e, btn) {
        this.hideMainRow();
        this.searchBlock.hide();
        this.newBlock.show();
        this.historyBlock.hide();

    }

    showHistoryBlock() {
        this.hideMainRow();
        this.searchBlock.hide();
        this.newBlock.hide();
        this.historyBlock.show();
    }

    hideAllBlocks() {
        this.searchBlock.hide();
        this.newBlock.hide();
        this.historyBlock.hide();
        this.showMainRow();
    }

    getHistoryClient(btn) {
        let $this = this;
        $.ajax({
            beforeSend: function () {
                btn.querySelector('.loading').removeAttribute('hidden');
            },
            type: "GET",
            url: "/admin/contratos/historial/" + $this.client_id_history.val(),
            success: function (data) {
                btn.querySelector('.loading').setAttribute('hidden', 'hidden');
                if (Object.keys(data).length !== 0) {
                    $this.loadClientHistoryTable(data);
                    $this.showHistoryBlock();
                    btn.querySelector('.loading').setAttribute('hidden', true);
                } else {
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
            confirmDeleting: false,
            noDataContent: "No se han agregado articulos",
            onItemDeleting: function (row) {
                $this.updateTotal(row.item);
            },
            fields: [
                { name: "id_articulo", title: "Id Articulo", type: "text", editing: false },
                { name: "descripcion", title: "Articulo", type: "text", editing: false },
                { name: "prestamo", title: "Prestamo", type: "number" },
                {
                    type: "control",
                    editButton: false
                }
            ]
        });

    }

    addItem() {
        if (this.articulos_select.find(':selected').data('notselectable') == true) {
            failToast('Debe seleccionar un articulo');
            return;
        }
        let prestamo = this.prestamo_articulo;
        if (prestamo.val() === '0' || prestamo.val() == '') {
            failToast('Debe ingresar un monto');
            return;
        }

        let articulo = this.articulos_select.select2('data')[0];
        let data = {
            id_articulo: articulo.id,
            descripcion: articulo.text,
            prestamo: parseInt(prestamo.val()),
        }
        this.contrato.inventario.push(data);
        this.setTotal(this.getTotal() + data.prestamo);
        this.new_contract_jsgrid.jsGrid("insertItem", data);
        this.resetItems();
    }

    updateTotal(item) {
        this.setTotal(this.getTotal() - item.prestamo);
    }

    resetItems(tableToo = false) {
        this.articulos_select.val('-1').trigger('change');
        this.prestamo_articulo.val(0);
        if (tableToo)
            this.new_contract_jsgrid.jsGrid("option", "data", []);

    }
    resetClient() {
        this.client_search.val('-1').trigger('change');
        this.client_name.val('');
        this.client_ape1.val('');
        this.client_ape2.val('');
    }
    resetContract() {
        this.contrato = {
            inventario: [],
            total: 0,
            fecha_contrato: new Date().toLocaleDateString('es'),
            cliente: 0
        };
    }

    cancelNewContract(e) {
        this.resetItems(true);
        this.resetClient();
        this.setTotal(0);
        this.new_contract_jsgrid.html('');
        this.hideAllBlocks();
        this.restoreControls();
    }

    saveContract(e, btn) {
        console.log(this.contrato);
        btn.find('.loading').removeAttr('hidden');
        setTimeout(() => {
            btn.find('.loading').attr('hidden', 'true');
            successToast('Contrato guardado correctamente');
            btn.prop("disabled", true);
        }, 2000)
    }

    saveLastDataInput() {
        if (localStorage.contract.last != null) {

        } else {

        }
    }

    printReceipt() {
        // let print_window = window.open('/print/contrato','Print contrato','width=350,height=500');
        // print_window.print();
    }

}
