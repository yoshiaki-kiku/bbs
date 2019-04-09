<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function show($id)
    {
        $commentModel = new Comment();
        $comments = $commentModel->with("user")->where([["topic_id", $id], ["comment_reply", 0]])->orderBy("created_at", "desc")->paginate(4);
        $commentReplies = $commentModel->getRepliesComment($comments);

        return view("comment.comment_page", [
            "id" => $id,
            "comments" => $comments,
            "commentReplies" => $commentReplies,
        ]);
    }
}
