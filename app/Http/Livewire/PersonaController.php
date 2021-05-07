<?php

namespace App\Http\Livewire;

use App\Repositories\PersonaRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class PersonaController extends Component
{
    use WithPagination;

    public $dni, $nombre, $apellido, $direccion, $fecha_nacimiento;
    private $repository, $pagination = 5;
    public $selected_id, $search;
    public $action = 1;

    public function mount(PersonaRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function render(PersonaRepositoryInterface $repository) {
        $this->repository = $repository;

        if(strlen($this->search) > 0){
            $personas = $this->repository->search($this->search, $this->pagination);

            return view('livewire.persona.component', [
                "personas" => $personas,
            ]);
        }else{
            $personas = $this->repository->paginate($this->pagination);

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
    	$this->fecha_nacimiento = '';
    	$this->selected_id = null;
    	$this->action = 1;
    	$this->search = '';
    }

    public function edit(int $id, PersonaRepositoryInterface $repository){
        $this->repository = $repository;
        $record = $this->repository->find($id);

        $this->nombre = $record->nombre;
        $this->apellido = $record->apellido;
        $this->dni = $record->dni;
        $this->direccion = $record->direccion;
        $this->fecha_nacimiento = $record->fecha_nacimiento;
    	$this->selected_id = $id;
    	$this->action = 2;
    }

    public function StoreOrUpdate(PersonaRepositoryInterface $repository){
        $this->repository = $repository;

        $this->validate([
    		'dni' => ($this->selected_id <= 0)
                        ? 'required|max:8|unique:personas' : 'required|max:8',
    		'nombre'  => 'required|max:100',
    		'apellido'   => 'required|max:100',
    		'direccion'   => 'required|max:100',
    	]);

        if($this->selected_id <= 0) {
            $this->repository->create([
                "dni" => $this->dni,
                "nombre" => $this->nombre,
                "apellido" => $this->apellido,
                "direccion" => $this->direccion,
                "fecha_nacimiento" => $this->fecha_nacimiento,
            ]);
            $this->emit('msgok', 'Usuario Creado');
        }else{
            $this->repository->update([
                "nombre" => $this->nombre,
                "apellido" => $this->apellido,
                "direccion" => $this->direccion,
                "fecha_nacimiento" => $this->fecha_nacimiento,
            ], $this->selected_id);

            $this->emit('msgok', 'Usuario Actualizado');
        }

        $this->resetInput();
    }

    public function infoUpdate($data) {
        $this->nombre = $data['nombres'];
        $this->apellido = $data['apellidoPaterno'].' '.$data['apellidoMaterno'];
    }

    public function destroy($id, PersonaRepositoryInterface $repository){
        $this->repository = $repository;

        if($this->repository->delete($id)){
            $this->emit('msgok', "Usuario eliminado de sistema");
        }else{
            $this->emit('msg-error', "No se pudo eliminar");
        }
    }

    protected $listeners = [
        'updateDatos' => 'infoUpdate',
    	'deleteRow'     => 'destroy'
    ];
}
