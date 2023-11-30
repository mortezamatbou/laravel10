<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FcmTestNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FcmController extends Controller
{

    protected \Kreait\Firebase\Contract\Messaging $notification;

    function __construct()
    {
        $this->notification = Firebase::messaging();
    }

    public function index(): View
    {
        return \view('fcm.index', ['title' => 'FCM Home']);
    }

    public function push_form(): View
    {
        return \view('fcm.push', ['title' => 'FCM Push']);
    }

    public function push(Request $request)
    {
        $title = $request->post('title');
        $body = $request->post('body');

        // Use by laravel fcm package
        /** @var User $user */
        // $user = User::where('id', 6)->first();
        // $user->notify(new FcmTestNotification);

        // Use by Firebase SDK


        $factory = (new Factory())->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));

//        $message = CloudMessage::withTarget('topic', 'news')
//            ->withNotification(Notification::create('Title', 'Body'))
//            ->withData(['key' => 'value']);

        $config = WebPushConfig::fromArray([
            'notification' => [
                'title' => '$GOOG up 1.43% on the day',
                'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
            ],
            'fcm_options' => [
                'link' => 'https://www.gilaki.net/fcm.php',
            ],
        ]);
        $message = CloudMessage::withTarget('topic', 'news')->withWebPushConfig($config);

        try {
            $factory->createMessaging()->send($message);
        } catch (MessagingException|FirebaseException $e) {
            pre_print($e->getMessage());
        }


    }

}
