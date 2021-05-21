<div class="widget-content-area ">
    <div class="widget-one">
        <form>
            <div class="row">
                <h5 class="col-sm-12 text-center">Gestionar Profesiones</h5>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 mt-2">
                    <label >Nombre *</label>
                    <input wire:model.lazy="name" type="text"  class="form-control"  placeholder="Nombre">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 mt-2">
                    <label >Descripcion *</label>
                    <textarea wire:model.lazy="descripcion" class="form-control" rows="4"></textarea>
                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
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
