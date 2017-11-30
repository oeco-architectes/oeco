<?php

namespace Tests\Feature\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\News;
use App\User;

class NewsTest extends TestCase
{
    public function testsNewsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Lorem ipsum dolor',
            'summary' => 'Sit amet',
        ];

        $this->json('POST', '/api/news', $payload, $headers)
            ->assertStatus(201)
            ->assertJson([
                'title' => 'Lorem ipsum dolor',
                'slug' => 'lorem-ipsum-dolor',
                'summary' => 'Sit amet',
            ]);
    }

    public function testsNewsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $news = factory(News::class)->create([
            'title' => 'First title',
            'summary' => 'First summary',
        ]);

        $payload = [
            'title' => 'Lorem ipsum dolor',
            'summary' => 'Sit amet',
        ];

        $response = $this->json('PUT', '/api/news/' . $news->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'title' => 'Lorem ipsum dolor',
                'slug' => 'lorem-ipsum-dolor',
                'summary' => 'Sit amet',
            ]);
    }

    public function testsNewsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $news = factory(News::class)->create([
            'title' => 'First title',
            'summary' => 'First summary',
        ]);

        $this->json('DELETE', '/api/news/' . $news->id, [], $headers)
            ->assertStatus(204);
    }

    public function testNewsAreListedCorrectly()
    {
        factory(News::class)->create([
            'title' => 'First title',
            'summary' => 'First summary',
        ]);

        factory(News::class)->create([
            'title' => 'Second title',
            'summary' => 'Second summary',
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/news', [], $headers)
            ->assertStatus(200)
            ->assertJsonFragment([ 'title' => 'First title', 'slug' => 'second-title', 'summary' => 'First summary' ])
            ->assertJsonFragment([ 'title' => 'Second title', 'slug' => 'second-title', 'summary' => 'Second summary' ])
            ->assertJsonStructure([
                '*' => ['id', 'summary', 'title', 'created_at', 'updated_at'],
            ]);
    }

    public function testNewsDetailsAreReturnedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $news = factory(News::class)->create([
            'title' => 'Lorem ipsum dolor',
            'summary' => 'Sit amet',
        ]);

        $response = $this->json('GET', '/api/news/' . $news->id, [], $headers)
            ->assertStatus(200)
            ->assertJson([
                'title' => 'Lorem ipsum dolor',
                'slug' => 'lorem-ipsum-dolor',
                'summary' => 'Sit amet',
            ]);
    }
}
