<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InstagramPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Carbon;

class InstagramController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $params = [];

        if (isset($user->instagram_username)) {
            $params = [
                'username' => $user->instagram_username,
            ];
        }

        return view('instagram', $params);
    }

    public function loginInstagram()
    {
        $url = Socialite::driver('instagrambasic')
            ->setScopes(['user_profile', 'user_media'])
            ->redirect()
            ->getTargetUrl();

        return redirect()->away($url);
    }

    public function instagramCallback()
    {
        $driver = Socialite::driver('instagrambasic');
        $credential = $driver->getAccessTokenResponse(request('code'));
        $userdata = $driver->userFromToken($credential['access_token']);

        $response = Http::get(config('services.instagrambasic.token_url'), [
            'grant_type' => 'ig_exchange_token',
            'client_secret' => config('services.instagrambasic.client_secret'),
            'access_token' => $credential['access_token']
        ]);

        $new_token = json_decode($response->body(), true);
        $username = $userdata->user['username'];

        $instagram_user = User::user();

        if ($instagram_user->instagram_user_id === null) {
            $instagram_user->update([
                'instagram_username' => $username,
                'instagram_user_id' => $userdata->id,
                'instagram_state' => request('state'),
                'instagram_access_token' => $new_token['access_token'],
                'instagram_token_expired_at' => now()->addSeconds($new_token['expires_in'])
            ]);
        }

        return redirect("fetch-posts-instagram?username=$username");
    }

    public function instagramFetchPost(Request $request)
    {
        $credential = Auth::user();

        $response = Http::get(
            'https://graph.instagram.com' . "/{$credential['instagram_user_id']}/media",
            [
                'access_token' => $credential['instagram_access_token'],
                'limit' => 5,
                'fields' => 'id,media_url,media_type,permalink,thumbnail_url,timestamp,caption'
            ]
        );

        $data = json_decode($response->body(), true)['data'];

        foreach ($data as $feed) {
            $parsed_feed[] = [
                'media_id' => $feed['id'],
                'type' => $feed['media_type'],
                'permalink' => $feed['permalink'] ?? null,
                'caption' => $feed['caption'] ?? null,
                'path' => $feed['media_url'] ?? null,
                'created_at' => Carbon::create($feed['timestamp']) ?? null,
            ];
        }

        InstagramPost::truncate();

        InstagramPost::insert(
            $parsed_feed,
            [
                'media_id',
            ],
            [
                'type',
                'permalink',
                'caption',
                'path',
                'created_at'
            ]
        );

        return redirect('instagram-feeds');
    }

    public function instagramFeed()
    {
        $instagram_posts = InstagramPost::get();
        $user = User::user();

        return view('instagram_feeds', [
            'instagram_posts' => $instagram_posts,
            'username' => $user->instagram_username
        ]);
    }
}
