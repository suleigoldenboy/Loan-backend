<?php
namespace App\Notifications;

use NotificationChannels\AfricasTalking\AfricasTalkingChannel;
use NotificationChannels\AfricasTalking\AfricasTalkingMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class VerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $token;
    public function __construct(Int $token) {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [AfricasTalkingChannel::class];
    }

    public function toAfricasTalking($notifiable)
    {
		return (new AfricasTalkingMessage())
                    ->content('Your Verification Code is: '.$this->token);
    }
}
