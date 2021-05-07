<div class="widget-content-area ">
    <div class="widget-one">
        <form>
            <div class="row">
                <h5 class="col-sm-12 text-center">Gestionar Bases</h5>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 mt-2">
                    <label >Nombre *</label>
                    <input wire:model.lazy="base" type="text"  class="form-control"  placeholder="nombre">
                    @error('base') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 mt-2">
                    <label >Estado *</label>
                    <select class="form-control" wire:model.lazy="estado" >
                        <option value="1">Activo</option>
                        <option value="0">Desactivado</option>
                    </select>
                    @error('estado') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label >Dirección *</label>
                    <input wire:model.lazy="direccion" type="text" class="form-control"  placeholder="dirección...">
                    @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
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
