<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    public function testHomePageRenders()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
