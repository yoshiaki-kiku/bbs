<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CreateComment;

class CommentController extends Controller
{
    public function store(CreateComment $request, $id)
    {
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id = 1;
        $comment->topic_id = $id;
        $comment->save();

        return redirect()->route("topic.page", $id)->with("message", "コメントを投稿しました。");
    }
}
