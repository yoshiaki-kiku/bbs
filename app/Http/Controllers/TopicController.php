<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use App\Http\Requests\CreateTopic;
use Illuminate\Support\Facades\Auth;

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
        list($commentReplies, $commentRepliesCount) = $commentModel->getRepliesComment($comments);

        // 投稿ボタンの有効無効
        $disabledButton = (Auth::check()) ? "" : " disabled";

        return view("topic.topic_page", [
            "topic" => $topic,
            "comments" => $comments,
            "commentReplies" => $commentReplies,
            "commentRepliesCount" => $commentRepliesCount,
            "disabledButton" => $disabledButton,
        ]);
    }

    public function store(CreateTopic $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->message = $request->message;
        $topic->user_id = $request->user()->id;
        $topic->save();

        return redirect()->route("home")->with("message", "トピックを投稿しました。");
    }
}
