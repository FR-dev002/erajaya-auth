<?php

namespace App\Repositories\User;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\User\UserInterface;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * find data user by username
     */
    public function findByUsername(string $column_name, string $username): ?Model
    {
        return $this->model->where($column_name, $username)->first();
    }


    /**
     * find data user by email/nip
     */
    public function findBy(string $column_name, string $value): ?Collection
    {
        return $this->model
        ->with(['roles'])
        ->where($column_name, $value)->get();
    }

    /**
     * find data user by email/nip
     */
    public function getOne(string $column_name, string $value): ?Model
    {
        return $this->model
            ->with(['roles'])
            ->where($column_name, $value)->first();
    }


    public function findByExcept(string $column_name, string $value, int $id): ?Collection
    {
        return $this->model
            ->where($column_name, $value)
            ->where('id', '!=', $id)
            ->get();
    }

    /**
     * @desc Save data into database
     */
    public function store(array $array)
    {
        return $this->model->insertGetId($array);
    }


    /**
     * @desc Save data into database
     */
    public function update(object $user)
    {
        return $user->save();
    }


    public function count(): Int
    {
        return $this->model->count();
    }

    public function delete(Int $id)
    {
        $this->model->where('id', $id)->delete();
    }



    /**
     * 
     */
    public function getAllWithLimit($start, $limit, $order, $dir)
    {
        return $this->model
        ->with(['roles'])
        ->select('users.*')
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    }


    public function getAllWithSearch($search, $start, $limit, $order, $dir)
    {
        return $this->model
        ->with(['roles'])
        ->select('users.*')
        ->role()
        ->where(function ($q) use ($search) {
            $q->where('id', 'LIKE', "%{$search}%")
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    }


    public function countWithSearch($search)
    {
        return $this->model
            ->with(['roles'])
            ->select('users.*')
            ->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->count();
    }
}
