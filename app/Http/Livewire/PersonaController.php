<?php

namespace App\Http\Livewire;

use App\Models\Base;
use App\Models\Cargo;
use App\Models\Persona;
use App\Models\PersonaBase;
use Livewire\Component;
use Livewire\WithPagination;

class PersonaController extends Component
{
    use WithPagination;

    public $dni, $nombre, $apellido, $direccion, $fecha_nacimiento = null;
    private $pagination = 10;
    public $selected_id, $search, $selected_base, $selected_cargo, $bases, $cargos;
    public $action = 1;

    public function mount() {
        $this->bases = Base::where('estado',1)->get();
        $this->cargos = Cargo::where('estado',1)->get();

        $this->selected_cargo = (count($this->cargos) > 0) ? $this->cargos[0]->id : null;
    }

    public function render() {

        if(strlen($this->search) > 0){
            $personas = PersonaBase::join('personas as p', 'p.id', 'persona_bases.persona_id')
                ->where('p.nombre', 'like', '%'.$this->search.'%')
                ->orWhere('p.dni', 'like', '%'.$this->search.'%')
                ->select('persona_bases.*')
                ->paginate($this->pagination);

            return view('livewire.persona.component', [
                "personas" => $personas,
            ]);
        }else{
            $personas = PersonaBase::orderBy('id','desc')->paginate($this->pagination);

            return view('livewire.persona.component', [
                "personas" => $personas,
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
    	$this->dni = '';
    	$this->nombre = '';
    	$this->apellido = '';
    	$this->direccion = '';
        $this->selected_base = null;
    	$this->fecha_nacimiento = null;
    	$this->selected_id = null;
    	$this->action = 1;
    	$this->search = '';

        $this->selected_cargo = (count($this->cargos) > 0) ? $this->cargos[0]->id : null;
    }

    public function edit(int $id) {
        $record = PersonaBase::findOrFail($id);

        $this->nombre = $record->persona->nombre;
        $this->apellido = $record->persona->apellido;
        $this->dni = $record->persona->dni;
        $this->direccion = $record->persona->direccion;
        $this->fecha_nacimiento = $record->persona->fecha_nacimiento;
    	$this->selected_id = $id;
    	$this->action = 2;
        $this->selected_base = $record->base_id;
        $this->selected_cargo = $record->cargo_id;
    }

    public function StoreOrUpdate(){

        $this->validate([
    		'dni' => ($this->selected_id <= 0)
                        ? 'required|max:8|unique:personas' : 'required|max:8',
    		'nombre'  => 'required|max:100',
    		'apellido'   => 'required|max:100',
    		'direccion'   => 'required|max:100',
    	]);

        if($this->selected_id <= 0) {
            $persona = Persona::create([
                "dni" => $this->dni,
                "nombre" => $this->nombre,
                "apellido" => $this->apellido,
                "direccion" => $this->direccion,
                "fecha_nacimiento" => $this->fecha_nacimiento,
            ]);
            if($this->selected_cargo != null){
                PersonaBase::create([
                    "persona_id" => $persona->id,
                    "base_id" => ($this->selected_base != "") ? $this->selected_base : null,
                    "cargo_id" => $this->selected_cargo,
                ]);
            }
            $this->emit('msgok', 'Usuario Creado');
        }else{
            $personaBase = PersonaBase::find($this->selected_id);
            Persona::where('id', $personaBase->persona_id)
            ->update([
                "nombre" => $this->nombre,
                "apellido" => $this->apellido,
                "direccion" => $this->direccion,
                "fecha_nacimiento" => $this->fecha_nacimiento,
            ]);

            if($this->selected_cargo != null){
                $personaBase->update([
                    "base_id" => ($this->selected_base != "") ? $this->selected_base : null,
                    "cargo_id" => $this->selected_cargo,
                ]);
            }

            $this->emit('msgok', 'Usuario Actualizado');
        }
        $this->resetInput();
    }

    public function destroy($id){
        try {
            $delete = PersonaBase::where('id', $id)->first();
            $delete->delete();
            Persona::destroy($delete->id);
            $this->emit('msgok', "Usuario eliminado de sistema");
        } catch (\Exception $exception) {
            // dd($exception);
            $this->emit('msg-error', "No se pudo eliminar");
        }
    }

    protected $listeners = [
    	'deleteRow'     => 'destroy'
    ];
}
