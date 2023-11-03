<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
// 105-06
use App\Services\TweetService;  // TweetServiceのインポート
use App\Models\Tweet;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Illuminate\Http\Request  $request
     * @param Illuminate\Http\Response
     */
    // public function __invoke(Request $request)
    public function __invoke(Request $request, TweetService $tweetService)
    {
        // 38
        // $tweets = Tweet::all();
        // dd($tweets);
        // 2-19
        // $tweets = Tweet::orderBy('created_at', 'DESC')->get();
        // $tweets = Tweet::all()->sortByDesc('created_at');
        // 105-06
        // $tweetService = new TweetService(); // TweetServiceのインスタンスを作成
        $tweets = $tweetService->getTweets(); // つぶやきの一覧を取得
        // 228-11
        // dump($tweets);
        // app(\App\Exceptions\Handler::class)->render(request(), throw new \Error('dump report.'));

        // return 'Single Action!';
        // 16
        // return view('tweet.index', ['name' => 'larabel']);
        // 40
        return view('tweet.index')
            ->with('tweets', $tweets);
    }
}
