<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    public function testProjectPageRenders()
    {
        $response = $this->get('/projects/test');
        $response->assertStatus(200);
    }
}
