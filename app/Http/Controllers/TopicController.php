<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;

class TopicController extends Controller
{
    public function index()
    {
        $topicModel = new Topic();
        $topics = $topicModel::orderBy("created_at", "desc")->take(6)->paginate(5);
        $numberOfComments = $topicModel->countComment($topics);

        return view("topic.topic_list", [
            "topics" => $topics,
            "numberOfComments" => $numberOfComments
        ]);
    }

    public function show($id)
    {
        $commentModel = new Comment();
        $comments = $commentModel->with("user")->where([["topic_id", $id], ["comment_reply", 0]])->orderBy("created_at", "desc")->paginate(4);
        $commentReplies = $commentModel->getRepliesComment($comments);

        return view("topic.topic_page", [
            "id" => $id,
            "comments" => $comments,
            "commentReplies" => $commentReplies,
        ]);
    }
}
