<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactEmailNotify extends Notification
{
    use Queueable;
    private $datas;

    /**
     * Create a new notification instance.
     */
    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting("New Contact Created")
                    ->line("Full Name : ".$this->datas['firstname']. " ". $this->datas['lastname'] )
                    ->line("Birth Day : ".$this->datas['birthday'])
                    ->line("Relative : ".$this->datas['relative'])
                    ->action('Visit Site', url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
// php artisan make:notification ContactEmailNotify 