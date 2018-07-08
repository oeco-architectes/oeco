<?php

namespace App;

use Storage;
use RuntimeException;
use InvalidArgumentException;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;

/**
 * Oeco news.
 *
 * @property string title News title, unique
 * @property-read string slug Slug, automatically-generated from title
 * @property string summary Optional summary
 * @property string position Order to display, or `null` when hidden
 */
class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'summary', 'position'
    ];

    /**
     * Trim and set the title, and update the slug attribute automatically.
     * @param string $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = trim($value);
        $this->attributes['slug'] = self::titleToSlug($value);
    }

    /**
     * Prevents setting the slug explicitely
     * @param string $value
     * @throw RuntimeException Always throw an exception
     */
    public function setSlugAttribute($value)
    {
        throw new RuntimeException('Slug cannot be set explicitely, set title instead.');
    }

    public function getImagePath()
    {
        return self::imagePath($this->slug);
    }

    public function getImageUrl()
    {
        return self::imageUrl($this->slug);
    }

    public function hasSummary()
    {
        return $this->summary !== null;
    }

    public static function imagePath($slug, $extension = 'jpg')
    {
        return storage_path('app/img/news/' . $slug . '.' . $extension);
    }

    public static function imageUrl($slug, $extension = 'jpg')
    {
        return Storage::url('img/news/' . $slug . '.' . $extension);
    }

    /**
     * Convert a title to a slug
     * @param string $title A title
     * @return string The title, converted to a slug
     */
    public static function titleToSlug($title)
    {
        $slugify = new Slugify();
        return $slugify->slugify($title);
    }
}
