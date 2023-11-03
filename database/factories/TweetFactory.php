<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// 217-11
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 129-24
            'user_id' => 1, // つぶやきを投稿したユーザーのIDをデフォルトで1とする
            'content' => $this->faker->realText(100),
            // 217-11
            'created_at' => Carbon::now()->yesterday()
        ];
    }
}
