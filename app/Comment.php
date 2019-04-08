<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = [
        "message",
        "votes",
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function topic()
    {
        return $this->belongsTo("App\Topic");
    }

    public function getDateAttribute()
    {
        $carbon = new Carbon($this->created_at);
        $date = $carbon->isoFormat('YYYY年MM月DD日 LTS (ddd)');
        return $date;
    }
}
