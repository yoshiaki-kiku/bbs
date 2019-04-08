<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function show($id)
    {
        $commentModel = new Comment();
        $comments = $commentModel->with("user")->where("topic_id", $id)->orderBy("created_at", "desc")->paginate(4);

        foreach($comments as $comment){
            array_push($comment_id_array, $comment->id);
        }


        return view("comment.comment_page", [
            "id" => $id,
            "comments" => $comments,
        ]);
    }
}
