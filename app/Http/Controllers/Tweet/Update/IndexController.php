<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tweet;
// 138-34
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
// use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(Request $request)
    // 138-34
    public function __invoke(Request $request, TweetService $tweetService)
    {
        // 86-04
        $tweetId = (int) $request->route('tweetId');
        // dd($tweetId);
        // 86-05
        // $tweet = Tweet::where('id', $tweetId)->first();
        // 138-34
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }

        // 87-06
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        // if (is_null($tweet)) {
        //     throw new NotFoundHttpException('存在しないつぶやきです');
        // }
        // dd($tweet);
        // 89-09
        return view('tweet.update')->with('tweet', $tweet);
    }
}
