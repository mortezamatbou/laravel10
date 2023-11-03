<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Illuminate\Events\queueable;

class MyUsers extends Model
{
    use HasFactory;

    protected $table = 'my_users';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    protected $attributes = [
        'status' => 3
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'is_sejami->is_sejami'
    ];

    // empty array -> all attributes mass assignable
    //
    protected $guarded = [];


    // using model event closures
    protected static function booted(): void
    {
//        static::created(function (MyUsers $user) {
//            // do something
//        });

//        static::created(queueable(function (MyUsers $user) {
//            // do something as queueable anonymous event listeners
//        }));

    }

}
