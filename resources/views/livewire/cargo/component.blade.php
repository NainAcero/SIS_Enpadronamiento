<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        @if($action == 1)
        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5><b>Cargos en el Sistema</b></h5>
                </div>
            </div>
        </div>
        @include('common.search')
        @include('common.alerts')
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                <thead>
                    <tr>
                        <th class="">CARGO</th>
                        <th class="">ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cargos as $r)
                    <tr>
                        <td>{{$r->cargo}}</td>
                        @if($r->estado == 1)
                            <td class="text-left"><h7 class="text-info">Activo</h7><br></td>
                        @else
                            <td class="text-left"><h7 class="text-danger">Desactivado</h7><br></td>
                        @endif
                        <td class="text-center">
                            @include('common.actions')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$cargos->links()}}
        </div>
    </div>

    @elseif($action == 2)
        @include('livewire.cargo.form')
    @endif
</div>

<script type="text/javascript">
    function Confirm(id){
       let me = this
       swal({
            title: 'CONFIRMAR',
            text: '¿DESEAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false
        }, function() {
            // window.livewire.emit('deleteRow', id)
            swal.close()
        })
   }
</script>
