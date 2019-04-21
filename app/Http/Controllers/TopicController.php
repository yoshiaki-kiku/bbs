<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Comment;
use App\Http\Requests\CreateTopic;
use Illuminate\Support\Facades\Auth;
use App\Libs\Util;

class TopicController extends Controller
{
    /**
     * トピック一覧
     *
     * @return void
     */
    public function index()
    {
        $topicModel = new Topic();
        $topics = $topicModel::orderBy("created_at", "desc")
            ->paginate(config("bbs.paginate.topPage"));
        $numberOfComments = $topicModel->countComment($topics);

        return view("topic.topic_list", [
            "topics" => $topics,
            "numberOfComments" => $numberOfComments
        ]);
    }

    /**
     * トピックページ、コメント含む
     *
     * @param Topic $topic
     * @return void
     */
    public function show(Topic $topic)
    {

        $commentModel = new Comment();
        $comments = $commentModel->with("user")->where([["topic_id", $topic->id], ["comment_reply", 0]])
            ->orderBy("created_at", "desc")->paginate(config("bbs.paginate.topicPage"));
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

    /**
     * トピックの投稿処理
     *
     * @param CreateTopic $request
     * @return void
     */
    public function store(CreateTopic $request)
    {

        $topic = new Topic();
        $topic->title = $request->title;
        $topic->message = $request->message;
        $topic->user_id = $request->user()->id;

        // 画像の保存
        if ($request->hasFile("post_image")) {
            $util = new Util();
            $fileName = $util->createImageFileName($request->post_image);
            $request->post_image->storeAs('public/post_images', $fileName);
            $topic->image_path =  $fileName;
        }

        $topic->save();

        return redirect()->route("home")->with("message", "トピックを投稿しました。");
    }

    /**
     * トピック編集フォーム
     *
     * @param Topic $topic
     * @return void
     */
    public function updateForm(Topic $topic)
    {
        return view("topic.update_form", [
            "topic" => $topic,
        ]);
    }

    /**
     * トピック編集の確認画面
     *
     * @param CreateTopic $request
     * @return void
     */
    public function updateConfirm(CreateTopic $request)
    {
        // 存在確認
        $topic = Topic::findOrFail($request->id);

        $topic->title = $request->title;
        $topic->message = $request->message;

        return view("topic.update_confirm", [
            "topic" => $topic,
        ]);
    }

    public function update(CreateTopic $request)
    {
        // 存在確認
        $topic = Topic::findOrFail($request->id);

        // 確認画面で戻るボタンが押された場合
        if ($request->get('back')) {
            // 入力画面へ戻る
            return redirect()
                ->route('topic.update.form', $request->id)
                ->withInput();
        }

        // update処理
        $topic->title = $request->title;
        $topic->message = $request->message;
        $topic->save();

        return redirect()->route("home")
            ->with('message', "トピックID「{$topic->id}」を編集しました。");
    }

    /**
     * トピック削除の確認画面
     *
     * @param Topic $topic
     * @return void
     */
    public function deleteConfirm(Topic $topic)
    {
        return view("topic.delete_confirm", [
            "topic" => $topic,
        ]);
    }

    public function delete(Request $request)
    {
        // 存在確認
        $topic = Topic::findOrFail($request->id);

        // 関連コメントの削除
        $topic->comment()->delete();

        // トピックを削除
        $topic->delete();

        return redirect()->route("home")
            ->with('message', "トピックID「{$topic->id}」を削除しました。");
    }
}
