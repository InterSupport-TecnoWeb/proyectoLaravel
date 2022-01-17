<div class="row sale layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-reponsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-white">Nombre</th>
                                <th class="table-th text-white">Apellido</th>
                                <th class="table-th text-white">CI</th>
                                <th class="table-th text-white">Correo</th>
                                <th class="table-th text-white">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>
                                    <h6>{{$cliente->nombre}}</h6>
                                </td>
                                <td>
                                    <h6>{{$cliente->apellidos}}</h6>
                                </td>

                                <td>
                                    <h6>{{$cliente->ci}}</h6>
                                </td>

                                <td>
                                    <h6>{{$cliente->correo}}</h6>
                                </td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" wire:click="Edit({{$cliente->id}})"  class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="Confirm('{{$cliente->id}}')" class="btn btn-dark" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$clientes->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.Cliente.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('cliente-added',msg =>{
            $('#theModal').modal('hide');
            noty(msg);
        })
        window.livewire.on('cliente-updated',msg =>{
            $('#theModal').modal('hide');
            noty(msg);
        })
        window.livewire.on('cliente-deleted',msg =>{
            noty(msg);
        })
        window.livewire.on('hide-modal',msg =>{
            $('#theModal').modal('hide');
        })
        window.livewire.on('show-modal',msg =>{
            $('#theModal').modal('show');
        })
        window.livewire.on('hidden.bs.modal',msg =>{
            $('.er').css('display','none');
        })
    });

    function Confirm(id){
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3F5C'
        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteRow',id);
                swal.close();
            }
        })
    }

</script>
