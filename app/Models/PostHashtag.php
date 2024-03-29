<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostHashtag extends Pivot
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $table = 'post_hashtag';
}
