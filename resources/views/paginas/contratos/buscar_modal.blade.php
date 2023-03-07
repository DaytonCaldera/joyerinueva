<div class="modal fade" id="buscar_cliente_avanzado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Busqueda de cliente avanzado</h5>
                
            </div>
            <div class="modal-body">
                <table id="table_clientes_avanzado" style="width:100% !important">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido 1</th>
                            <th>Apellido 2</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->cedula }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->apellido1 }}</td>
                                <td>{{ $cliente->apellido2 }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs select-cliente" data-json="{{json_encode($cliente)}}">Seleccionar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCloseSearchModal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
