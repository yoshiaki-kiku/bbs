<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CreateComment;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{
    /**
     * コメント投稿処理、フォームボタンによって
     * 新規コメントと返信コメントの処理を分岐させる
     *
     * @param CreateComment $request
     * @param [type] $id
     * @return void
     */
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

    /**
     * 新規コメントの処理
     *
     * @param CreateComment $request
     * @param [type] $id
     * @return void
     */
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

    /**
     * コメント編集フォーム
     *
     * @param Comment $comment
     * @return void
     */
    public function updateForm(Comment $comment)
    {
        return view("comment.update_form", [
            "comment" => $comment,
        ]);
    }

    /**
     * コメント編集の確認画面
     *
     * @param CreateComment $request
     * @return void
     */
    public function updateConfirm(CreateComment $request)
    {
        // 存在確認
        $comment = Comment::findOrFail($request->id);

        $comment->message = $request->message;

        return view("comment.update_confirm", [
            "comment" => $comment,
        ]);
    }

    /**
     * コメント更新処理
     *
     * @param CreateComment $request
     * @return void
     */
    public function update(CreateComment $request)
    {
        // 存在確認
        $comment = Comment::findOrFail($request->id);

        // 確認画面で戻るボタンが押された場合
        if ($request->get('back')) {
            // 入力画面へ戻る
            return redirect()
                ->route('comment.update.form', $request->id)
                ->withInput();
        }

        // update処理
        $comment->message = $request->message;
        $comment->save();

        return redirect()->route("home")
            ->with('message', "コメントID「{$comment->id}」を編集しました。");
    }

    /**
     * コメント削除の確認画面
     *
     * @param CommentTopic $comment
     * @return void
     */
    public function deleteConfirm(Comment $comment)
    {
        return view("comment.delete_confirm", [
            "comment" => $comment,
        ]);
    }

    /**
     * コメントの削除処理
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        // 存在確認
        Comment::findOrFail($request->id);

        // コメントの削除
        $comment = new Comment();
        // 返信コメントがある場合は削除
        $comment->where("comment_reply", $request->id)->delete();
        // コメントの削除
        $comment->where("id", $request->id)->delete();

        return redirect()->route("home")
            ->with('message', "コメントID「{$comment->id}」を削除しました。");
    }
}
