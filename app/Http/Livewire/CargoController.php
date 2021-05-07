<?php

namespace App\Http\Livewire;

use App\Models\Cargo;
use Livewire\Component;
use Livewire\WithPagination;

class CargoController extends Component
{
    use WithPagination;

    public $cargo, $estado = 1;
    private $pagination = 10;
    public $selected_id, $search;
    public $action = 1;

    public function mount() {

    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $cargos = Cargo::where('cargo', 'like', '%'.$this->search.'%')
                ->paginate($this->pagination);

            return view('livewire.cargo.component', [
                "cargos" => $cargos,
            ]);
        }else{
            $cargos = Cargo::orderBy('id','desc')->paginate($this->pagination);

            return view('livewire.cargo.component', [
                "cargos" => $cargos,
            ]);
        }
    }

    public function updatingSearch(){
    	$this->gotoPage(1);
    }

    public function doAction($action){
    	$this->resetInput();
    	$this->action = $action;
    }

    private function resetInput(){
    	$this->cargo = '';
    	$this->estado = 1;
    	$this->selected_id = null;
    	$this->action = 1;
    	$this->search = '';
    }

    public function edit(int $id){
        $record = Cargo::findOrFail($id);

        $this->cargo = $record->cargo;
        $this->estado = $record->estado;
    	$this->selected_id = $id;
    	$this->action = 2;
    }

    public function StoreOrUpdate(){

        $this->validate([
    		'cargo'   => 'required|max:100',
    		'estado'   => 'required',
    	]);

        if($this->selected_id <= 0) {
            Cargo::create([
                "cargo" => $this->cargo,
                "estado" => $this->estado,
            ]);
            $this->emit('msgok', 'Cargo Creado');
        }else{
            Cargo::where('id', $this->selected_id)
            ->update([
                "cargo" => $this->cargo,
                "estado" => $this->estado,
            ]);

            $this->emit('msgok', 'Cargo Actualizado');
        }

        $this->resetInput();
    }

    public function destroy($id){
        try {
            Cargo::destroy($id);
            $this->emit('msgok', "Cargo eliminado de sistema");
        } catch (\Exception $exception) {
            // dd($exception);
            $this->emit('msg-error', "No se pudo eliminar");
        }
    }

    protected $listeners = [
    	'deleteRow'     => 'destroy'
    ];
}
