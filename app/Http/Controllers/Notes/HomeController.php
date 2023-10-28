<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('notes.home', [])->with('title', 'Notes');
    }

    public function test()
    {
        DB::update('UPDATE my_users SET first_name=:first_name WHERE id=:id', ['first_name' => 'Morteza', 'id' => 1]);
        // $users = DB::select('SELECT * FROM my_users WHERE id BETWEEN :from AND :to', ['from' => 1, 'to' => 2]);

        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare('SELECT * FROM my_users');


        foreach ($stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_OBJ) : [] as $user) {
            echo "$user->id - $user->first_name $user->last_name <br>";
        }


    }


}
