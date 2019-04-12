<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CreateComment;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{
    public function store(CreateComment $request, $id)
    {
        if (Input::get('newComment')) {
            $comment_id = $this->newComment($request, $id);
            $message = "コメントを投稿しました。";
        } elseif (Input::get('replyComment')) {
            $comment_id = $this->replyComment($request, $id);
            $message = "返信を投稿しました。";
        }

        // 挿入コメントの位置に移動
        return redirect()->route("topic.page", $id . "#{$comment_id}")->with([
            "message" => $message,
            "new_comment_id" => $comment_id
        ]);
    }

    public function newComment(CreateComment $request, $id)
    {
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id = $request->user()->id;
        $comment->topic_id = $id;
        $comment->save();

        // 挿入したIDを返す
        return $comment->id;
    }

    /**
     * 返信コメント用の処理
     *
     * @param CreateComment $request
     * @param [type] $id
     * @return void
     */
    public function replyComment(CreateComment $request, $id)
    {
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id = $request->user()->id;
        $comment->topic_id = $id;
        $comment->comment_reply = $request->comment_reply_id;
        $comment->save();

        // 挿入したIDを返す
        return $comment->id;
    }
}
