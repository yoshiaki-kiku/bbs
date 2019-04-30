<?php

namespace App\Libs;

use Image;

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
        // 拡張子取得
        $extension = $file->getClientOriginalExtension();
        // ランダム文字列の生成
        $random = str_random(14);
        // 保存用のファイル名作成
        $filenameToStore =  time() . '_' . $random . '.' . $extension;

        return $filenameToStore;
    }

    /**
     * 最大高さを設定して、最大以上ならリサイズ
     *
     * @param [type] $img
     * @return void
     */
    public function resizeImage($requestImage)
    {
        $img = Image::make($requestImage);
        $height = 440;
        $img->resize(null, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        return $img;
    }
}
