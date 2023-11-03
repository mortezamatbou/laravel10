<?php

namespace App\Http\Controllers;

use App\Models\MyUsers;
use App\Models\MyUsersStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MyUsersController extends Controller
{
    static int $i = 0;

    public function index(Request $request)
    {
        $user = MyUsers::where('status', 1)->first();

        $user->first_name = 'Ali';
        echo "$user->first_name $user->last_name $user->status<br>";
        $o = $user->fresh();
        echo "$o->first_name $o->last_name $o->status<br>";
        echo "$user->first_name $user->last_name $user->status<br>";
        $user->refresh();
        echo "$user->first_name $user->last_name $user->status<br>";

        // ----------------------------------------------------------------------

//        $users = MyUsers::all();
//        foreach ($users as $user) {
//            echo "$user->first_name $user->last_name $user->status<br>";
//        }

        // ----------------------------------------------------------------------

        MyUsers::whereIn('status', [1, 2, 3])->chunkById(2, function (Collection $users_chunk) {
            foreach ($users_chunk as $users) {
                echo self::$i . "- $users->first_name $users->last_name $users->status<br>";
            }
            self::$i++;
        });

        MyUsers::chunkById(1, function (Collection $users) {
            $users->each->update(['status' => 1]);
//            $users->each(function (MyUsers $user) {
//                $user->status = 1;
//                $user->save();
//            });
        }, $column = 'id');


    }

    public function advanceSelect()
    {

        $users = MyUsers::whereIn('status', [1, 2, 3])->addSelect([
            'status_title' => MyUsersStatus::select('title')
                ->whereColumn('id', 'my_users.status')
        ])->get();

        foreach ($users as $user) {
            echo "$user->first_name $user->last_name $user->status_title<br>";
        }


        $user = MyUsers::findOr(10, function () {
            return NULL;
        });

        echo $user ? "$user->first_name $user->last_name" : 'user not found';
        echo '<br>';

        // $user = MyUsers::findOrFail(10);

    }

    public function insertNewUser()
    {

//        $user = new MyUsers();
//        $user->first_name = "Javad";
//        $user->last_name = "Mohebi";
//
//        $user->save();

        $user = MyUsers::create([
            'first_name' => 'Morteza',
            'last_name' => 'Ghorbani',
            // 'status' => 1
        ]);
        echo "'$user->first_name $user->last_name' added successfully<br>";
    }

    public function checkState()
    {
        $user = MyUsers::find(1);
        echo ($user->isDirty() ? 'isDirty' : 'isClean') . '<br>';
        echo "$user->first_name $user->last_name<br>";
        $user->first_name = 'Ali';
        echo ($user->isDirty() ? 'isDirty' : 'isClean') . '<br>';
        $user->first_name = 'Morteza';
        echo ($user->isDirty() ? 'isDirty' : 'isClean') . '<br>';
        $user->first_name = 'morteza';
        echo ($user->isDirty() ? 'isDirty' : 'isClean') . '<br>';


        $user = MyUsers::find(1);
        $user->first_name = 'Morteza';
        $user->save();
        echo ($user->wasChanged() ? 'wasChanged' : '!wasChanged') . '<br>';
        $user->first_name = 'Morteza2';
        $user->save();
        echo ($user->wasChanged() ? 'wasChanged' : '!wasChanged') . '<br>';
        $user->first_name = 'Morteza';
        $user->save();
        echo ($user->wasChanged('first_name') ? 'my_users.first_name wasChanged' : 'my_users.first_name !wasChanged') . '<br>';
        echo ($user->wasChanged('last_name') ? 'my_users.last_name wasChanged' : 'my_users.last_name !wasChanged') . '<br>';

        $user = MyUsers::find(1);
        print_r($user->getOriginal());
        echo '<br>';
        $user->first_name = "Ali";
        $user->last_name = "Jahani";
        echo "$user->first_name $user->last_name $user->status<br>";
        print_r($user->getOriginal());
        echo '<br>';

    }

    public function massAssignment()
    {

        $status = '';

        // throw an error on status is null
        // don't use status default value in MyUsers model
//        $added_user = MyUsers::create(
//            [
//                'first_name' => 'Ahmad',
//                'last_name' => 'Niyazi',
//                'status' => $status
//            ]
//        );
//        echo "$added_user->first_name $added_user->last_name added successfully";

        /**
         * $added_user = MyUsers::create([
         * 'first_name' => 'Ahmad',
         * 'last_name' => 'Niyazi',
         * ]);
         * echo "$added_user->first_name $added_user->last_name added successfully<br>";
         **/

        // throw an error
        // because last_name has in fillable array but is not set in create function
        $added_user = MyUsers::create([
            'first_name' => 'Jafar',
            // 'last_name' => 'Niyazi',
            // 'status' => 1 // this parameter has default value at MyUsers.$attributes
        ]);
        echo "$added_user->first_name $added_user->last_name added successfully<br>";


    }

    public function checkEvents(): void
    {
        $user = MyUsers::withoutEvents(function() {
            $user =MyUsers::findOrFail(1);
            $user->first_name = 'Morteza_';
            // $user->save();
        });

        $user = MyUsers::findOrFail(1);
        $user->first_name = 'Morteza_';
        # mute event temporarily
        // $user->saveQuietly();
        // $user->deleteQuietly();
        // $user->forceDeleteQuietly();
        // $user->restoreQuietly();
    }

}
