<?php

namespace App\Libs;

class Util
{
    /**
     * テキストに改行htmlを入れる
     *
     * @param [type] $text
     * @return void
     */
    public function textBr($text)
    {
        return nl2br(e($text), false);
    }

    /**
     * 画像保存用のファイル名を作成
     *
     * @param [type] $file
     * @return void
     */
    public function createImageFileName($file)
    {
        // ファイル名と拡張子
        $filenameWithExtension = $file->getClientOriginalName();
        // ファイル名のみ取得
        $fileName = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        // 拡張子取得
        $extension = $file->getClientOriginalExtension();
        // 保存用のファイル名作成
        $filenameToStore = $fileName . '_' . time() . '.' . $extension;

        return $filenameToStore;
    }
}
