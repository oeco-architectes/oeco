<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    public function testProjectsPageRenders()
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }
}
