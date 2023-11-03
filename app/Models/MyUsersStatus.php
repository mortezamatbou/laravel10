<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyUsersStatus extends Model
{
    use HasFactory;

    protected $table = 'my_users_status';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    public $attributes = [
        'id',
        'title'
    ];

    public $fillable = [
        'title'
    ];

}
