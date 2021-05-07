<?php

namespace App\Repositories;

interface PersonaRepositoryInterface extends RepositoryInterface
{
    public function search(String $search,int  $perPage);
}
