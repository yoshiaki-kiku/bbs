<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * topics、commentsテーブルに画像URLのカラムを追加する
 */
class AddImageColumnToTopicsAndComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('image_path', 300)->nullable();;
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->string('image_path', 300)->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn("image_path");
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn("image_path");
        });
    }
}
