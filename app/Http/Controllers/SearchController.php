<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Validator;
use App\Models\Search;
use App\Models\Topic;

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

        if ($validator->fails()) {
            $results = null;
        } else {
            $topic = new Topic();
            $sqlForWhere = $search->makeMultipleKeywordsSqlForWhere("concat(title, message)", $request->keywords);
            $query = $topic->Where($sqlForWhere);
            $results = $query->orderBy("created_at", "desc")->paginate(10);
        }

        return view("search.result", [
            "results" => $results
        ])->withErrors($validator);
    }
}
