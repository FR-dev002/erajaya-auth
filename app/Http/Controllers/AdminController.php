<?php

namespace App\Http\Controllers;

use App\Repositories\Role\RoleInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $role;

    public function __construct(
        ?RoleInterface $role
    ) {
        $this->role = $role;
    }

    public function home()
    {
        $roles = $this->role->getAll();
        return view('admin.index', compact('roles'));;
    }
}
