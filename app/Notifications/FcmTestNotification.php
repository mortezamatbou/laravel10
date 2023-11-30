<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class FcmTestNotification extends Notification
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
        return [FcmChannel::class];
    }

    public function toFcm($notifiable): FcmMessage
    {
        $notification = new FcmNotification();
        $notification->setTitle("Title");
        $notification->setBody("Body");

        $message = new FcmMessage();
        $message->setWebpush(['data1' => 'value', 'data2' => 'value2']);

        return $message;

//        return (new FcmMessage(notification: new FcmNotification(
//            title: 'Account Activated',
//            body: 'Your account has been activated.',
//            image: 'http://example.com/url-to-image-here.png'
//        )))->data(['data1' => 'value', 'data2' => 'value2'])
//            ->custom([
//                'android' => [
//                    'notification' => [
//                        'color' => '#0A0A0A',
//                    ],
//                    'fcm_options' => [
//                        'analytics_label' => 'analytics',
//                    ],
//                ],
//                'apns' => [
//                    'fcm_options' => [
//                        'analytics_label' => 'analytics',
//                    ],
//                ],
//                'webpush' => [
//                    'fcm_options' => [
//                        'analytics_label' => 'analytics',
//                    ],
//                ]
//            ]);
    }

}
