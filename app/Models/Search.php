<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Search extends Model
{
    public $rules = [
        'keywords' => 'required|max:1000',
    ];

    public $attributes = [
        'keywords' => 'キーワード',
    ];

    /**
     * 空白区切りの複数キーワードの処理
     *
     * @param [type] $columnName
     * @param [type] $keywords
     * @return void
     */
    public function makeMultipleKeywordsSqlForWhere($columnName, $keywords){
        $keywords = str_replace("　", " ", $keywords);
        $keywords = preg_replace("/ +/", " ", $keywords);
        $keywords_array = explode(" ", $keywords);

        $sal_array = [];

        foreach($keywords_array as $value){
            // DB::rawでconcatに対応させる
            $sql_array[] = [DB::raw($columnName), "like", "%{$value}%"];
        }

        return $sql_array;
    }
}
