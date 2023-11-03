<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;

use App\Models\Tweet;
// 237-23
use App\Services\TweetService;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(Request $request)
    // 74-3
    // public function __invoke(CreateRequest $request)
    // 237-23
    public function __invoke(CreateRequest $request, TweetService $tweetService)
    {
        // 2-16
        // $tweet = new Tweet;
        // 132-27
        // $tweet->user_id = $request->userId(); // ここでUserIdを保存している
        // $tweet->content = $request->tweet();
        // $tweet->save();
        // 238-23
        $tweetService->saveTweet(
            $request->userId(),
            $request->tweet(),
            $request->images()
        );
        return redirect()->route('tweet.index');
    }
}
