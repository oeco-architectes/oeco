<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\News;

class NewsTest extends TestCase
{
    public function testNewsDefaultValues()
    {
        $news = new News;
        $this->assertEquals($news->slug, '');
        $this->assertEquals($news->title, '');
        $this->assertEquals($news->summary, null);
        $this->assertEquals($news->position, null);
    }

    /**
     * @expectedException PDOException
     */
    public function testNewsCannotBeSavedWithAnEmptyTitle()
    {
        $news = new News;
        $news->save();
    }

    public function testNewsCanBeSavedOnceTitleIsSet()
    {
        $news = new News;
        $news->title = 'The title';
        $news->save();
        $this->assertTrue($news->exists);
    }

    public function testSettingTitleSetsSlug()
    {
        $news = new News;
        $news->title = 'The title';
        $this->assertEquals($news->slug, 'the-title');
    }

    /**
     * @expectedException RuntimeException
     */
    public function testSettingSlugThrowsException()
    {
        $news = new News;
        $news->slug = 'setting-any-slug-should-throw-an-exception';
    }

    public function testNewsWithAllFieldsFilledCanBeSaved()
    {
        $news = new News;
        $news->title = 'The title';
        $news->summary = 'The summary';
        $news->position = 12;
        $news->save();
        $this->assertTrue($news->exists);
    }
}
