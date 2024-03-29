<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Follow extends Pivot
{
    use HasFactory;

    protected $fillable = ['follower_id', 'user_id'];

    protected $table = 'follows';
}
