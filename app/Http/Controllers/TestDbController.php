<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TestDbController extends Controller
{
    static int $i;

    function __construct()
    {
        self::$i = 1;
    }

    public function test_db()
    {
        echo '<pre>';

//        $user = DB::table('my_users')->find(1);
//        echo $user ? json_encode($user) : '';
//        echo "<br>";
//
//
//        $users = DB::table('my_users')->pluck('first_name', 'id');
//        foreach ($users as $id => $first_name) {
//            echo "$id: $first_name <br>";
//        }
//
//        echo "<br>";
//
//        $users = DB::table('my_users')->pluck('first_name');
//        foreach ($users as $first_name) {
//            echo $first_name . ' ';
//        }


//        $logs = DB::table('log_requests')->limit(10)->orderBy('time_add', 'DESC')->get();
//        $logs = DB::table('log_requests')->select('id', 'route_name', 'uuid', 'time_add')
//            ->where('time_add', '1698394402')
//            ->orderBy('id', 'DESC')
//            ->get();
//        foreach ($logs as $log) {
//            echo "$log->id $log->uuid <br>";
//        }

        $query = DB::table('my_users')->select('id', 'first_name');
        $query->addSelect('last_name AS lastName');
        $query->addSelect(DB::raw('"active" AS status'));
        $query->selectRaw('"Undefined" AS field');

        foreach ($query->get() as $user) {
            echo "$user->id $user->first_name $user->lastName $user->status $user->field<br>";
        }


        echo '</pre>';
    }

    public function test_chunk()
    {
        echo '<pre>';

        DB::table('log_requests')->orderBy('id', 'DESC')->limit(100)->chunk(100, function (Collection $logs) {
            // return FALSE; // stop process
            $j = 1;
            foreach ($logs as $log) {
                echo 'i: ' . self::$i . " j: $j $log->time_add ";
                self::$i++;
                $j++;
            }
            echo "<br>";
        });

        echo "</pre>";
    }

    public function test_chunk_by_id()
    {
        DB::table('my_users')->chunkById(2, function (Collection $users) {
            foreach ($users as $user) {
                echo "$user->first_name $user->last_name | ";
            }
            echo '<br>';
        });
    }

    public function test_lazy()
    {
        echo '<pre>';
        DB::table('log_requests')->lazyById(100)->each(function (object $log) {
            echo "$log->uuid <br>";
        });
        echo '</pre>';
    }

    public function test_aggregates()
    {
        echo DB::table('log_requests')->count();
        echo '<br>';
        echo DB::table('log_requests')->avg('time_add');
    }

    public function test_joins()
    {
        $users = DB::table('my_users AS u')
            ->select('u.id', 'u.first_name', 'u.last_name', 's.title AS status_title')
            ->leftJoin('my_users_status AS s', 's.id', '=', 'u.status')
            ->get();

        foreach ($users as $user) {
            echo "$user->id $user->first_name $user->last_name $user->status_title";
            echo '<br>';
        }
        echo '<br>';

        $users = DB::table('my_users AS u')
            ->select('u.id', 'u.first_name', 'u.last_name', DB::raw('IFNULL(s.title, "undefined") AS status_title'))
            ->leftJoin('my_users_status AS s', function (JoinClause $join) {
                $join->on('s.id', '=', 'u.status')
//                    ->orOn('s.id', '>', '1')
                    ->where('s.id', '>', '1');
            })->get();

        foreach ($users as $user) {
            echo "$user->id $user->first_name $user->last_name $user->status_title";
            echo '<br>';
        }

    }

    public function test_union()
    {

        $users_1 = DB::table('my_users')
            ->select('id', 'first_name', 'last_name')
            ->where('id', '=', 1);

        $users = DB::table('my_users')
            ->select('id', 'first_name', 'last_name')
            ->union($users_1)
            ->where('id', '=', 4);

        echo $users->toSql();
        echo '<br>';
        echo $users->toRawSql();
        echo '<br>';

        foreach ($users->get() as $user) {
            echo "$user->id $user->first_name $user->last_name";
            echo '<br>';
        }

    }

    public function test_where()
    {
        $builder = DB::table('my_users')
            ->where('id', '=', 1)
            ->where('first_name', '=', 'Morteza');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->where('id', '=', 1)
            ->orWhere('id', '=', 2);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereIn('id', [1, 2]);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->where([
                ['id', '=', 1],
                ['id', '=', 2]
            ]);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->orWhere([
                ['id', '=', 1],
                ['id', '=', 2]
            ]);
        echo $builder->toRawSql();
        echo '<br>';


        $sql = "SELECT * FROM my_users WHERE (id=1 AND first_name='Morteza') OR id=2";
        $builder = DB::table('my_users')
            ->Where([
                ['id', '=', 1],
                ['first_name', '=', 'Morteza']
            ])->orWhere('id', '=', 2);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->Where('first_name', '=', 'Morteza')
            ->orWhere('id', '=', 2);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->Where('id', '=', 1)
            ->orWhere(function (Builder $builder) {
                $builder->where('first_name', '=', 'Morteza')
                    ->where('last_name', '=', 'Matbou');
            });
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereNot(function (Builder $builder) {
                $builder->where('first_name', '=', 'Morteza');
            });
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->where('id', '!=', 1);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('users')
            ->where('preferences->dining->meal', 'salad');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('users')
            ->whereJsonContains('options->languages', ['en', 'de']);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereBetween('id', [1, 2]);
        echo $builder->toRawSql();
        echo '<br>';

        $user = DB::table('my_users')->select('id')->where('id', '!=', '1');
        $builder = DB::table('my_users')
            ->whereNotIn('id', $user);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereDate('time_add', '=', '1993-02-14');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereYear('time_add', '=', '1993');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereMonth('time_add', '=', '02');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereDay('time_add', '=', '14');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereTime('time_add', '>', '08:30:00');
        echo $builder->toRawSql();
        echo '<br>';


        # column comparisons
        $builder = DB::table('my_users')
            ->whereColumn('first_name', '=', 'last_name');
        echo $builder->toRawSql();
        echo '<br>';


        $builder = DB::table('users')
            ->whereExists(function (Builder $query) {
                $query->select(DB::raw(1))
                    ->from('orders')
                    ->whereColumn('orders.user_id', 'users.id');
            });
        echo $builder->toRawSql();
        echo '<br>';

        // for Models
        $builder = DB::table('my_users')->where('age', '<', function (Builder $query) {
            $query->selectRaw('avg(i.age)')->from('students AS i');
        });
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->whereFullText('bio', 'web developer');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('my_users')
            ->groupBy('first_name', 'last_name');
        echo $builder->toRawSql();
        echo '<br>';

        # throw error when unavailable created_at column
//        $builder = DB::table('my_users')
//            ->latest()->first();
//        echo $builder->toRawSql();
//        echo '<br>';

        $builder = DB::table('log_requests')->limit(100)->inRandomOrder();
        print_r($builder->toSql());
        echo '<br>';
        print_r($builder->latest('time_add')->first('time_add'));
        echo '<br>';

        $result = DB::table('my_users')
            ->inRandomOrder()->first('first_name');
        print_r($result);
        // echo $builder->toRawSql();
        echo '<br>';


        $builder = DB::table('my_users')
            ->orderBy('first_name', 'DESC');
        echo $builder->toRawSql();
        echo '<br>';
        $builder->reorder();
        echo $builder->toRawSql();
        echo '<br>';
        $builder->reorder('last_name', 'ASC');
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('log_requests')->havingBetween('time', [strtotime('-1day'), strtotime('-2day')]);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('log_requests')->havingBetween('time', [strtotime('-1day'), strtotime('-2day')]);
        echo $builder->toRawSql();
        echo '<br>';

        $builder = DB::table('log_requests')
            ->whereBetween(DB::raw('DATE(time_add)'), ['2023-10-27', '2023-10-27'])
            ->whereBetween(DB::raw('TIME(time_add)'), ['17:00:00', '18:00:00']);
        echo $builder->toSql();
        echo '<br>';
        echo $builder->toRawSql();
        echo '<br>';

    }

}
















