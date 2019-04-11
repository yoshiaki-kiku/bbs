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
            $this->newComment($request, $id);
        } elseif (Input::get('replyComment')) {
            $this->replyComment($request, $id);
        }

        return redirect()->route("topic.page", $id);
    }

    public function newComment(CreateComment $request, $id)
    {
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id = $request->user()->id;
        $comment->topic_id = $id;
        $comment->save();

        return redirect()->route("topic.page", $id)->with("message", "コメントを投稿しました。");
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

        return redirect()->route("topic.page", $id)->with("message", "返信を投稿しました。");
    }
}
