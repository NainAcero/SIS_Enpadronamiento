<div class="widget-content-area ">
    <div class="widget-one">
        <form>
            <div class="row">
                <h5 class="col-sm-12 text-center">Gestionar Personas</h5>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >DNI *</label>
                    <input wire:model.lazy="dni" type="number" id="dni" class="form-control"  placeholder="dni" {{ $this->selected_id <=0 ? '' : 'disabled' }}>
                    @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >Nombre *</label>
                    <input wire:model.lazy="nombre" id="nombre" type="text" class="form-control"  placeholder="nombre">
                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >Apellido *</label>
                    <input wire:model.lazy="apellido" id="apellido" type="text" class="form-control"  placeholder="apellido">
                    @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-sm-8">
                    <label >Dirección *</label>
                    <input wire:model.lazy="direccion" type="text" class="form-control"  placeholder="dirección...">
                    @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >Fecha Nacimiento</label>
                    <input wire:model.lazy="fecha_nacimiento" type="date" class="form-control" >
                    @error('fecha_nacimiento') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label >Cargo </label>
                    <select class="form-control" wire:model="selected_cargo">
                        @foreach ($cargos as $cargo)
                            <option value='{{ $cargo->id }}'>{{ $cargo->cargo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label >Base </label>
                    <select class="form-control" wire:model="selected_base">
                        <option value="" >Seleccionar Base</option>
                        @foreach ($bases as $base)
                            <option value='{{ $base->id }}'>{{ $base->base }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-5 mt-2  text-left">
                    <button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
                        <i class="mbri-left"></i> Regresar
                    </button>
                    <button type="button"
                        wire:click="StoreOrUpdate() "
                        class="btn btn-primary ml-2">
                        <i class="mbri-success"></i> Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    $('#dni').keyup(function(e) {
        if(e.keyCode==13){
            const url = `https://dniruc.apisperu.com/api/v1/dni/${ $("#dni").val() }?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFfbmFjZXJvbUB1bmpiZy5lZHUucGUifQ.NcV9aUSUuJ0Wul85yvonhMfhzfBcvw7zuXdXZCD6P0A`;
            $.getJSON(url, onPersonLoaded);
        }
    });

    function onPersonLoaded(data) {
        if(data.dni != null && data.nombres != null){
            @this.set('nombre', data.nombres);
            @this.set('apellido', data.apellidoPaterno + ' ' + data.apellidoMaterno);
            toastr.success(data.nombres, 'Usuario Encontrado')
            window.livewire.emit('updateDatos', data);
        }
    }
</script>
