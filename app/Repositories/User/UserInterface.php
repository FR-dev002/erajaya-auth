<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

interface UserInterface
{
    /**
     * @desc search user by $column_name
     */
    public function findByUsername(string $column_name, string $username): ?Model;


    /**
     * @desc serach user by 
     */
    public function findBy(string $column_name, string $value): ?Collection;

    /**
     * @desc serach user by 
     */
    public function getOne(string $column_name, string $value): ?Model;


    /**
     * @desc save Data 
     */
    public function store(array $array);


    public function findByExcept(string $column_name, string $value, int $id): ?Collection;


    /**
     * @desc save Data 
     */
    public function update(object $array);


    /**
     * @desc Count All User 
     */
    public function count(): Int;
    


    /**
     * @desc Count All User 
     */
    public function delete(Int $id);


    /**
     * @desc Get all data With limit
     */
    public function getAllWithLimit($start, $limit, $order, $dir);


    /**
     * @desc datatable Search
     */
    public function getAllWithSearch($search, $start, $limit, $order, $dir);



    /**
     * @desc Hitung jumlah data yang masuk ke dalam kondisi search
     */
    public function countWithSearch($search);

}
