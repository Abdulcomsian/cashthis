<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class contactUsNotification extends Notification
{
    use Queueable;



    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $subject;
    public $message;
    public function __construct($subject, $message, $email, $first_name, $last_name)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($this->message);
        return (new MailMessage)
                    ->subject($this->subject)
                    ->from(env('MAIL_FROM_ADDRESS'))
                    ->view('emails.customEmail', [
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'email' => $this->email,
                        'line' => $this->message, 
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
