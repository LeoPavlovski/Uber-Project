<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class LoginNeedsVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //channel
        return [TwilioChannel::class];
    }
    /**
     * Get the mail representation of the notification.
     */

    public function toTwilio($notifiable)
    {
        $loginCode = rand(111111, 999999);
        //when the user verifies , we need to store it to the user model
        //with this code here we are sending the code to that specific user.
        //starting code it's null , so we need to take that code that we arse generating and sotre it to the database
        $notifiable->update([
           'login_code'=>$loginCode,
        ]);
        return (new TwilioSmsMessage())->content("Enter this code to validate your account. Зејтинот е на наша сметка. {$loginCode}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
