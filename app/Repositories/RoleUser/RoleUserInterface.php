<?php

namespace App\Repositories\RoleUser;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RoleUserInterface
{

    /**
     * @desc save Data 
     */
    public function store(array $array);


    /**
     * @desc save Data 
     */
    public function getOne(string $column_name, Int $id);


    /**
     * @desc Count All User 
     */
    public function delete(Int $id);



    /**
     * @desc Count All User 
     */
    public function update(Object $roleUser);

}
