<?php

namespace Tests\Unit\Service;

use App\Services\TweetService;
use PHPUnit\Framework\TestCase;
// 252-08
use Mockery;

class TweetServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     * 
     * @runInSeparateProcess
     * @return void
     */
    // public function test_example(): void
    // 249-04
    public function test_check_own_tweet()
    {
        $tweetService = new TweetService(); // TweetServiceのインスタンスを作成

        // 252-08
        $mock = Mockery::mock('alias:App\Models\Tweet');
        $mock->shouldReceive('where->first')->andReturn((object)[
            'id' => 1,
            'user_id' => 1
        ]);

        $result = $tweetService->checkOwnTweet(1, 1);
        // $this->assertTrue(true);
        $this->assertTrue($result);

        // 251-07
        $result = $tweetService->checkOwnTweet(2, 1);
        $this->assertFalse($result);
    }
}
