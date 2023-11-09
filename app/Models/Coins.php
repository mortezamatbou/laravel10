<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    use HasFactory;

    protected $table = 'coins';

    protected $fillable = [
        'title',
        'symbol'
    ];

    public $incrementing = TRUE;

    public $primaryKey = 'id';

    public $timestamps = false;

}
