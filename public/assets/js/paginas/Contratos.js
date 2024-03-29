document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        // window.startLoading();
        const root = new Contratos();
        // window.stopLoading();
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
            cliente: 0,
            descripcion: ''
        };


        //inputs
        this.numero_contrato = $("#num_contrato");
        this.total_container = $("#total_prestamo");
        this.articulos_select = $("#articulos");
        this.prestamo_articulo = $("#prestamo");
        this.client_search = $("#clientes_search");
        this.client_name = $('#cl_name');
        this.client_ape1 = $('#cl_ape1');
        this.client_ape2 = $('#cl_ape2');
        this.contract_description = $("#descripcion_contrato");
        this.final_description = $("#descripcion_final");

        //containers
        this.main_row = $("#main_row");
        this.newBlock = $("#nuevo_contrato");
        this.searchBlock = $("#buscar_contrato");
        this.historyBlock = $("#historial_cliente");
        this.searchModal = $("#buscar_cliente_avanzado");


        //botones
        this.btn_history_return = $("#btn_history_return");
        this.btnSearch = $('#btn_buscar');
        this.btnNew = $('#btn_nuevo');
        this.btnHistory = $('#client_history_btn');
        this.btnAddItem = $('#add_item');
        this.btnCancelNewContract = $('#btn_cancelar_nuevo_contrato');
        this.btnSaveContract = $("#btn_save_contract");
        this.btnPrintReceipt = $("#btn_print_contract_receipt");
        this.btnOpenSearchModal = $("#btn_open_search_modal");
        this.btnsSelectClient = $(".select-cliente");
        this.btnCloseSearchModal = $("#btnCloseSearchModal")

        //tablas
        this.new_contract_jsgrid = $("#newjsGrid");
        this.historyJsGrid = $("#historialJsGrid");
        this.client_id_history = $("#client_id_history");
        this.client_search_datatable = $('#table_clientes_avanzado');

        //datepickers
        this.dpFechaContrato = $("#fecha_contrato");
        this.dpFechaVencimiento = $("#fecha_vencimiento");

        this.initContractControls();
    }

    initContractControls() {
        let $this = this;

        //botones
        this.btnHistory.on('click', event => this.historyClientEvent(event, this.btnHistory));
        this.btnSearch.on('click', event => this.searchContractEvent(event, this.btnSearch));
        this.btnNew.on('click', event => this.newContractEvent(event, this.btnNew));
        this.btnAddItem.on('click', event => this.addItem(event, this.btnAddItem));
        this.btnCancelNewContract.on('click', event => this.cancelNewContract(event));
        this.btnSaveContract.on('click', event => { this.saveContract(event, this.btnSaveContract) });
        this.btnSaveState('normal');
        this.btnPrintReceipt.on('click', event => { this.printReceipt(event, this.btnPrintReceipt) });
        this.btnOpenSearchModal.on('click', event => { this.openSearchClientModalEvent(event, this.btnOpenSearchModal) });
        this.btnCloseSearchModal.on('click', event => { this.closeSearchClientModal(event, this.btnCloseSearchModal) });
        this.btnsSelectClient.each(function (index, element) {
            element.addEventListener('click', event => { $this.selectClientFromTable(event, element) })
        });

        //inputs
        this.contract_description.on('keyup', event => { this.descriptionEvent(event, this.contract_description) })

        //select2
        this.initSelect2Components();


        //datepicker
        this.dpFechaContrato.on('change', event => { this.contrato.fecha_contrato = this.dpFechaContrato.val() });
        this.dpFechaVencimiento.on('change', event => { this.contrato.fecha_vencimiento = this.dpFechaVencimiento.val() });

        //DataTables
        this.client_search_datatable.DataTable({
            responsive: true,
            language: DataTableLanguage
        }).columns(0).visible(false); //hide the ID column

        // console.log('ya termino');
        window.stopLoading();

    }

    initSelect2Components() {
        this.articulos_select.select2({ width: '100%' });
        this.client_search.select2({
            language: "custom",
            ajax: {
                url: '/clientes/select',
                tags: "true",
                data: function (params) {
                    return {
                        search: params.term // modified search query
                    };
                },
            },
            minimumInputLength: 1,
            width: '100%'
        });
        this.client_search.on("select2:select", e => { this.setClient() });
    }

    selectClientFromTable(e, btn) {
        let data = JSON.parse(btn.dataset.json);
        this.showClientFound(data);
        this.closeSearchClientModal();
    }

    restoreControls() {
        this.btnSaveContract.prop("disabled", false);
    }

    searchContractEvent(e, btn) {
        let $this = this;
        $.ajax({
            url: '/admin/get/contrato',
            type: 'GET',
            data: {
                contrato: this.numero_contrato.val()
            },
            dataType: 'json',
            success: (data) => { $this.setFoundedContract(data); }
        }); 8
    }
    setFoundedContract(data = null) {
        this.contrato = {
            inventario: data.contrato.inventario,
            total: data.contrato.prestamo,
            fecha_contrato: data.contrato.fecha_contrato,
            fecha_vencimiento: data.contrato.fecha_vencimiento,
            // cliente: 0,
            descripcion: data.contrato.descripcion
        }

        console.log(this.contrato);
        this.renderFoundedContract();
    }
    renderFoundedContract() {
        this.setFechasDP(true);
        this.loadNewItemsTable(true);
        this.showNewBlock();
    }
    
    newContractEvent(e, btn) {
        this.showNewBlock();
        this.setFechasDP();
        this.loadNewItemsTable();
    }
    historyClientEvent(e, btn) {
        this.getHistoryClient(btn);
    }

    openSearchClientModalEvent(e, btn) {
        this.searchModal.modal({
            backdrop: 'static',
            keyboard: false
        });
        this.searchModal.modal('show');
    }

    descriptionEvent(event, textarea) {
        this.updateFinalDescription(event.currentTarget.value);
    }

    updateFinalDescription(text = null) {
        if (text == null)
            text = this.contract_description.val();
        let total_text = "\nVALORADO EN ₡" + this.getTotal(true);
        this.final_description.val(text + total_text);
        this.contrato.descripcion = text + total_text;
    }

    closeSearchClientModal() {
        this.searchModal.modal('hide');
    }

    showMainRow() {
        this.main_row.show();
    }

    hideMainRow() {
        this.main_row.hide();
    }

    setClient() {
        this.contrato.cliente = this.client_search.val();
    }

    setTotal(val, notShow = false) {
        this.contrato.total = val;
        if (!notShow)
            this.total_container.val(this.contrato.total)
    }
    getTotal(formatted = false) {
        if (formatted)
            return number_format(this.contrato.total)
        return this.contrato.total;
    }

    setFechasDP(onlyRender = false) {
        if(!onlyRender){
            let fecha_contrato = new Date().toISOString().slice(0, 10);
            let fecha_vencimiento = new Date();
            fecha_vencimiento.setMonth(fecha_vencimiento.getMonth() + 1);
            this.dpFechaContrato.val(fecha_contrato)
            fecha_vencimiento = fecha_vencimiento.toISOString().slice(0, 10)
            this.dpFechaVencimiento.val(fecha_vencimiento)
            this.contrato.fecha_contrato = fecha_contrato;
            this.contrato.fecha_vencimiento = fecha_vencimiento;

        }else{
            this.dpFechaContrato.val(this.contrato.fecha_contrato)
            this.dpFechaVencimiento.val(this.contrato.fecha_vencimiento)
        }
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
                btn.find('.loading').removeAttr('hidden');
            },
            type: "GET",
            url: "/admin/contratos/historial/" + $this.client_id_history.val(),
            success: function (data) {
                btn.find('.loading').attr('hidden', 'hidden');
                if (Object.keys(data).length !== 0) {
                    $this.loadClientHistoryTable(data);
                    $this.showHistoryBlock();
                    btn.find('.loading').attr('hidden', true);
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

    loadNewItemsTable(isLoaded = false) {
        console.log(this.contrato.inventario);
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
                { name: "cantidad", title: "Prestamo", type: "number" },
                {
                    type: "control",
                    editButton: false
                }
            ]
        });
        if(isLoaded){
            this.new_contract_jsgrid.jsGrid('loadData', this.contrato.inventario);
        }
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
            cantidad: parseInt(prestamo.val()),
        }
        this.contrato.inventario.push(data);
        this.setTotal(this.getTotal() + data.cantidad);
        this.new_contract_jsgrid.jsGrid("insertItem", data);
        this.updateFinalDescription();
        this.resetItems();
    }

    updateTotal(item) {
        this.setTotal(this.getTotal() - item.cantidad);
        this.updateFinalDescription();
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
            fecha_contrato: '',
            fecha_vencimiento: '',
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
        this.btnSaveState('normal');
    }

    saveContract(e, btn) {
        let $this = this;
        const json = JSON.stringify(this.contrato);
        console.log(json);
        if (this.validContract()) {
            console.log('Valid contract!');
            this.btnSaveState('normal');
            $.ajax({
                url: '/admin/add/contrato',
                type: 'POST',
                data: {
                    contrato: json
                },
                success: function (data) {
                    $this.btnSaveState('saved');
                }
            });
        }

    }

    btnSaveState(state) {
        switch (state) {
            case 'normal':
                console.log('normal state');
                this.btnSaveContract.find('.loading').prop('hidden', true);
                this.btnSaveContract.find('.btn_save_title').html('Guardar contrato')
                this.btnSaveContract.removeClass('btn-warning');
                this.btnSaveContract.removeClass('btn-primary');
                this.btnSaveContract.addClass('btn-success');
                this.btnSaveContract.prop("disabled", false);
                this.btnPrintReceipt.hide();
                break;
            case 'saving':
                console.log('saving state');
                this.btnSaveContract.find('.loading').removeAttr('hidden');
                this.btnSaveContract.find('.btn_save_title').html(' ...Guardando')
                this.btnSaveContract.removeClass('btn-success');
                this.btnSaveContract.addClass('btn-warning');
                this.btnSaveContract.prop("disabled", true);
                this.btnPrintReceipt.hide();
                break;
            case 'saved':
                console.log('saved state');
                this.btnSaveContract.find('.loading').prop('hidden', true);
                this.btnSaveContract.find('.btn_save_title').html(' Guardado!')
                this.btnSaveContract.removeClass('btn-warning');
                this.btnSaveContract.addClass('btn-primary');
                this.btnSaveContract.prop("disabled", true);
                this.btnPrintReceipt.show();
                break;
            default:
                console.log('nothing done');
                break

        }
    }

    validContract() {
        if ((this.contrato.inventario == null || this.contrato.inventario == [])) {
            failToast('No se ha agregado ningun articulo');
            return false;
        }
        if (this.contrato.total == 0) {
            failToast('El total del contrato no puede ser 0');
            return false;
        }
        if (this.contrato.cliente == 0) {
            failToast('No se ha cargado ningun cliente');
            return false;
        }
        if (this.contrato.fecha_contrato == '') {
            this.contrato.fecha_contrato = this.fecha_contrato.val();
        }
        if (this.contrato.fecha_vencimiento == '') {
            this.contrato.fecha_vencimiento = this.fecha_vencimiento.val();
        }
        return true;
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
