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

        // bladeでoldを使えるようにする
        // redirectなしの処理では必要
        $request->flash();

        // バリデータ
        $validator = Validator::make(
            $request->all(),
            $search->rules,
            $search->attributes
        );

        if ($validator->fails()) {
            $results = null;
            $resultsCount = 0;
            $numberOfComments = null;
        } else {
            $topic = new Topic();
            $sqlForWhere = $search->makeMultipleKeywordsSqlForWhere("concat(title, message)", $request->keywords);
            $query = $topic->Where($sqlForWhere);
            $results = $query->orderBy("created_at", "desc")->paginate(config("bbs.paginate.searchResult"));
            $resultsCount = $query->orderBy("created_at", "desc")->count();
            $numberOfComments = $topic->countComment($results);
        }

        return view("search.result", [
            "results" => $results,
            "resultsCount" => $resultsCount,
            "numberOfComments" => $numberOfComments
        ])->withErrors($validator);
    }
}
