<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use App\Models\Topic;

class TopicControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        // ユーザー作成して、そのユーザーでトピックを10作成
        factory(\App\User::class)->create()->each(function ($user) {
            factory(\App\Models\Topic::class, 10)->create([
                "user_id" => $user->id,
            ]);
        });

        // 一般ユーザー用でid2を作成
        factory(\App\User::class)->create();
    }

    /**
     * @test
     */
    public function トピックページの存在しないIDでエラーが出るか()
    {
        $response = $this->get(route("topic.page", [0]));
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function トピック編集ページに一般ユーザーで入れないか()
    {
        $user = \App\User::find(2);
        $response = $this->actingAs($user)->get(route("topic.update.form", 1));
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function トピック削除ページに一般ユーザーで入れないか()
    {
        $user = \App\User::find(2);
        $response = $this->actingAs($user)->get(route("topic.delete.confirm", 1));
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function トピック投稿で画像サイズMAX越えのエラーが出るか()
    {
        $user = \App\User::find(2);
        $response = $this->actingAs($user)->post('/', [
            'post_image' => UploadedFile::fake()->image("test.jpg", 300, 300)->size(3000),
        ]);

        $response->assertSessionHasErrors(['post_image' => '添付画像には2048 KB以下のファイルを指定してください。']);
    }

    /**
     * @test
     */
    public function トピック投稿で指定の画像ファイルタイプ以外でエラーが出るか()
    {
        $user = \App\User::find(2);
        $response = $this->actingAs($user)->post('/', [
            'post_image' => UploadedFile::fake()->create('document.pdf', 1000),
        ]);

        $response->assertSessionHasErrors([
            'post_image' => '添付画像には画像ファイルを指定してください。',
            'post_image' => '添付画像にはjpeg, png, jpg, gifのうちいずれかの形式のファイルを指定してください。',
        ]);
        // $response->assertSessionHasNoErrors();
    }


    /**
     * @test
     */
    public function トピック投稿で画像が保存されたか()
    {
        // テスト用ストレージの指定
        $fake = \Storage::fake('local');

        // ファイルを生成
        $file = UploadedFile::fake()->image('unittest.jpg');

        $user = \App\User::find(2);
        $response = $this->actingAs($user)->post('/', [
            "title" => $this->faker->realText(30),
            "message" => $this->faker->realText(30),
            'post_image' => $file,
        ]);

        // 保存したファイルパスを取得
        $topicModel = new Topic();
        $topic = $topicModel->orderBy("desc")->first();

        // ファイルが保存されたことをアサートする
        \Storage::disk('local')->assertExists("public/post_images/" . $topic->image_path);
    }
}
