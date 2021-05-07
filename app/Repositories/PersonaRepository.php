<?php

namespace App\Repositories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonaRepository implements PersonaRepositoryInterface
{
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(Persona $persona) {
        $this->model = $persona;
    }

    public function paginate(int $perPage = 15) {
		return $this->model->orderBy('id','desc')->paginate($perPage);
	}

    public function search(String $search ,int $perPage = 15) {
		return $this->model->where('nombre', 'like', '%'.$search.'%')
                    ->orWhere('dni', 'like', '%'.$search.'%')
                    ->paginate($perPage);
	}

    public function all() {
        return $this->model->all();
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(array $data, $id) {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete(int $id) {
        try {
            $this->model->destroy($id);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function find(int $id) {
        if (null == $user = $this->model->findOrFail($id)) {
            throw new ModelNotFoundException("User not found");
        }
        return $user;
    }
}
