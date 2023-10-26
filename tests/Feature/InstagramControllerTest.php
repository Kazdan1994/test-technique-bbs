<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InstagramControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndexMethod(): void
    {
        $response = $this->get(route('instagram.home'));
        $response->assertStatus(200);
    }

    public function testLoginInstagramMethod(): void
    {
        $response = $this->get(route('instagram.login'));
        $response->assertStatus(302);
    }

    public function testInstagramCallbackMethod(): void
    {
        $response = $this->get(route('instagram.instagramCallback'));
        $response->assertStatus(302);
        $response->assertRedirect(env('INSTAGRAMBASIC_REDIRECT_URI'));
    }

    public function testInstagramFetchPostMethod(): void
    {
        Http::fake([
            'https://graph.instagram.com/*' => Http::response(['data' => []], 200),
        ]);

        $response = $this->post(route('instagram.instagramFetchPost'));

        $response->assertStatus(302);
        $response->assertRedirect('instagram.instagramFeed');
    }

    public function testInstagramFeedMethod(): void
    {
        $response = $this->get(route('instagram.instagramFeed'));
        $response->assertStatus(200);
    }
}
