<?php

namespace Tests\Feature\Tweet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// 259-15
use App\Models\User;
// 260-16
use App\Models\Tweet;

class DeleteTest extends TestCase
{
    // 258-14
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * 
     * @return void
     */
    // public function test_example(): void
    // 257-13
    public function test_delete_successed()
    {
        // 259-15
        $user = User::factory()->create(); // ユーザーを作成

        // 260-16
        $tweet = Tweet::factory()->create(['user_id' => $user->id]); // つぶやきを作成

        // 260-17
        $this->actingAs($user); // 指定したユーザーでログインした状態にする

        // $response = $this->get('/');
        // $response = $this->delete('/tweet/delete/1');
        // 260-16
        $response = $this->delete('/tweet/delete/' . $tweet->id); // 作成したつぶやきIDを指定

        // $response->assertStatus(200);
        $response->assertRedirect('/tweet');
    }
}
