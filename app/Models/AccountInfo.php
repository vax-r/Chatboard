<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountInfo extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "AccountInfo";
    // protected $dates = ["deleted_at"];

    protected $fillable = [
        'id',
        'user_name',
        'password',
        'violate_count'
    ];
}

