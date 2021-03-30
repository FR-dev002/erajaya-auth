<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\RoleUser\RoleUserInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $user;
    protected $roleuser;

    public function __construct(
        ?UserInterface $user,
        ?RoleUserInterface $roleuser
    ) {
        $this->user = $user;
        $this->roleuser = $roleuser;
    }

    public function home()
    {
        return view('user.main');
    }


    public function store(UserRequest $request)
    {
        // construct data
        if ($request->id) {
            $id = $request->id;
            $user = $this->user->getOne('id', $request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->password){
                $user->password = Hash::make($request->password);
            }
            $this->user->update($user);


            $role = $this->roleuser->getOne('user_id', $request->id);
            $role->role_id = $request->role;
            $this->roleuser->update($role);
            return redirect()->route('admin')->with('success', 'Data Berhasil di perbaharui');
        } else {
            $array = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];
            $id = $this->user->store($array);

            $role = [
                'user_id' => $id,
                'role_id' => $request->role
            ];
            $this->roleuser->store($role);

            return redirect()->route('admin')->with('success', 'Data Berhasil di tambahkan');
        }

    }

    public function getAll(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'role',
            4 => 'actions'
        );

        // count data in database

        $totalData = $this->user->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        if ($order == "id") {
            $order = 'users.id';
        }
        $dir = 'DESC';

        if (empty($request->input('search.value'))) {
            $posts = $this->user->getAllWithLimit($start, $limit, $order, $dir);
        } else {
            $search = $request->input('search.value');
            $posts = $this->user->getAllWithSearch($search, $start, $limit, $order, $dir);
            $totalFiltered = $this->user->countWithSearch($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $key => $post) {
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['role'] = $post->roles[0]->name; 
                $nestedData['actions'] = '<div class="btn-group">
                <button type="button" code="' . $post->id . '" class="btn btn-xs ml-2 btn-danger">delete</button>
                <button style="color:white" code="' . $post->id . '" type="button" class="btn ml-2 btn-xs btn-info">Edit</button>
              </div>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return  response()->json($json_data);
    }


    /**
     * @desc Delete data
     */

    public function edit(Int $id)
    {
        $user = $this->user->getOne('id', $id);
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    /**
     * @desc Delete data
     */

    public function delete(Request $request)
    {
        $id = $request->id;
        DB::transaction(function () use ($id) {
            $this->user->delete($id);
            $this->roleuser->delete($id);
        });
        return response()->json(['status' => 'success']);
    }
}
