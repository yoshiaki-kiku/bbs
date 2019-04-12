<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Libs\Util;

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

    public function getmessageBrAttribute()
    {
        $util = new Util;
        $message = $util->textBr($this->message);
        return $message;
    }

    /**
     * 1引数で指定されたIDと現在のIDを比較して
     * 同じ場合は値を返す
     *
     * @param [type] $id
     * @param [type] $value
     * @return void
     */
    public function idCheck($id, $value)
    {
        if ($this->id == $id) {
            return $value;
        } else {
            return null;
        }
    }

    /**
     * 親IDでまとめられた、返信コメントの配列、各返信コメント数を返す
     *
     * @param [type] $comments
     * @return Array
     */
    public function getRepliesComment($comments)
    {
        $commentModel = new Comment();
        $comment_id_array = [];

        foreach ($comments as $comment) {
            $comment_id_array[] = $comment->id;
        }

        // トピックにある親コメントIDで必要なコメントで取得
        $commentReplies = $commentModel->with("user")->whereIn('comment_reply', $comment_id_array)->orderBy("created_at", "asc")->get();

        $commentReplyArray = [];
        foreach ($commentReplies as $commentReply) {
            $commentReplyArray[$commentReply->comment_reply][] = $commentReply;
        }

        $commentReplyCountArray = [];
        foreach ($commentReplyArray as $key => $value) {
            $commentReplyCountArray[$key] = count($value);
        }

        return [$commentReplyArray, $commentReplyCountArray];
    }
}
