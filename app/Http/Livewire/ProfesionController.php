<?php

namespace App\Http\Livewire;

use App\Models\Profesion;
use Livewire\Component;
use Livewire\WithPagination;

class ProfesionController extends Component
{
    use WithPagination;

    public $name, $descripcion;
    private $pagination = 10;
    public $selected_id, $search;
    public $action = 1;

    public function render()
    {
        if(strlen($this->search) > 0){
            $profesiones = Profesion::where('name', 'like', '%'.$this->search.'%')
                ->paginate($this->pagination);

            return view('livewire.profesion.component', [
                "profesiones" => $profesiones,
            ]);
        }else{
            $profesiones = Profesion::orderBy('id','desc')->paginate($this->pagination);

            return view('livewire.profesion.component', [
                "profesiones" => $profesiones,
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
    	$this->name = '';
    	$this->descripcion = '';
    	$this->selected_id = null;
    	$this->action = 1;
    	$this->search = '';
    }

    public function edit(int $id){
        $record = Profesion::findOrFail($id);

        $this->name = $record->name;
        $this->descripcion = $record->descripcion;
    	$this->selected_id = $id;
    	$this->action = 2;
    }

    public function StoreOrUpdate(){

        $this->validate([
    		'name'   => 'required|max:100',
    		'descripcion'   => 'max:200',
    	]);

        if($this->selected_id <= 0) {
            Profesion::create([
                "name" => $this->name,
                "descripcion" => $this->descripcion,
            ]);
            $this->emit('msgok', 'Cargo Creado');
        }else{
            Profesion::where('id', $this->selected_id)
            ->update([
                "name" => $this->name,
                "descripcion" => $this->descripcion,
            ]);

            $this->emit('msgok', 'Cargo Actualizado');
        }

        $this->resetInput();
    }

    public function destroy($id){
        try {
            Profesion::destroy($id);
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
