<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SlackNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SlackController extends Controller
{

    public function index(): View
    {
        return \view('slack.index', ['title' => 'Slack Home']);
    }

    public function hook(): void
    {
        $user = User::where('id', 6)->first();
        $user->notify(new SlackNotification());
    }

}
