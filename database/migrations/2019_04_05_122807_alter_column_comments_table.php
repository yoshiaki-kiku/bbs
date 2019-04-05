<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カラムの追加
        Schema::table('comments', function (Blueprint $table) {
            // 外部キーを設定する
            $table->foreign('topic_id')->references('id')->on('topics')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //  外部キー制約を削除
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['topic_id']);
        });
    }
}
