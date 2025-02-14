<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categorys';
    protected $fillable = ['name', 'is_deleted'];

    protected $casts = [
        'is_deleted' => 'boolean',
    ];

    protected $dates = ['deleted_at'];
}
