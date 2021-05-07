<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all();
    public function paginate(int $perPage);
    public function create(array  $data);
    public function update(array $data, $id);
    public function delete(int $id);
    public function find(int $id);
}
