<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function getList()
    {
        return DataTables::of($this->userService->users())
            ->addColumn('action', function ($user) {
                return
                    '<a href="users/' . $user->id . '/detail" class="btn btn-sm btn-outline-warning"> <i class="fa fa-info"></i></a>
                    <a href="users/' . $user->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="users/' . $user->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.user.form');
    }

    public function actionCreate(UserRequest $request)
    {
        $this->userService->createOrUpdate($request);

        return redirect()->route('admin.users.index')->with('message', 'Create User Successfully !');
    }

    public function detail(User $user)
    {

    }

    public function edit(User $user)
    {
        return view('admin.user.form', compact('user'));
    }

    public function actionEdit(UserRequest $request, User $user)
    {
        $this->userService->createOrUpdate($request, $user->id);

        return redirect()->route('admin.users.index')->with('message', 'Edit User Successfully !');
    }

    public function delete(User $user)
    {
        if ($user->orders->isEmpty()) {
            $this->userService->delete($user);

            return redirect()->route('admin.users.index')->with('message', 'Delete User Successfully !');
        }

        return redirect()->route('admin.users.index')->with('error', 'You Can\'t Delete User');
    }

}

