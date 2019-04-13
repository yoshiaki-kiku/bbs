<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Validator;
use App\Models\Search;
use App\Topic;

/**
 * 検索処理のためのクラス
 */
class SearchController extends Controller
{
    /**
     * Undocumented function
     * リダイレクト処理不要なのでリダイレクト無効化が難しい
     * FormeRequestは使わない
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        $search = new Search();
        // バリデータ

        $validator = Validator::make(
            $request->all(),
            $search->rules,
            $search->attributes
        );

        if (!$validator->fails()) {
            $result = null;
        } else {
            // 検索範囲で分岐
            if ($request->column === "topic") {
                $topic = new Topic();
                $sqlForWhere = $search->makeMultipleKeywordsSqlForWhere("concat(title, message)", $request->keywords);
                $query = $topic->Where($sqlForWhere);
            } elseif ($request->column === "comment") {
                $comment = new Comment();
                $sqlForWhere = $search->makeMultipleKeywordsSqlForWhere("message", $request->keywords);
                $query = $comment->with("topic")->Where($sqlForWhere);
            }
            $result = $query->orderBy("created_at", "desc")->paginate(10);
        }

        return view("search.result")->withErrors($validator);
    }
}
