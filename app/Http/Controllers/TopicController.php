<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

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
}
