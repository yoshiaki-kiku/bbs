<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = "topics";
    protected $fillable = ["title", "message"];

    public function comment()
    {
        $this->hasMany("App\Comment");
    }

    public function user()
    {
        $this->belongsTo("App\User");
    }
}
