<?php
/**
 * Created by PhpStorm.
 * User: levan
 * Date: 25/03/2019
 * Time: 21:57
 */

namespace App\Service;


use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    const EMAIL_ADMIN = 'maystarhotel@gmail.com';

    private $contact;

    public function __construct(Contact $contact)
    {

        $this->contact = $contact;
    }

    public function sendMail($dataInput)
    {
        DB::transaction(function () use ($dataInput) {
            $this->sendMailToAdmin($dataInput);
            $this->comfirm($dataInput);
            $this->create($dataInput);
        });
    }

    protected function sendMailToAdmin($data)
    {
        Mail::send('client.template.sendmail', ['mail' => $data], function ($mes) use ($data) {
            $mes->from($data->email, $data->name);
            $mes->to(self::EMAIL_ADMIN, 'Admin Hotel')->subject($data->title);
        });
    }

    protected function comfirm($data)
    {
        Mail::send('client.template.confirm', [], function ($mes) use ($data) {
            $mes->to($data->email, $data->name)->subject('Thank you !');
        });
    }

    protected function create($contact)
    {
        $action = new Contact();
        $action->name = $contact->name;
        $action->email = $contact->email;
        $action->title = $contact->title;
        $action->content = $contact->content;
        $action->save();
    }

    public function contacts()
    {
        return $this->contact->all();
    }

    public function delete($Ids)
    {
        return $this->contact->whereIn('id', $Ids)->delete();
    }

    public function sendMailFromAdmin($Ids, $promotions)
    {
        $count = 0;
        if (!$promotions->isEmpty()) {
            foreach ($Ids as $Id) {
                $contact = $this->contact->find($Id);
                if (isset($contact)) {
                    Mail::send('admin.contact.mail-template', ['contact' => $contact, 'promotions' => $promotions], function ($message) use ($contact) {
                        $message->to($contact->email, $contact->name)->subject('New Promotions');
                    });
                    $count++;
                }
            }
        }

        return $count;
    }
}
