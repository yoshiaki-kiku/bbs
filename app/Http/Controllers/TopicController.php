<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use App\Http\Requests\CreateTopic;

class TopicController extends Controller
{
    public function index()
    {
        $topicModel = new Topic();
        $topics = $topicModel::orderBy("created_at", "desc")->paginate(5);
        $numberOfComments = $topicModel->countComment($topics);

        return view("topic.topic_list", [
            "topics" => $topics,
            "numberOfComments" => $numberOfComments
        ]);
    }

    public function show(Topic $topic)
    {

        $commentModel = new Comment();
        $comments = $commentModel->with("user")->where([["topic_id", $topic->id], ["comment_reply", 0]])->orderBy("created_at", "desc")->paginate(4);
        $commentReplies = $commentModel->getRepliesComment($comments);

        return view("topic.topic_page", [
            "id" => $topic->id,
            "comments" => $comments,
            "commentReplies" => $commentReplies,
        ]);
    }

    public function store(CreateTopic $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->message = $request->message;
        $topic->user_id = 1;
        $topic->save();

        return redirect()->route("home")->with("message", "トピックを投稿しました。");
    }
}
