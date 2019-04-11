<?php

namespace App\Libs;

class Util
{
    public function textBr($text)
    {
        return nl2br(e($text), false);
    }
}
