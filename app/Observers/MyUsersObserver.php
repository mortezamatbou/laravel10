<?php

namespace App\Observers;

use App\Models\MyUsers;

class MyUsersObserver
{
    /**
     * Handle the MyUsers "created" event.
     */
    public function created(MyUsers $myUsers): void
    {
        //
    }

    /**
     * Handle the MyUsers "updated" event.
     */
    public function updated(MyUsers $myUsers): void
    {
        //
    }

    /**
     * Handle the MyUsers "deleted" event.
     */
    public function deleted(MyUsers $myUsers): void
    {
        //
    }

    /**
     * Handle the MyUsers "restored" event.
     */
    public function restored(MyUsers $myUsers): void
    {
        //
    }

    /**
     * Handle the MyUsers "force deleted" event.
     */
    public function forceDeleted(MyUsers $myUsers): void
    {
        //
    }
}
