<?php

namespace App\Http\Livewire;

use App\Models\Base;
use Livewire\Component;
use Livewire\WithPagination;

class BaseController extends Component
{
    use WithPagination;

    public $base, $estado = 1, $direccion;
    private $pagination = 10;
    public $selected_id, $search;
    public $action = 1;

    public function mount() {

    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $bases = Base::where('base', 'like', '%'.$this->search.'%')
                ->paginate($this->pagination);

            return view('livewire.base.component', [
                "bases" => $bases,
            ]);
        }else{
            $bases = Base::orderBy('id','desc')->paginate($this->pagination);

            return view('livewire.base.component', [
                "bases" => $bases,
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
    	$this->base = '';
    	$this->direccion = '';
    	$this->estado = 1;
    	$this->selected_id = null;
    	$this->action = 1;
    	$this->search = '';
    }

    public function edit(int $id){
        $record = Base::findOrFail($id);

        $this->base = $record->base;
        $this->direccion = $record->direccion;
        $this->estado = $record->estado;
    	$this->selected_id = $id;
    	$this->action = 2;
    }

    public function StoreOrUpdate(){

        $this->validate([
    		'base'   => 'required|max:70',
    		'direccion'   => 'required|max:100',
    		'estado'   => 'required',
    	]);

        if($this->selected_id <= 0) {
            Base::create([
                "base" => $this->base,
                "direccion" => $this->direccion,
                "estado" => $this->estado,
            ]);
            $this->emit('msgok', 'Base Creada');
        }else{
            Base::where('id', $this->selected_id)
            ->update([
                "base" => $this->base,
                "direccion" => $this->direccion,
                "estado" => $this->estado,
            ]);

            $this->emit('msgok', 'Base Actualizada');
        }

        $this->resetInput();
    }

    public function destroy($id){
        try {
            Base::destroy($id);
            $this->emit('msgok', "Base eliminada del sistema");
        } catch (\Exception $exception) {
            // dd($exception);
            $this->emit('msg-error', "No se pudo eliminar");
        }
    }

    protected $listeners = [
    	'deleteRow'     => 'destroy'
    ];
}
