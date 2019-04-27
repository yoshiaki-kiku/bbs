<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TopPageTest extends DuskTestCase
{
    /**
     * A Dusk test example
     * Dusk環境のテスト
     * @test
     * @return void
     */
    public function トップページの表示確認()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('トピックを投稿するには');
        });
    }
}
