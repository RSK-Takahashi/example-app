<?php

namespace App\Services;

use App\Models\Tweet;
// 216-10
use Carbon\Carbon;
// 236-22
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// 305-42
use App\Modules\ImageUpload\ImageManagerInterface;

class TweetService
{
    // 305-42
    public function __construct(private ImageManagerInterface $imageManager)
    {}

    // 104-05
    public function getTweets()
    {
        // return Tweet::orderBy('created_at', 'DESC')->get();
        // 228-10
        return Tweet::with('images')->orderBy('created_at', 'DESC')->get();
    }

    // 138-33
    // 自分のtweetかどうかをチェックするメソッド
    public function checkOwnTweet(int $userId, int $tweetId): bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if (!$tweet) {
            return false;
        }

        return $tweet->user_id === $userId;
    }

    // 216-10
    public function countYesterdayTweets(): int
    {
        return Tweet::whereDate('created_at', '>=',
        Carbon::yesterday()->toDateTimeString())
            ->whereDate('created_at', '<',
            Carbon::today()->toDateTimeString())
            ->count();
    }

    // 236-22
    public function saveTweet(int $userId, string $content, array $images)
    {
        DB::transaction(function () use ($userId, $content, $images) {
            $tweet = new Tweet;
            $tweet->user_id = $userId;
            $tweet->content = $content;
            $tweet->save();
            foreach ($images as $image) {
                // Storage::putFile('public/images', $image);
                // 305-43
                $name = $this->imageManagers->save($image);
                $imageModel = new Image();
                // $imageModel->name = $image->hashName();
                $imageModel->name = $name;
                $imageModel->save();
                $tweet->images()->attach($imageModel->id);
            }
        });
    }

    // 242-30
    public function deleteTweet(int $tweetId)
    {
        DB::transaction(function () use ($tweetId) {
            $tweet = Tweet::where('id', $tweetId)->firstOrFail();
            $tweet->images()->each(function ($image) use ($tweet){
                // $filePath = 'public/images/' . $image->name;
                // if(Storage::exists($filePath)){
                //     Storage::delete($filePath);
                // }
                // 306-43
                $this->imageManager->delete($image->name);
                $tweet->images()->detach($image->id);
                $image->delete();
            });

            $tweet->delete();
        });
    }
}
