<?php

namespace App\Repositories\Role;

use App\Models\Role;

use App\Repositories\Role\RoleInterface;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository extends BaseRepository implements RoleInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * find data Role by Rolename
     */
    public function getAll(): ?Collection
    {
        return $this->model->get();
    }


    /**
     * @desc Save data into database
     */
    public function store(array $array)
    {
        return $this->model->insert($array);
    }
}
