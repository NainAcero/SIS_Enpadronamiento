<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        @if($action == 1)
        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5><b>Personas en el Sistema</b></h5>
                </div>
            </div>
        </div>
        @include('common.search')
        @include('common.alerts')
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                <thead>
                    <tr>
                        <th class="">DNI</th>
                        <th class="">APELLIDO, NOMBRE</th>
                        <th class="">DIRECCIÓN</th>
                        <th class="">FECHA NACIMIENTO</th>
                        <th class="">CARGO</th>
                        <th class="">BASE</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $r)
                    <tr>
                        <td>{{$r->persona->dni}}</td>
                        <td>{{$r->persona->apellido}} , {{$r->persona->nombre}}</td>
                        <td>{{$r->persona->direccion}}</td>
                        <td>
                            {{ ($r->persona->fecha_nacimiento != null)
                                ? \Carbon\Carbon::parse($r->persona->fecha_nacimiento)->format('d-m-Y') : '' }}
                        </td>
                        <td>{{ $r->cargo->cargo ?? '' }}</td>
                        <td>{{ $r->base->base ?? '' }}</td>

                        <td class="text-center">
                            @include('common.actions')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$personas->links()}}
        </div>
    </div>

    @elseif($action == 2)
        @include('livewire.persona.form')
    @endif
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        window.livewire.on('imagenChoosen', () => {

            let inputField = document.getElementById('image')
            let file = inputField.files[0]
            let reader = new FileReader()
            reader.onloadend = () => {
                window.livewire.emit('fotoUpload', reader.result)
            }
            reader.readAsDataURL(file)
        })

        window.livewire.on('firmaChoosen', () => {

            let inputField = document.getElementById('image')
            let file = inputField.files[0]
            let reader = new FileReader()
            reader.onloadend = () => {
                window.livewire.emit('firmaUpload', reader.result)
            }
            reader.readAsDataURL(file)
        })
    })

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
            window.livewire.emit('deleteRow', id)
            swal.close()
        })
   }
</script>
