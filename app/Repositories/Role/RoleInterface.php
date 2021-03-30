<?php

namespace App\Repositories\Role;

use Illuminate\Database\Eloquent\Collection;

interface RoleInterface
{
    /**
     * @desc get all ROle
     */
    public function getAll(): ?Collection;

    /**
     * @desc save Data 
     */
    public function store(array $array);

}
