<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Topic extends Model
{
    protected $table = "topics";
    protected $fillable = ["title", "message"];

    public function comment()
    {
        return $this->hasMany("App\Comment");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function getDateAttribute()
    {
        $carbon = new Carbon($this->created_at);
        $date = $carbon->isoFormat('YYYY年MM月DD日 LTS (ddd)');
        return $date;
    }

    /**
     * Topicのコメントの合計数を配列で返す
     *
     * @param [type] $topics
     * @return void
     */
    public function countComment($topics)
    {
        $array = [];
        foreach ($topics as $topic) {
            $commentSum = Comment::where("topic_id", $topic->id)->count();
            array_push($array, $commentSum);
        }

        return $array;
    }
}
