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

    /**
     * Topicのコメントの合計数を配列で返す
     *
     * @param [type] $topics
     * @return void
     */
    public static function countComment($topics)
    {
        $array = [];
        foreach ($topics as $topic) {
            $commentSum = Comment::where("topic_id", $topic->id)->count();
            array_push($array, $commentSum);
        }

        return $array;
    }
}
