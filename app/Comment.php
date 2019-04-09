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

    /**
     * 親IDでまとめられた、返信コメントの配列を返す
     *
     * @param [type] $comments
     * @return void
     */
    public function getRepliesComment($comments)
    {
        $commentModel = new Comment();
        $comment_id_array = [];

        foreach ($comments as $comment) {
            $comment_id_array[] = $comment->id;
        }

        $commentReplies = $commentModel->with("user")->whereIn('comment_reply', $comment_id_array)->orderBy("created_at", "asc")->get();

        $commentReply_array = [];

        foreach ($commentReplies as $commentReply) {
            $commentReply_array[$commentReply->comment_reply][] = $commentReply;
        }

        return $commentReply_array;
    }
}
