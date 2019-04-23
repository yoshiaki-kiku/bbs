<?php

namespace App\Models;

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
        return $this->belongsTo("App\Models\Topic");
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
     * 親IDでまとめられた、返信コメントの配列、各返信コメント数を返す
     *
     * @param [type] $comments
     * @return Array
     */
    public function getRepliesComment($comments)
    {
        $commentModel = new Comment();

        // 返信コメントの抽出に利用
        $comment_id_array = [];
        // 各親コメントの返信コメント数を格納
        $commentReplyCountArray = [];
        // Vueで返信の有無の初期値の設定に利用
        $commentReplyFlagJsonArray = [];

        foreach ($comments as $comment) {
            $comment_id_array[] = $comment->id;
            // 初期値を入れる
            // 返信数0、返信なし(false)
            $commentReplyCountArray[$comment->id] = 0;
            $commentReplyFlagJsonArray[$comment->id] = false;
        }

        // 各親コメントIDで、必要なコメントを取得
        $commentReplies = $commentModel->with("user")->whereIn('comment_reply', $comment_id_array)->orderBy("created_at", "asc")->get();

        // 各親コメントの返信コメントを格納
        $commentReplyArray = [];
        foreach ($commentReplies as $commentReply) {
            $commentReplyArray[$commentReply->comment_reply][] = $commentReply;
        }

        // 返信がある親コメントのステータスを変更する
        foreach ($commentReplyArray as $key => $value) {
            $commentReplyCountArray[$key] = count($value);
            $commentReplyFlagJsonArray[$key] = true;
        }

        return [$commentReplyArray, $commentReplyCountArray, $commentReplyFlagJsonArray];
    }
}
