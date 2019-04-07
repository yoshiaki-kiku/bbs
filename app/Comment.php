<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = [
        "message",
        "votes",
    ];

    public function user()
    {
        $this->belongsTo("App\User");
    }

    public function topic()
    {
        $this->belongsTo("App\Topic");
    }
}
