<?php

namespace App\Repositories\RoleUser;

use App\Models\RoleUser;

use App\Repositories\RoleUser\RoleUserInterface;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RoleUserRepository extends BaseRepository implements RoleUserInterface
{
    public function __construct(RoleUser $model)
    {
        parent::__construct($model);
    }



    /**
     * @desc Save data into database
     */
    public function store(array $array)
    {
        return $this->model->insert($array);
    }


    public function getOne(string $column_name, int $value)
    {
        return $this->model->where($column_name, $value)->first();
    }

    public function delete(Int $id)
    {
        $this->model->where('user_id', $id)->delete();
    }


    public function update(Object $roleUser)
    {
        return $roleUser->save();
    }
}
