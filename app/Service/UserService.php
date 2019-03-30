<?php

namespace App\Service;

use App\Models\User;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function users()
    {
        return $this->user->all();
    }

    public function createOrUpdate($user, $id = null)
    {
        $action = $this->user->find($id) ?? new User();
        $action->name = $user->name;
        $action->email = $user->email;
        $action->password = $user->password?? null;
        $action->sex = $user->sex;
        $action->phone = $user->phone;
        $action->address = $user->address;
        $action->avatar = $user->avatar ?? null;
        $action->save();
    }

    public function delete($user)
    {
        return $this->user->find($user->id)->delete();
    }
}

