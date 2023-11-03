<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    // public function testExample(): void
    public function testSuccessfullLogin(): void
    {
        $this->browse(function (Browser $browser) {
            // 269-26
            $user = User::factory()->create(); // テスト用のユーザーを作成する
            // $browser->visit('/')
            // 267-23
            $browser->visit('/login') // パスを変更する
                    // 268-24
                    // ->type('email', 'test@example.com') // メールアドレスを入力する
                    ->type('email', $user->email) // テスト用のユーザーのメールアドレスを指定する
                    // 268-25
                    ->type('password', 'password') // パスワードを入力する
                    // 270-27
                    ->press('LOG IN') // 「LOG IN」ボタンをクリックする
                    // 270-28
                    ->assertPathIs('/tweet') // /tweetに遷移したことを確認する
                    // ->assertSee('Laravel');
                    // 271-29
                    ->assertSee('つぶやきアプリ'); // ページ内に「つぶやきアプリ」が表示されていることの確認
        });
    }
}
