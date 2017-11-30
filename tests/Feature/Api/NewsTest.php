<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\News;
use App\User;

class NewsTest extends TestCase
{
    use Authorized;

    public function testsNewsAreCreatedCorrectly()
    {
        $payload = [
            'title' => 'Lorem ipsum dolor',
            'summary' => 'Sit amet',
        ];

        $this->json('POST', '/api/news', $payload, $this->getAuthorizedHeaders())
            ->assertStatus(201)
            ->assertJson([
                'title' => 'Lorem ipsum dolor',
                'slug' => 'lorem-ipsum-dolor',
                'summary' => 'Sit amet',
            ]);
    }

    public function testsNewsAreUpdatedCorrectly()
    {
        $news = factory(News::class)->create([
            'title' => 'First title',
            'summary' => 'First summary',
        ]);

        $payload = [
            'title' => 'Lorem ipsum dolor',
            'summary' => 'Sit amet',
        ];

        $response = $this->json('PUT', '/api/news/' . $news->id, $payload, $this->getAuthorizedHeaders())
            ->assertStatus(200)
            ->assertJson([
                'title' => 'Lorem ipsum dolor',
                'slug' => 'lorem-ipsum-dolor',
                'summary' => 'Sit amet',
            ]);
    }

    public function testsNewsAreDeletedCorrectly()
    {
        $news = factory(News::class)->create([
            'title' => 'First title',
            'summary' => 'First summary',
        ]);

        $this->json('DELETE', '/api/news/' . $news->id, [], $this->getAuthorizedHeaders())
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

        $response = $this->json('GET', '/api/news', [], $this->getAuthorizedHeaders())
            ->assertStatus(200)
            ->assertJsonFragment([ 'title' => 'First title', 'slug' => 'second-title', 'summary' => 'First summary' ])
            ->assertJsonFragment([ 'title' => 'Second title', 'slug' => 'second-title', 'summary' => 'Second summary' ])
            ->assertJsonStructure([
                '*' => ['id', 'summary', 'title', 'created_at', 'updated_at'],
            ]);
    }

    public function testNewsDetailsAreReturnedCorrectly()
    {
        $news = factory(News::class)->create([
            'title' => 'Lorem ipsum dolor',
            'summary' => 'Sit amet',
        ]);

        $response = $this->json('GET', '/api/news/' . $news->id, [], $this->getAuthorizedHeaders())
            ->assertStatus(200)
            ->assertJson([
                'title' => 'Lorem ipsum dolor',
                'slug' => 'lorem-ipsum-dolor',
                'summary' => 'Sit amet',
            ]);
    }
}
