document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        const root = new Articulos();
    }
}

class Articulos{
    constructor(){

        //variables

        //Containers

        //Buttons
        
        //DataTables
        this.articulosDataTable = $("#articulos_datatable");

        this.initArticulosControls();
    }

    initArticulosControls(){
        this.articulosDataTable.DataTable();
    }

}