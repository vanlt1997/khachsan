<?php

namespace App\Service;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{
    protected $user;
    protected $role;
    protected $roleUser;
    const CUSTOMER = 'customer';

    public function __construct(User $user, Role $role, RoleUser $roleUser)
    {
        $this->user = $user;
        $this->role = $role;
        $this->roleUser = $roleUser;
    }

    public function users()
    {
        return $this->user->all();
    }

    public function getCustomers()
    {
        return DB::table('users')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->orWhereNull('user_id')
            ->orWhere('roles.name', self::CUSTOMER)
            ->select('users.id as id', 'users.email as email')
            ->get();
    }

    public function find($userID)
    {
        return $this->user->find($userID);
    }

    public function createOrUpdate($user, $id = null)
    {
        $action = $this->user->find($id) ?? new User();
        $action->name = $user['name'];
        $action->email = $user['email'];
        $action->password = $user['password'] ?? Hash::make($user['phone']);
        if ($id) {
            $action->password = $user['password'] ?? $this->user->find($id)->password;
        }
        $action->sex = $user['sex'];
        $action->phone = $user['phone'];
        $action->address = $user['address'];
        $action->avatar = $user['avatar'] ?? null;
        $action->account = $user['stripeToken'] ?? null;

        $action->save();
    }

    public function delete($user)
    {
        return $this->user->find($user->id)->delete();
    }

    public function sendMailFromAdmin($Ids, $promotions)
    {
        $count = 0;
        if (!$promotions->isEmpty()) {
            foreach ($Ids as $Id) {
                $user = $this->user->find($Id);
                if (isset($user)) {
                    Mail::send('admin.contact.mail-template', ['contact' => $user, 'promotions' => $promotions], function ($message) use ($user) {
                        $message->to($user->email, $user->name)->subject('New Promotions');
                    });
                    $count++;
                }
            }
        }

        return $count;
    }

    public function getUserByEmai($email)
    {
        return $this->user->whereEmail($email)->first();
    }

    public function roles()
    {
        return $this->role->all();
    }

    public function saveRoleUser($id, $roleId)
    {
        $this->roleUser->whereUserId($id)->delete();
        $this->roleUser->create([
            'user_id' => $id,
            'role_id' => $roleId
        ]);
    }
}

