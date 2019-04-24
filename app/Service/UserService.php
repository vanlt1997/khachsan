<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

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

    public function find($userID)
    {
        return $this->user->find($userID);
    }

    public function createOrUpdate($user, $id = null)
    {
        $action = $this->user->find($id) ?? new User();
        $action->name = $user['name'];
        $action->email = $user['email'];
        $action->password = $user['password']?? null;
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
}

