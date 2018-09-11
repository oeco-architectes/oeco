<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgencyTest extends TestCase
{
    public function testAgencyPageRenders()
    {
        $response = $this->get('/agency');
        $response->assertStatus(200);
    }

    public function testPublicationsPageRenders()
    {
        $response = $this->get('/agency/publications');
        $response->assertStatus(200);
    }
}
