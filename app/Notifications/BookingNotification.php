<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $order;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user= $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return  ['database', 'broadcast'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'order' => $this->order,
            'user' => $this->user
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'order' => $this->order,
            'user' => $this->user
        ];
    }

}
